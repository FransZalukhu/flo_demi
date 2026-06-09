<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ModuleController extends Controller
{
    /**
     * Tampilkan daftar modul (opsional filter by kursus_id dari route)
     */
    public function index(Request $request, $kursusId = null)
    {
        $kursusAll = Kursus::orderBy('judul')->get();

        $query = Modul::with('kursus')->orderBy('kursus_id')->orderBy('urutan');

        // Filter by kursus_id dari route param atau query string
        $selectedKursusId = $kursusId ?? $request->get('kursus_id');
        if ($selectedKursusId) {
            $query->where('kursus_id', $selectedKursusId);
        }

        // Filter by search
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $moduls  = $query->get();
        $selectedKursus = $selectedKursusId ? Kursus::find($selectedKursusId) : null;

        return view('superadmin.course.modul', compact('moduls', 'kursusAll', 'selectedKursusId', 'selectedKursus'));
    }

    /**
     * Simpan modul baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'judul'     => 'required|string|max:255',
            'urutan'    => 'required|integer|min:1',
            'file'      => 'required|file|mimes:pdf|max:20480',
        ], [
            'kursus_id.required' => 'Kursus wajib dipilih.',
            'judul.required'     => 'Judul modul wajib diisi.',
            'urutan.required'    => 'Urutan wajib diisi.',
            'file.required'      => 'File PDF wajib diupload.',
            'file.mimes'         => 'File harus berformat PDF.',
            'file.max'           => 'Ukuran file maksimal 20MB.',
        ]);

        // Upload file ke storage/modul
        $filePath = $request->file('file')->store('modul', 'public');

        Modul::create([
            'kursus_id' => $request->kursus_id,
            'judul'     => $request->judul,
            'urutan'    => $request->urutan,
            'file'      => $filePath,
        ]);

        Cache::forget("kursus_detail_{$request->kursus_id}");

        return redirect()->back()->with('success', 'Modul berhasil ditambahkan.');
    }

    /**
     * Update modul
     */
    public function update(Request $request, $id)
    {
        $modul = Modul::findOrFail($id);

        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'judul'     => 'required|string|max:255',
            'urutan'    => 'required|integer|min:1',
            'file'      => 'nullable|file|mimes:pdf|max:20480',
        ], [
            'kursus_id.required' => 'Kursus wajib dipilih.',
            'judul.required'     => 'Judul modul wajib diisi.',
            'urutan.required'    => 'Urutan wajib diisi.',
            'file.mimes'         => 'File harus berformat PDF.',
            'file.max'           => 'Ukuran file maksimal 20MB.',
        ]);

        $data = [
            'kursus_id' => $request->kursus_id,
            'judul'     => $request->judul,
            'urutan'    => $request->urutan,
        ];

        // Ganti file jika ada upload baru
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($modul->file && Storage::disk('public')->exists($modul->file)) {
                Storage::disk('public')->delete($modul->file);
            }
            $data['file'] = $request->file('file')->store('modul', 'public');
        }

        $oldKursusId = $modul->kursus_id;
        $modul->update($data);

        Cache::forget("kursus_detail_{$oldKursusId}");
        if ($oldKursusId != $request->kursus_id) {
            Cache::forget("kursus_detail_{$request->kursus_id}");
        }

        return redirect()->back()->with('success', 'Modul berhasil diperbarui.');
    }

    /**
     * Hapus modul
     */
    public function destroy($id)
    {
        $modul = Modul::findOrFail($id);

        // Hapus file dari storage
        if ($modul->file && Storage::disk('public')->exists($modul->file)) {
            Storage::disk('public')->delete($modul->file);
        }

        $kursusId = $modul->kursus_id;
        $modul->delete();

        Cache::forget("kursus_detail_{$kursusId}");

        return redirect()->back()->with('success', 'Modul berhasil dihapus.');
    }
}