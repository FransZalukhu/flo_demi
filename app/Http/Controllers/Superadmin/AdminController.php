<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('superadmin.admin.list_admin', compact('admins'));
    }

    public function create()
    {
        return view('superadmin.admin.tambah_admin');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nomor_hp' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
            'role' => 'required|in:superadmin,admin,mentor,mentee',
            'status' => 'required|in:aktif,nonaktif',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);

        try {
            DB::beginTransaction();

            $permissions = $validated['permissions'] ?? [];
            
            $admin = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'nomor_hp' => $validated['nomor_hp'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'status' => $validated['status'],
                'permissions' => $permissions,
            ]);

            DB::commit();

            // Send notification to superadmin and admin
            NotificationService::notifyAdmins(
                'Sistem',
                Auth::user()->username . ' menambahkan pengguna baru (' . $admin->username . ')',
                'sistem'
            );

            return redirect()->route('superadmin.admin.list')
                ->with('success', 'Admin berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors([
                'error' => 'Gagal menambahkan admin: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('superadmin.admin.edit_admin', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'nomor_hp' => 'nullable|string|max:20',
            'role' => 'required|in:superadmin,admin',
            'status' => 'required|in:aktif,nonaktif',
            'permissions' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $admin->update([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'nomor_hp' => $validated['nomor_hp'],
                'role' => $validated['role'],
                'status' => $validated['status'],
                'permissions' => $validated['permissions'] ?? [],
            ]);

            DB::commit();

            return redirect()->route('superadmin.admin.list')
                ->with('success', 'Data admin berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Gagal memperbarui data admin: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function show($id)
    {
        $admin = User::findOrFail($id);
        
        return view('superadmin.admin.detail_admin', compact('admin'));
    }
}