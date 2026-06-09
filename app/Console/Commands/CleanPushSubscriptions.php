<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use NotificationChannels\WebPush\PushSubscription;
use Carbon\Carbon;

class CleanPushSubscriptions extends Command
{
    protected $signature = 'push:clean';

    protected $description = 'Membersihkan push subscriptions yang tidak valid atau kedaluwarsa';

    public function handle()
    {
        $this->info('Memulai pembersihan push subscriptions...');

        $orphaned = PushSubscription::whereDoesntHave('subscribable')->delete();

        $expired = PushSubscription::where('updated_at', '<', Carbon::now()->subDays(30))->delete();

        $this->info("Pembersihan selesai!");
        $this->info("- Subskripsi tanpa user dihapus: $orphaned");
        $this->info("- Subskripsi kedaluwarsa (>30 hari) dihapus: $expired");
    }
}

