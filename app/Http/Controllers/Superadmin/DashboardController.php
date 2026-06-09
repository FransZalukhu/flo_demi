<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kursus;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $cacheTTL = 3600; // 1 hour

        // Get Total User berdasarkan Role (Cached)
        $totalAdmin = Cache::remember('stats_total_admin', $cacheTTL, fn() => User::where('role', 'admin')->count());
        $totalCourse = Cache::remember('stats_total_course', $cacheTTL, fn() => Kursus::count());
        $totalMentee = Cache::remember('stats_total_mentee', $cacheTTL, fn() => User::where('role', 'mentee')->count());

        // Get Total Admin (No cache for list to ensure it's always up to date for superadmin)
        $admins = User::where('role', 'admin')
            ->select('id', 'username', 'email', 'role', 'status', 'photo')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Get data bulanan (Cached)
        $adminChartData = Cache::remember('chart_admin_growth', $cacheTTL, fn() => $this->getMonthlyGrowthData('admin', 9));
        $courseChartData = Cache::remember('chart_course_growth', $cacheTTL, fn() => $this->getMonthlyCourseGrowthData(9));
        $menteeChartData = Cache::remember('chart_mentee_growth', $cacheTTL, fn() => $this->getMonthlyGrowthData('mentee', 9));

        // Menghintung Persentase Pertumbuhan
        $adminGrowth = $this->calculateGrowthPercentage($adminChartData);
        $courseGrowth = $this->calculateGrowthPercentage($courseChartData);
        $menteeGrowth = $this->calculateGrowthPercentage($menteeChartData);

        return view('superadmin.dashboard.index', compact(
            'totalAdmin',
            'totalCourse',
            'totalMentee',
            'admins',
            'adminChartData',
            'courseChartData',
            'menteeChartData',
            'adminGrowth',
            'courseGrowth',
            'menteeGrowth'
        ));
    }

    private function getMonthlyGrowthData($role, $months = 9)
    {
        $startDate = Carbon::now()->subMonths($months - 1)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $results = DB::table('users')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('role', $role)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthKey = $month->format('Y-m');
            $data[] = $results->get($monthKey, 0);
        }

        return $data;
    }

    private function getMonthlyCourseGrowthData($months = 9)
    {
        $startDate = Carbon::now()->subMonths($months - 1)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $results = DB::table('kursus')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthKey = $month->format('Y-m');
            $data[] = $results->get($monthKey, 0);
        }

        return $data;
    }

    private function calculateGrowthPercentage($data)
    {
        if (count($data) < 2) {
            return 0;
        }

        $firstMonth = $data[0];
        $lastMonth = end($data);

        if ($firstMonth == 0) {
            return $lastMonth > 0 ? 100 : 0;
        }

        $growth = (($lastMonth - $firstMonth) / $firstMonth) * 100;
        return round($growth, 1);
    }

    // Update Status Admin
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    // Reset Password Admin
    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Generate random password
        $newPassword = Str::random(12);
        $user->password = bcrypt($newPassword);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil direset',
            'new_password' => $newPassword
        ]);
    }

    // Halaman Reset Password Admin
    public function resetPasswordPage($id)
    {
        $admin = User::findOrFail($id);
        return view('superadmin.admin.reset_password_admin', compact('admin'));
    }

    // Simpan Reset Password Admin
    public function resetPasswordSave(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $validated = $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin->password = Hash::make($validated['new_password']);
        $admin->save();

        return redirect()->route('superadmin.admin.list')
            ->with('success', 'Password Admin ' . $admin->username . ' berhasil direset!');
    }

    public function notifikasi()
    {
        $notifications = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('superadmin.dashboard.notifikasi', compact('notifications'));
    }
}
