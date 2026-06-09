<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show($id)
    {
        $kursus = Kursus::with(['mentor', 'kategori', 'modul'])->findOrFail($id);

        if ($error = $this->checkRegistrationError($kursus)) return $error;

        return view($kursus->harga == 0 ? 'mentee.checkout.course_gratis_&_kuota_penuh' : 'mentee.checkout.checkout_berbayar', compact('kursus'));
    }

    public function joinGratis($id)
    {
        try {
            $redirect = DB::transaction(function () use ($id) {
                $kursus = Kursus::lockForUpdate()->findOrFail($id);
                
                if ($error = $this->checkRegistrationError($kursus)) {
                    return $error;
                }

                Pendaftaran::create([
                    'user_id'   => auth()->id(),
                    'kursus_id' => $id,
                    'status'    => 'aktif',
                ]);

                return null;
            });

            if ($redirect) {
                return $redirect;
            }

            $kursus = Kursus::findOrFail($id);

            NotificationService::notifyAdmins(
                'Pendaftaran Gratis',
                auth()->user()->username . ' bergabung ke ' . $kursus->judul,
                'sistem'
            );

            return redirect()->route('mentee.course.saya')->with('success', 'Berhasil bergabung ke kelas ' . $kursus->judul . '!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Gagal memproses pendaftaran.');
        }
    }

    public function joinBerbayar($id)
    {
        try {
            $result = DB::transaction(function () use ($id) {
                $kursus = Kursus::lockForUpdate()->findOrFail($id);

                if ($error = $this->checkRegistrationError($kursus)) {
                    return $error;
                }

                $pembayaran = \App\Models\Pembayaran::create([
                    'user_id'    => auth()->id(),
                    'kursus_id'  => $id,
                    'jumlah'     => $kursus->harga,
                    'status'     => 'pending',
                    'expired_at' => now()->addHours(24),
                ]);

                $reg = Pendaftaran::create([
                    'user_id'       => auth()->id(),
                    'kursus_id'     => $id,
                    'pembayaran_id' => $pembayaran->id,
                    'status'        => 'menunggu_pembayaran',
                ]);

                return compact('pembayaran', 'reg');
            });

            if ($result instanceof \Illuminate\Http\RedirectResponse) {
                return $result;
            }

            $kursus = Kursus::findOrFail($id);

            NotificationService::notifyAdmins(
                'Pesanan Kursus Baru',
                auth()->user()->username . ' memesan ' . $kursus->judul,
                'pembayaran',
                $result['reg']->id
            );

            return redirect()->route('mentee.pembayaran.invoice', $result['pembayaran']->id);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Gagal memproses pesanan.');
        }
    }

    private function checkRegistrationError($kursus)
    {
        if ($kursus->isFull()) {
            return redirect()->route('kursus.show', $kursus->id)->with('error', 'Maaf, kuota sudah penuh.');
        }

        $existing = Pendaftaran::where('user_id', auth()->id())
            ->where('kursus_id', $kursus->id)
            ->first();

        if ($existing) {
            if (in_array($existing->status, ['aktif', 'selesai', 'menunggu_verifikasi'])) {
                return redirect()->route('mentee.course.saya')->with('info', 'Kamu sudah terdaftar.');
            }
            
            if (in_array($existing->status, ['menunggu_pembayaran', 'ditolak'])) {
                return redirect()->route('mentee.pembayaran.invoice', $existing->pembayaran_id)
                    ->with('info', 'Selesaikan pembayaran untuk pendaftaran sebelumnya.');
            }
        }

        return null;
    }
}
