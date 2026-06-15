<?php


namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Services\ImageUploadService;

class KursusController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

   public function index()
    {
        return $this->indexKatalog();
    }

    public function indexKatalog()
    {
        $cacheTTL = 3600; // 1 hour

        $kursus = Cache::remember('katalog_kursus_publish', $cacheTTL, function() {
            return Kursus::with(['kategori', 'mentor'])
                ->where('status', 'publish')
                ->latest()
                ->get();
        });

        $kategori = Cache::remember('semua_kategori', $cacheTTL, function() {
            return Kategori::withCount(['kursus' => function($query) {
                $query->where('status', 'publish');
            }])->get();
        });

        return view('katalog_flodemi', compact('kursus', 'kategori'));
    }

    public function show($id)
    {
        $cacheTTL = 3600; // 1 hour

        $kursus = Cache::remember("kursus_detail_{$id}", $cacheTTL, function() use ($id) {
            return Kursus::with(['kategori', 'mentor', 'modul'])
                ->withCount(['pendaftaran as terdaftar_count' => function($query) {
                    $query->whereIn('status', ['menunggu_pembayaran', 'menunggu_verifikasi', 'aktif', 'selesai'])
                        ->where(function($q) {
                            $q->whereHas('pembayaran', function($qp) {
                                $qp->where('expired_at', '>', now())
                                   ->orWhere('status', 'success');
                            })->orWhereNull('pembayaran_id');
                        });
                }])
                ->findOrFail($id);
        });

        $relatedCourses = Kursus::with(['kategori', 'mentor'])
            ->where('kategori_id', $kursus->kategori_id)
            ->where('id', '!=', $id)
            ->where('status', 'publish')
            ->take(4)
            ->get();

        return view('detail_course', compact('kursus', 'relatedCourses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'mentor_id'   => 'required|exists:users,id',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'kuota'       => 'required|integer|min:0',
            'status'      => 'required|in:aktif,nonaktif',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->imageService->upload(
                $request->file('gambar'),
                'kursus',
                1200,
                80
            );
        }

        $kursus = Kursus::create($data);

        return redirect()->back()->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kursus = Kursus::findOrFail($id);

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->imageService->upload(
                $request->file('gambar'),
                'kursus',
                1200,
                80,
                $kursus->gambar
            );
        }

        $kursus->update($data);

        return redirect()->back()->with('success', 'Kursus berhasil diperbarui.');
    }
}
