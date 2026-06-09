<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        
        $query = Pendaftaran::with(['pengguna', 'kursus', 'pembayaran'])
            ->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $enrollments = $query->paginate(15);

        return view('superadmin.enrollment.index', compact('enrollments'));
    }

    public function detail($id)
    {
        $enrollment = Pendaftaran::with(['pengguna', 'kursus', 'pembayaran', 'pembayaran.verifiedBy'])
            ->findOrFail($id);

        return view('superadmin.enrollment.detail', compact('enrollment'));
    }

    public function approve($id)
    {
        $reg = Pendaftaran::findOrFail($id);
        $payment = $reg->pembayaran;

        if (!$payment) {
            return back()->with('error', 'Pembayaran tidak ditemukan.');
        }

        if ($payment->expired_at && $payment->expired_at < now()) {
            return back()->with('error', 'Pembayaran sudah expired. Silakan tolak dan minta mentee untuk checkout ulang.');
        }

        if (!$payment->bukti) {
            return back()->with('error', 'Bukti pembayaran belum diupload.');
        }

        if (!in_array($payment->status, ['waiting', 'pending'])) {
            return back()->with('error', 'Status pembayaran tidak valid untuk disetujui.');
        }

        $reg->update(['status' => 'aktif']);
        $payment->update([
            'status' => 'success',
            'verified_by' => auth()->id(),
            'verified_at' => now()
        ]);

        NotificationService::notifyUser(
            $reg->user_id,
            'Pendaftaran Disetujui',
            'Selamat! Pendaftaran kursus ' . $reg->kursus->judul . ' telah disetujui. Silakan mulai belajar!',
            'sistem'
        );

        return back()->with('success', 'Pendaftaran disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['catatan' => 'required|string|max:255']);
        
        $reg = Pendaftaran::findOrFail($id);
        $reg->update(['status' => 'ditolak']);

        if ($reg->pembayaran_id) {
            Pembayaran::where('id', $reg->pembayaran_id)->update([
                'status' => 'failed',
                'catatan_admin' => $request->catatan,
                'verified_by' => auth()->id(),
                'rejected_at' => now()
            ]);
        }

        NotificationService::notifyUser(
            $reg->user_id,
            'Pembayaran Ditolak',
            'Pendaftaran kursus ' . $reg->kursus->judul . ' ditolak. Alasan: ' . $request->catatan . ' Silakan checkout ulang dengan bukti pembayaran yang valid.',
            'sistem'
        );

        return back()->with('success', 'Pendaftaran ditolak.');
    }
}
