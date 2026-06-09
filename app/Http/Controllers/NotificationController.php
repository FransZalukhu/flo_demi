<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    public function getLatest(Request $request)
    {
        $userId = Auth::id();
        $limit = $request->query('limit', 5);
        $clientVersion = $request->query('v', 0);

        $serverVersion = Cache::get("notif_v_{$userId}", 0);

        if ($clientVersion > 0 && $clientVersion == $serverVersion) {
            return response()->json([
                'success' => true,
                'notifications' => [],
                'unreadCount' => null,
                'v' => $serverVersion,
                'no_change' => true
            ]);
        }

        $notifications = Notifikasi::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($notif) {
                // Add diffForHumans for easy frontend display
                $notif->time_ago = $notif->created_at->diffForHumans();
                $notif->time_iso = $notif->created_at->toIso8601String();
                return $notif;
            });

        $unreadCount = Notifikasi::where('user_id', $userId)
            ->where('sudah_dibaca', false)
            ->count();

        return response()->json([
            'success' => true,
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
            'v' => $serverVersion
        ]);
    }

    public function markAllRead()
    {
        Notifikasi::where('user_id', Auth::id())
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi ditandai sebagai dibaca.'
        ]);
    }

    public function readAndRedirect($id)
    {
        $notification = Notifikasi::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $notification->update(['sudah_dibaca' => true]);

        // Admin/Superadmin redirection
        if (in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            if ($notification->tipe === 'pembayaran' && $notification->pendaftaran_id) {
                return redirect()->route('superadmin.enrollment.index', ['status' => 'menunggu_verifikasi']);
            }
            return redirect()->route('superadmin.dashboard.notifikasi');
        }

        // Mentee redirection
        if ($notification->tipe === 'pembayaran' && $notification->pendaftaran_id) {
            $reg = $notification->pendaftaran;
            
            if (in_array($reg->status, ['menunggu_pembayaran', 'ditolak'])) {
                return redirect()->route('mentee.pembayaran.invoice', $reg->pembayaran_id);
            }
            
            return redirect()->route('mentee.course.detail', $reg->kursus_id);
        }

        return redirect()->route('mentee.dashboard');
    }
}
