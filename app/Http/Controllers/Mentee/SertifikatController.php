<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Services\CertificateService;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    protected $certificateService;

    public function __construct(CertificateService $certificateService)
    {
        $this->certificateService = $certificateService;
    }

    /**
     * Show all certificates for the authenticated mentee.
     */
    public function index()
    {
        $sertifikat = auth()->user()->sertifikat()
            ->with('kursus')
            ->orderBy('tanggal_terbit', 'desc')
            ->get();

        return view('mentee.sertifikat.index', compact('sertifikat'));
    }

    /**
     * Download certificate file.
     */
    public function download($id)
    {
        $cert = Sertifikat::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        if (!$cert->file_sertifikat || !Storage::disk('public')->exists($cert->file_sertifikat)) {
            $this->certificateService->generatePdf($cert);
        }

        return Storage::disk('public')->download($cert->file_sertifikat);
    }
}
