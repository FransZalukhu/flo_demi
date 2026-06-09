<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Services\ImageUploadService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function invoice($id)
    {
        $payment = Pembayaran::with(['kursus', 'verifiedBy'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        if ($payment->status === 'success') {
            return redirect()->route('mentee.course.detail', $payment->kursus_id);
        }

        return view('mentee.pembayaran.invoice', compact('payment'));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $payment = Pembayaran::where('user_id', auth()->id())->findOrFail($id);

        if (in_array($payment->status, ['success', 'waiting'])) {
            return back()->with('error', 'Pembayaran sedang diproses atau sudah berhasil.');
        }

        if ($payment->expired_at && Carbon::now()->gt($payment->expired_at)) {
            return back()->with('error', 'Waktu pembayaran sudah habis (expired).');
        }

        DB::transaction(function () use ($request, $payment) {
            $path = $this->imageService->upload(
                $request->file('bukti'), 
                'bukti_transfer', 
                1000, 
                80, 
                $payment->bukti
            );

            $payment->update([
                'bukti'  => $path,
                'status' => 'waiting'
            ]);

            Pendaftaran::where('pembayaran_id', $payment->id)->update([
                'status' => 'menunggu_verifikasi'
            ]);

            NotificationService::notifyAdmins(
                'Bukti Pembayaran Baru',
                auth()->user()->username . ' mengupload bukti transfer: ' . $payment->kursus->judul,
                'pembayaran',
                $payment->pendaftaran?->id
            );
        });

        return back()->with('success', 'Bukti berhasil diupload. Mohon tunggu verifikasi admin.');
    }

    public function history()
    {
        $payments = Pembayaran::with(['kursus', 'verifiedBy'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('mentee.pembayaran.riwayat', compact('payments'));
    }

    public function detail($id)
    {
        $payment = Pembayaran::with(['kursus', 'verifiedBy'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('mentee.pembayaran.detail', compact('payment'));
    }
}
