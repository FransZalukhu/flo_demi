<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (str_contains(request()->url(), 'ngrok-free.app')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        // Rate Limiters
        RateLimiter::for('critical-auth', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('superadmin-auth', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('payment-limit', function (Request $request) {
            return Limit::perHour(10)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('admin-reset-limit', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notifications = Notifikasi::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                
                $unreadCount = Notifikasi::where('user_id', Auth::id())
                    ->where('sudah_dibaca', false)
                    ->count();

                $view->with('global_notifications', $notifications);
                $view->with('global_unread_count', $unreadCount);
            }
        });
    }
}
