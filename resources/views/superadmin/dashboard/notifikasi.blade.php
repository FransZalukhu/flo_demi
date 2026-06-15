<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Notifikasi'])
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'dashboard', 'activePage' => 'dashboard-notification'])

        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Notifikasi</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Pantau semua aktivitas terbaru dan permintaan yang membutuhkan tindakan Anda.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Notifikasi</span>
                    </div>
                </div>

                {{-- ══════════ NOTIFICATION CARD ══════════ --}}
                <div class="p-6 md:p-4">
                    <div class="content-card">
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between flex-wrap gap-3">
                            <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                <i class="ri-notification-3-line text-brand-purple"></i>
                                Daftar Notifikasi
                                @if($notifications->count() > 0)
                                <span class="bg-brand-purple text-white text-[11px] px-2 py-0.5 rounded-full font-bold">
                                    {{ $notifications->count() }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 md:p-4 space-y-4">
                            @forelse ($notifications as $notif)
                                @php
                                    $actor = $notif->pendaftaran ? $notif->pendaftaran->pengguna : null;
                                    $actorName = $actor->username ?? 'User';
                                    if ($actor && $actor->photo) {
                                        $avatar = asset('storage/' . $actor->photo);
                                    } else {
                                        $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($actorName) . '&background=9F66AF&color=fff&size=128&font-size=0.4';
                                    }
                                @endphp

                                <div class="flex items-start gap-4 p-5 rounded-2xl border bg-white dark:bg-[#13111c] transition-all duration-300 relative hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-purple/5 hover:border-brand-purple/20 {{ !$notif->sudah_dibaca ? 'border-brand-purple/40 ring-1 ring-brand-purple/10' : 'border-slate-100 dark:border-slate-900' }}">
                                    @if(!$notif->sudah_dibaca)
                                        <span class="absolute top-5 right-5 w-2.5 h-2.5 rounded-full bg-brand-purple"></span>
                                    @endif

                                    {{-- Avatar --}}
                                    <div class="flex-shrink-0">
                                        <img src="{{ $avatar }}" alt="{{ $actorName }}" class="w-12 h-12 rounded-xl object-cover border-2 border-brand-purple-light dark:border-brand-purple-dark/20">
                                    </div>

                                    {{-- Content --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start gap-3 mb-1.5 md:flex-col md:gap-1">
                                            <div>
                                                <div class="text-xs font-bold text-brand-purple">{{ $actorName }}</div>
                                                <div class="text-sm font-extrabold text-slate-800 dark:text-white leading-tight mt-0.5">{{ $notif->judul }}</div>
                                            </div>
                                            <div class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 flex items-center gap-1 flex-shrink-0">
                                                <i class="ri-time-line"></i>
                                                @if($notif->created_at->isToday())
                                                    {{ $notif->created_at->translatedFormat('H.i \W\I\B') }}
                                                @elseif($notif->created_at->isYesterday())
                                                    Kemarin
                                                @else
                                                    {{ $notif->created_at->translatedFormat('d M Y') }}
                                                @endif
                                            </div>
                                        </div>

                                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $notif->pesan }}</p>

                                        {{-- Payment action box --}}
                                        @if($notif->pendaftaran_id && $notif->pendaftaran->status === 'menunggu_verifikasi')
                                            @php $pembayaran = $notif->pendaftaran->pembayaran; @endphp
                                            <div class="mt-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-900">
                                                <div class="flex items-center justify-between mb-3 flex-wrap gap-2 md:flex-col md:items-start">
                                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-[10px] font-bold bg-brand-purple-light dark:bg-brand-purple-dark/20 text-brand-purple">
                                                        <i class="ri-bank-card-line text-[11px]"></i>
                                                        Menunggu Verifikasi
                                                    </span>
                                                    @if($pembayaran && $pembayaran->bukti)
                                                        <a href="{{ asset('storage/' . $pembayaran->bukti) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-brand-purple hover:text-brand-purple-dark hover:underline transition-colors">
                                                            <i class="ri-image-line"></i> Lihat Bukti Transfer
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="flex gap-2 flex-wrap">
                                                    <form action="{{ route('superadmin.course.approve', $notif->pendaftaran_id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-500 text-white text-xs font-bold rounded-lg shadow-md shadow-emerald-500/15 hover:shadow-lg hover:shadow-emerald-500/25 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                                                            <i class="ri-check-line"></i> Setujui
                                                        </button>
                                                    </form>
                                                    <button type="button" class="inline-flex items-center gap-1.5 px-4 py-2 bg-transparent text-red-500 border border-red-500/30 text-xs font-bold rounded-lg hover:bg-red-500/10 hover:border-red-500 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer" onclick="showRejectModal({{ $notif->pendaftaran_id }})">
                                                        <i class="ri-close-line"></i> Tolak
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            @empty
                                {{-- Empty State --}}
                                <div class="flex flex-col items-center justify-center py-16 px-5 text-center">
                                    <div class="mb-7 animate-pulse">
                                        <svg class="w-48 h-48" viewBox="0 0 280 280" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="bellGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#9F66AF;stop-opacity:1" />
                                                    <stop offset="100%" style="stop-color:#7B4A8A;stop-opacity:1" />
                                                </linearGradient>
                                                <linearGradient id="bgGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#F3E8F7;stop-opacity:1" />
                                                    <stop offset="100%" style="stop-color:#E8D5F0;stop-opacity:1" />
                                                </linearGradient>
                                            </defs>
                                            <circle cx="140" cy="140" r="125" fill="url(#bgGradient)" opacity="0.35"/>
                                            <g>
                                                <path d="M140 60 C100 60, 80 90, 80 130 L80 170 L60 190 L60 200 L220 200 L220 190 L200 170 L200 130 C200 90, 180 60, 140 60 Z"
                                                      fill="url(#bellGradient)" stroke="#8B56A0" stroke-width="2"/>
                                                <ellipse cx="140" cy="60" rx="15" ry="8" fill="url(#bellGradient)" stroke="#8B56A0" stroke-width="2"/>
                                                <circle cx="140" cy="205" r="12" fill="#8B56A0"/>
                                                <path d="M140 52 L140 40" stroke="#8B56A0" stroke-width="4" stroke-linecap="round"/>
                                                <circle cx="140" cy="38" r="5" fill="#8B56A0"/>
                                                <path d="M55 120 Q45 130, 55 140" fill="none" stroke="#9F66AF" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
                                                <path d="M45 110 Q30 130, 45 150" fill="none" stroke="#9F66AF" stroke-width="3" stroke-linecap="round" opacity="0.4"/>
                                                <path d="M225 120 Q235 130, 225 140" fill="none" stroke="#9F66AF" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
                                                <path d="M235 110 Q250 130, 235 150" fill="none" stroke="#9F66AF" stroke-width="3" stroke-linecap="round" opacity="0.4"/>
                                            </g>
                                            <g transform="translate(195, 158)">
                                                <circle cx="0" cy="0" r="20" fill="#10b981" opacity="0.9"/>
                                                <path d="M-8 0 L-3 5 L8 -6" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-extrabold text-slate-800 dark:text-white mb-2">Tidak ada notifikasi</h3>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm leading-relaxed">
                                        Semua aktivitas sudah terkini. Notifikasi baru akan muncul di sini saat ada perubahan atau permintaan dari mentee.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ REJECT MODAL ══════════ --}}
    <div id="rejectModal" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-md transform transition-all scale-95 opacity-0 m-auto mt-20" id="rejectModalContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="ri-close-circle-line text-red-500 text-lg"></i>
                    Tolak Pembayaran
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" onclick="hideRejectModal()">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="p-6 text-sm text-slate-500 dark:text-slate-400 space-y-4">
                    <p class="text-xs leading-relaxed">
                        Berikan alasan penolakan agar mentee dapat memperbaiki bukti pembayarannya.
                    </p>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Alasan Penolakan</label>
                        <textarea name="catatan" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-800 dark:text-slate-200 text-sm focus:outline-none focus:bg-white dark:focus:bg-[#13111c] focus:border-brand-purple focus:ring-4 focus:ring-brand-purple/10 transition-all min-h-[100px]" placeholder="Contoh: Bukti transfer tidak terbaca atau nominal kurang." required></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                    <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" onclick="hideRejectModal()">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-red-500 text-white shadow-md shadow-red-500/15 hover:bg-red-600 hover:shadow-lg transition-all flex items-center gap-1 cursor-pointer">
                        <i class="ri-close-circle-line"></i> Konfirmasi Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
        const rejectModal = document.getElementById('rejectModal');
        const rejectModalContent = document.getElementById('rejectModalContent');

        function showRejectModal(id) {
            const form = document.getElementById('rejectForm');
            form.action = `/superadmin/course/reject/${id}`;
            
            rejectModal.style.display = 'flex';
            rejectModal.classList.remove('hidden');
            setTimeout(() => {
                rejectModalContent.classList.remove('scale-95', 'opacity-0');
                rejectModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function hideRejectModal() {
            rejectModalContent.classList.remove('scale-100', 'opacity-100');
            rejectModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                rejectModal.classList.add('hidden');
                rejectModal.style.display = 'none';
            }, 200);
        }

        if (rejectModal) {
            rejectModal.addEventListener('click', function(e) {
                if (e.target === rejectModal) hideRejectModal();
            });
        }
    </script>
</body>

</html>