<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModulProgress;
use App\Models\Modul;
use App\Models\Kursus;
use App\Models\Notifikasi;
use App\Services\CertificateService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MenteeController extends Controller
{
    protected $certificateService;

    public function __construct(CertificateService $certificateService)
    {
        $this->certificateService = $certificateService;
    }

    public function dashboard()
    {
        return $this->courseSaya();
    }

    public function courseSaya()
    {
        $kursusSaya = auth()->user()->kursus()
            ->with(['mentor', 'kategori'])
            ->get();

        return view('mentee.dashboard.dashboard_mentee', compact('kursusSaya'));
    }

    public function detailCourseSaya($id, Request $request)
    {
        $user = auth()->user();
        $course = $user->kursus()
            ->with(['mentor', 'modul' => fn($q) => $q->orderBy('urutan')])
            ->where('kursus.id', $id)
            ->firstOrFail();

        $modules = $course->modul;
        $progress = UserModulProgress::where('user_id', $user->id)
            ->where('kursus_id', $id)
            ->get()
            ->keyBy('modul_id');

        // Pindahkan pengambilan otherCourses ke sini agar selalu tersedia
        $otherCourses = $user->kursus()
            ->where('kursus.id', '!=', $id)
            ->withCount('modul')
            ->take(3)
            ->get()
            ->map(function($course) use ($user) {
                $done = UserModulProgress::where('user_id', $user->id)
                    ->where('kursus_id', $course->id)
                    ->where('status_modul', 'selesai')
                    ->count();
                $course->percent = $course->modul_count > 0 ? round(($done / $course->modul_count) * 100) : 0;
                return $course;
            });

        if ($modules->isEmpty()) {
            return view('mentee.dashboard.detail_course_saya', [
                'kursus'         => $course,
                'otherCourses'   => $otherCourses, // Tambahkan ini
                'modulAktif'     => null,
                'progressList'   => collect(),
                'statusKursus'   => 'belum',
                'persenProgress' => 0,
                'modulSelesai'   => 0,
                'totalModul'     => 0
            ]);
        }

        $activeId = $request->query('modul_id', $modules->first()?->id);
        $activeModule = $modules->firstWhere('id', $activeId) ?? $modules->first();

        $prevModule = $modules->where('urutan', '<', $activeModule->urutan)->last();
        $isPrevDone = !$prevModule || ($progress[$prevModule->id] ?? null)?->status_modul === 'selesai';

        if (!$isPrevDone) {
            $lastDoneOrder = $modules->filter(fn($m) => ($progress[$m->id] ?? null)?->status_modul === 'selesai')->max('urutan') ?? -1;
            $shouldBeId = $modules->where('urutan', '>', $lastDoneOrder)->first()?->id;

            return redirect()->route('mentee.course.detail', ['id' => $id, 'modul_id' => $shouldBeId])
                ->with('info', 'Selesaikan modul sebelumnya terlebih dahulu.');
        }

        $total = $modules->count();
        $done = $progress->where('status_modul', 'selesai')->count();
        $percent = $total > 0 ? round(($done / $total) * 100) : 0;

        return view('mentee.dashboard.detail_course_saya', [
            'kursus'         => $course,
            'otherCourses'   => $otherCourses,
            'modulAktif'     => $activeModule,
            'progressList'   => $progress,
            'statusKursus'   => $progress->first()?->status_kursus ?? 'belum',
            'persenProgress' => $percent,
            'modulSelesai'   => $done,
            'totalModul'     => $total
        ]);
    }

    public function notifikasi()
    {
        $notifications = auth()->user()->notifikasi()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('mentee.notifikasi.index', compact('notifications'));
    }

    public function tandaiSelesai(Request $request)
    {
        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'modul_id'  => 'required|exists:modul,id',
        ]);

        $user = auth()->user();
        $courseId = $request->kursus_id;
        $modulId = $request->modul_id;

        $modules = Modul::where('kursus_id', $courseId)->orderBy('urutan')->get();
        $current = $modules->firstWhere('id', $modulId);

        if (!$current) {
            return back()->with('error', 'Modul tidak ditemukan.');
        }

        // Sequence Check: Pastikan modul sebelumnya sudah selesai sebelum menandai yang ini
        $prev = $modules->where('urutan', '<', $current->urutan)->last();
        if ($prev) {
            $prevDone = UserModulProgress::where('user_id', $user->id)
                ->where('modul_id', $prev->id)
                ->where('status_modul', 'selesai')
                ->exists();

            if (!$prevDone) {
                return back()->with('error', 'Modul sebelumnya belum selesai.');
            }
        }

        UserModulProgress::updateOrCreate(
            ['user_id' => $user->id, 'kursus_id' => $courseId, 'modul_id' => $modulId],
            ['status_modul' => 'selesai', 'selesai_at' => now()]
        );

        $doneCount = UserModulProgress::where('user_id', $user->id)
            ->where('kursus_id', $courseId)
            ->where('status_modul', 'selesai')
            ->count();

        // Jika semua modul selesai, update status kursus
        if ($doneCount >= $modules->count()) {
            UserModulProgress::where('user_id', $user->id)
                ->where('kursus_id', $courseId)
                ->update(['status_kursus' => 'selesai']);

            $user->kursus()->updateExistingPivot($courseId, ['status' => 'selesai']);

            // Generate Sertifikat Otomatis
            $course = Kursus::find($courseId);
            $this->certificateService->issue($user, $course);
        }

        // Cari modul selanjutnya
        $next = $modules->where('urutan', '>', $current->urutan)->first();

        return redirect()
            ->route('mentee.detailCourseSaya', ['id' => $courseId, 'modul_id' => $next->id ?? $modulId])
            ->with('success', $next ? 'Modul selesai! Lanjut ke berikutnya.' : 'Selamat! Kamu telah menyelesaikan kursus ini. 🎉');
    }
}