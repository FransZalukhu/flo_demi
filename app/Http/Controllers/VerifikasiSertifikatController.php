<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;

class VerifikasiSertifikatController extends Controller
{
    public function verify(Request $request)
    {
        $nomor = $request->query('nomor');
        $sertifikat = null;

        if ($nomor) {
            $sertifikat = Sertifikat::with([
                    'pengguna:id,username',
                    'kursus:id,judul'
                ])
                ->where('nomor_sertifikat', trim($nomor))
                ->first();
        }

        return view('verifikasi_sertifikat', compact('sertifikat', 'nomor'));
    }
}
