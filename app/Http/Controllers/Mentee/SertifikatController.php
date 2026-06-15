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

    public function download($id)
    {
        $cert = Sertifikat::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $pdfExists = $cert->file_sertifikat && Storage::disk('local')->exists($cert->file_sertifikat);
        $needsRegen = false;

        if ($pdfExists) {
            $pdfTime = Storage::disk('local')->lastModified($cert->file_sertifikat);
            $userTime = auth()->user()->updated_at ? auth()->user()->updated_at->timestamp : 0;
            if ($userTime > $pdfTime) {
                $needsRegen = true;
            }
        }

        if (!$pdfExists || $needsRegen) {
            $this->certificateService->generatePdf($cert);
            $cert->refresh();
        }

        return Storage::disk('local')->download($cert->file_sertifikat);
    }
}
