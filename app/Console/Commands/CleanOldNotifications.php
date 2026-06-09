<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notifikasi;
use Carbon\Carbon;

class CleanOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus notifikasi lama untuk menjaga performa database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pembersihan notifikasi...');

        // 1. Hapus semua notifikasi yang sudah dibaca lebih dari 7 hari yang lalu
        $readDeleted = Notifikasi::where('sudah_dibaca', true)
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->delete();

        // 2. Hapus semua notifikasi (walaupun belum dibaca) yang lebih dari 30 hari
        $oldDeleted = Notifikasi::where('created_at', '<', Carbon::now()->subDays(30))
            ->delete();

        $this->info("Pembersihan selesai!");
        $this->info("- Notifikasi dibaca (>7 hari) dihapus: $readDeleted");
        $this->info("- Notifikasi lama (>30 hari) dihapus: $oldDeleted");
    }
}
