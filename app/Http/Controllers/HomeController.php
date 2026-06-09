<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        $kursus = Kursus::with(['kategori', 'mentor'])
            ->where('status', 'aktif')
            ->latest()
            ->paginate(8);

        $kategori = Kategori::all();

        return view('katalog_flodemi', compact('kursus', 'kategori'));
    }
}
