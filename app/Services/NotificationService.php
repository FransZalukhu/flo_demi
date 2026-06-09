<?php

namespace App\Services;

use App\Models\Notifikasi;
use App\Models\User;
use App\Notifications\WebPushNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    public static function incrementVersion($userIds)
    {
        $ids = is_array($userIds) ? $userIds : [$userIds];
        foreach ($ids as $id) {
            $key = "notif_v_{$id}";
            Cache::has($key) ? Cache::increment($key) : Cache::put($key, 1, now()->addDays(7));
        }
    }

    /**
     * Kirim notifikasi ke semua admin & superadmin
     */
    public static function notifyAdmins(string $title, string $message, string $type = 'sistem', ?int $regId = null, ?string $url = null)
    {
        $admins = User::admins()->get();
        $ids = $admins->pluck('id')->toArray();
        $now = now();
        $batch = [];

        foreach ($ids as $id) {
            $batch[] = [
                'user_id'        => $id,
                'judul'          => $title,
                'pesan'          => $message,
                'tipe'           => $type,
                'pendaftaran_id' => $regId,
                'sudah_dibaca'   => false,
                'created_at'     => $now,
            ];
        }

        if (!empty($batch)) {
            Notifikasi::insert($batch);
            self::incrementVersion($ids);
            Notification::send($admins, new WebPushNotification($title, $message, $url));
        }
    }

    /**
     * Kirim notifikasi ke user spesifik
     */
    public static function notifyUser(int $userId, string $title, string $message, string $type = 'sistem', ?string $url = null)
    {
        Notifikasi::create([
            'user_id'      => $userId,
            'judul'        => $title,
            'pesan'        => $message,
            'tipe'         => $type,
            'sudah_dibaca' => false
        ]);

        self::incrementVersion($userId);

        if ($user = User::find($userId)) {
            $user->notify(new WebPushNotification($title, $message, $url));
        }
    }
}
