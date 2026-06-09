<?php
namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Kategori;
use App\Models\Modul;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Pendaftaran;
use App\Services\NotificationService;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function CourseList()
    {
        $courses    = Kursus::with(['kategori', 'mentor', 'pendaftaran'])->get();
        $categories = Kategori::all();
        return view('superadmin.course.list_course', compact('courses', 'categories'));
    }

    /**
     * Tampilkan form tambah course.
     * Pass: categories, mentors, moduls (untuk searchable multi-select)
     */
    public function CreateCourse()
    {
        $categories = Kategori::all();
        $mentors    = User::where('role', 'mentor')->where('status', 'aktif')->get();

        // Semua modul beserta relasi kursus (untuk dropdown searchable di form)
        $moduls = Modul::with('kursus')
            ->orderBy('kursus_id')
            ->orderBy('urutan')
            ->get()
            ->map(fn($m) => [
                'id'     => $m->id,
                'judul'  => $m->judul,
                'urutan' => $m->urutan,
                'kursus' => ['judul' => $m->kursus->judul ?? '-'],
            ]);

        return view('superadmin.course.tambah_course', compact('categories', 'mentors', 'moduls'));
    }

    /**
     * Simpan course baru beserta relasi modul yang dipilih.
     */
    public function StoreCourse(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'mentor_id'   => 'required|exists:users,id',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'harga'       => 'required|numeric|min:0',
            'kuota'       => 'required|integer|min:0',
            'status'      => 'required|in:publish,draft',
            'modul_ids'   => 'nullable|array',
            'modul_ids.*' => 'exists:modul,id',
        ], [
            'judul.required'       => 'Judul course wajib diisi.',
            'deskripsi.required'   => 'Deskripsi wajib diisi.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'mentor_id.required'   => 'Mentor wajib dipilih.',
            'gambar.required'      => 'Thumbnail wajib diupload.',
            'gambar.image'         => 'Thumbnail harus berupa gambar.',
            'harga.required'       => 'Harga wajib diisi.',
            'kuota.required'       => 'Kuota wajib dipilih.',
        ]);

        // Upload and optimize thumbnail
        $gambarPath = $this->imageService->upload(
            $request->file('gambar'),
            'kursus',
            1200, // max width for course thumbnail
            80    // quality
        );

        // Bersihkan input harga dari karakter non-numerik
        $hargaClean = preg_replace('/[^0-9]/', '', $request->harga);

        // Buat kursus baru
        $kursus = Kursus::create([
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'mentor_id'   => $request->mentor_id,
            'gambar'      => $gambarPath,
            'harga'       => $hargaClean ?: 0,
            'kuota'       => $request->kuota,  // 0 = unlimited
            'status'      => $request->status,
        ]);

        // Update modul yang dipilih: set kursus_id ke kursus baru
        // (sesuaikan logika bisnis: apakah modul di-assign ulang atau hanya relasi)
        if ($request->filled('modul_ids')) {
            $modulIds = array_filter(array_unique($request->modul_ids));
            Modul::whereIn('id', $modulIds)->update(['kursus_id' => $kursus->id]);
        }

        Cache::forget('katalog_kursus_publish');
        Cache::forget('semua_kategori');

        return redirect()
            ->route('superadmin.course.list')
            ->with('success', 'Course "' . $kursus->judul . '" berhasil ditambahkan!');
    }


    /**
     * Tampilkan form edit course (Halaman Terpisah)
     */
    public function EditCourse($id)
    {
        $course     = Kursus::findOrFail($id);
        $categories = Kategori::all();
        $mentors    = User::where('role', 'mentor')->where('status', 'aktif')->get();
        
        return view('superadmin.course.edit_course', compact('course', 'categories', 'mentors'));
    }

    public function UpdateCourse(Request $request, $id)
    {
        $kursus = Kursus::findOrFail($id);

        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'harga'       => 'required|string',
            'kuota'       => 'nullable|integer|min:0',
            'status'      => 'required|in:publish,draft',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'judul.required'     => 'Judul wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);

        // Bersihkan input harga dari karakter non-numerik (Rp, titik, koma, dsb)
        $inputHarga = $request->input('harga');
        $hargaClean = preg_replace('/[^0-9]/', '', $inputHarga);

        if ($request->hasFile('gambar')) {
            $kursus->gambar = $this->imageService->upload(
                $request->file('gambar'),
                'kursus',
                1200, 
                80,   
                $kursus->gambar 
            );
        }

        $kursus->judul       = $request->judul;
        $kursus->deskripsi   = $request->deskripsi;
        $kursus->kategori_id = $request->kategori_id;
        $kursus->harga       = $hargaClean ?: 0;
        $kursus->kuota       = $request->kuota ?? 0;
        $kursus->status      = $request->status;
        $kursus->save();

        Cache::forget('katalog_kursus_publish');
        Cache::forget('semua_kategori');
        Cache::forget("kursus_detail_{$id}");

        return redirect()
            ->route('superadmin.course.list')
            ->with('success', 'Course "' . $kursus->judul . '" berhasil diperbarui!');
    }
}