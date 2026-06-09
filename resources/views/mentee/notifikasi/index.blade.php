@extends('layouts.mentee.sidebar')

@section('title', 'Notifikasi Saya - Flodemi')

@section('main-content')
<div class="max-w-4xl mx-auto space-y-8 animate-slide-in">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Notifikasi</h1>
            <p class="text-slate-500 dark:text-gray-400 mt-2 font-medium">Pantau semua aktivitas dan update terbaru kamu.</p>
        </div>
        @if($notifications->count() > 0)
            <button onclick="markAllAsRead()" class="flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 rounded-2xl text-sm font-bold text-slate-600 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-800 transition-all shadow-sm">
                <i class="ri-check-double-line text-lg text-brand-purple"></i>
                Tandai Semua Dibaca
            </button>
        @endif
    </div>

    {{-- Notification List --}}
    <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] border border-slate-100 dark:border-gray-800 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        @forelse($notifications as $notif)
            <a href="{{ route('notifikasi.read', $notif->id) }}" 
               class="group block p-4 sm:p-6 md:p-8 transition-all hover:bg-slate-50 dark:hover:bg-gray-800/50 border-b border-slate-50 dark:border-gray-800 last:border-0 {{ !$notif->sudah_dibaca ? 'bg-brand-purple-light/10 dark:bg-brand-purple/5' : '' }}">
                <div class="flex items-start gap-4 sm:gap-6">
                    {{-- Icon Box --}}
                    <div class="flex h-10 w-10 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-xl sm:rounded-2xl text-lg sm:text-2xl transition-transform group-hover:scale-110
                        @if($notif->tipe == 'pembayaran') bg-amber-50 text-amber-500 dark:bg-amber-500/10 
                        @elseif($notif->tipe == 'pengumuman') bg-blue-50 text-blue-500 dark:bg-blue-500/10 
                        @else bg-purple-50 text-brand-purple dark:bg-brand-purple/10 @endif">
                        @if($notif->tipe == 'pembayaran')
                            <i class="ri-bank-card-line"></i>
                        @elseif($notif->tipe == 'pengumuman')
                            <i class="ri-megaphone-line"></i>
                        @else
                            <i class="ri-notification-3-line"></i>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-1 sm:gap-4">
                            <h3 class="text-sm sm:text-lg {{ !$notif->sudah_dibaca ? 'font-bold' : 'font-semibold' }} text-slate-800 dark:text-white leading-tight">
                                {{ $notif->judul }}
                            </h3>
                            <span class="text-[10px] sm:text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest whitespace-nowrap">
                                {{ $notif->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-gray-400 mt-1.5 sm:mt-2 leading-relaxed {{ !$notif->sudah_dibaca ? 'font-medium' : '' }}">
                            {{ $notif->pesan }}
                        </p>
                    </div>

                    {{-- Unread Indicator --}}
                    @if(!$notif->sudah_dibaca)
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-brand-purple shadow-lg shadow-purple-200 dark:shadow-none mt-2"></div>
                    @endif
                </div>
            </a>
        @empty
            <div class="py-24 text-center">
                <div class="inline-flex h-24 w-24 items-center justify-center rounded-[2rem] bg-slate-50 dark:bg-gray-800 text-slate-200 dark:text-gray-700 mb-6">
                    <i class="ri-notification-3-line text-5xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Belum ada notifikasi</h3>
                <p class="text-slate-400 dark:text-gray-500 mt-2">Semua update terbaru akan muncul di sini.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $notifications->links() }}
    </div>
</div>

<script>
    function markAllAsRead() {
        fetch('{{ route("notifikasi.readAll") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) window.location.reload();
        })
        .catch(err => console.error('Error marking all as read:', err));
    }
</script>
@endsection
