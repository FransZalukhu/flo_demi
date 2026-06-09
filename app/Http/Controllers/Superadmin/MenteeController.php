<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class MenteeController extends Controller
{
    public function MenteeList(Request $request)
    {
        // Ambil semua kategori untuk filter dropdown
        $kategoris = Kategori::orderBy('nama')->get();

        // Query mentee (role = mentee) beserta kursus dan kategori
        $query = User::where('role', 'mentee')
            ->with(['kursus.kategori']);

        // Filter berdasarkan kategori jika dipilih
        if ($request->filled('kategori_id')) {
            $query->whereHas('kursus', function ($q) use ($request) {
                $q->where('kategori_id', $request->kategori_id);
            });
        }

        // Filter berdasarkan search (nama mentee)
        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        $mentees = $query->paginate(10);

        return view('superadmin.mentee.list_mentee', compact('mentees', 'kategoris'));
    }
}