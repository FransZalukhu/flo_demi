<?php

namespace App\Services;

use App\Models\Sertifikat;
use App\Models\Kursus;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateService
{
    public function issue(User $user, Kursus $course): Sertifikat
    {
        $existing = Sertifikat::where('user_id', $user->id)
            ->where('kursus_id', $course->id)
            ->first();

        if ($existing) {
            return $existing;
        }

        $prefix = 'FL/' . now()->format('Y') . '/' . str_pad($user->id, 4, '0', STR_PAD_LEFT) . '/' . str_pad($course->id, 3, '0', STR_PAD_LEFT) . '/';

        do {
            $certNo = $prefix . strtoupper(Str::random(12));
        } while (Sertifikat::where('nomor_sertifikat', $certNo)->exists());

        return Sertifikat::create([
            'user_id'          => $user->id,
            'kursus_id'        => $course->id,
            'nomor_sertifikat' => $certNo,
            'tanggal_terbit'   => now()
        ]);
    }

    public function generatePdf(Sertifikat $cert): string
    {
        $user = $cert->pengguna;
        $course = $cert->kursus;
        $fileHash = hash('sha256', $cert->nomor_sertifikat . $user->id . $course->id);
        $path = 'sertifikat/' . $fileHash . '.pdf';

        $data = [
            'name'    => strtoupper($user->name ?? $user->username),
            'course'  => $course->judul,
            'date'    => $cert->tanggal_terbit->translatedFormat('d F Y'),
            'cert_no' => $cert->nomor_sertifikat
        ];

        $pdf = Pdf::loadView('certificates.template', $data)->setPaper('a4', 'landscape');

        Storage::disk('local')->put($path, $pdf->output());

        $cert->update(['file_sertifikat' => $path]);

        return $path;
    }
}
