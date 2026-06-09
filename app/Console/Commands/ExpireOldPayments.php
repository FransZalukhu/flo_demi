<?php

namespace App\Console\Commands;

use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireOldPayments extends Command
{
    protected $signature = 'payments:expire';
    protected $description = 'Auto-reject pembayaran yang sudah expired';

    public function handle()
    {
        $now = Carbon::now();
        
        $expired = Pembayaran::where('status', 'pending')
            ->where('expired_at', '<', $now)
            ->get();

        foreach ($expired as $payment) {
            $this->expirePayment($payment);
        }

        $count = $expired->count();
        $this->info("Proses selesai. Total pembayaran expired: $count");
    }

    private function expirePayment(Pembayaran $payment)
    {
        $payment->update([
            'status' => 'failed',
            'catatan_admin' => 'Pembayaran expired (timeout 24 jam)',
            'rejected_at' => now()
        ]);

        $reg = Pendaftaran::where('pembayaran_id', $payment->id)->first();
        
        if ($reg) {
            $reg->update(['status' => 'ditolak']);

            NotificationService::notifyUser(
                $payment->user_id,
                'Pembayaran Expired',
                'Pendaftaran untuk ' . $reg->kursus->judul . ' dibatalkan karena pembayaran tidak selesai dalam 24 jam.',
                'sistem'
            );
        }
    }
}
