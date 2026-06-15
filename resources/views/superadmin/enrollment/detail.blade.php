<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Detail Transaksi'])
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'dashboard', 'activePage' => 'manajemen-pendaftaran'])

        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">
                
                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Detail Transaksi</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Informasi lengkap mengenai transaksi dan pendaftaran mentee.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('superadmin.enrollment.index') }}" class="text-brand-purple hover:underline">Manajemen Pendaftaran</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Detail Transaksi</span>
                    </div>
                </div>

                {{-- ══════════ CONTENT CARD ══════════ --}}
                <div class="p-6 md:p-4">
                    <div class="max-w-3xl mx-auto">
                        <div class="content-card">
                            <div class="p-8 md:p-5">

                                <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-100 dark:border-slate-900/50 flex-wrap gap-2">
                                    <div>
                                        <h4 class="text-lg font-extrabold text-slate-800 dark:text-white">#ENR-{{ $enrollment->id }}</h4>
                                        <small class="text-xs text-slate-400 dark:text-slate-500 font-bold">{{ $enrollment->created_at->format('d M Y, H:i') }} WIB</small>
                                    </div>
                                    @php
                                        $statusMap = [
                                            'menunggu_pembayaran' => ['bg' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400', 'label' => 'Belum Bayar'],
                                            'menunggu_verifikasi' => ['bg' => 'bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400', 'label' => 'Menunggu Verifikasi'],
                                            'aktif'               => ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400', 'label' => 'Aktif'],
                                            'ditolak'             => ['bg' => 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400', 'label' => 'Ditolak'],
                                            'selesai'             => ['bg' => 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300', 'label' => 'Selasai'],
                                        ];
                                        $cfg = $statusMap[$enrollment->status] ?? ['bg' => 'bg-slate-100 text-slate-600', 'label' => $enrollment->status];
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $cfg['bg'] }}">{{ $cfg['label'] }}</span>
                                </div>

                                <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                    <div>
                                        <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-user text-brand-purple text-xs mr-1"></i> Mentee</div>
                                        <div class="text-slate-800 dark:text-slate-200 text-sm font-bold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">{{ $enrollment->pengguna->username ?? '-' }}</div>
                                    </div>
                                    <div>
                                        <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-envelope text-brand-purple text-xs mr-1"></i> Email</div>
                                        <div class="text-slate-850 dark:text-slate-200 text-sm font-semibold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">{{ $enrollment->pengguna->email ?? '-' }}</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                    <div>
                                        <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-book text-brand-purple text-xs mr-1"></i> Kursus</div>
                                        <div class="text-slate-850 dark:text-slate-200 text-sm font-semibold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">{{ $enrollment->kursus->judul ?? '-' }}</div>
                                    </div>
                                    <div>
                                        <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-tag text-brand-purple text-xs mr-1"></i> Harga Kursus</div>
                                        <div class="text-brand-purple text-sm font-bold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">Rp {{ number_format($enrollment->kursus->harga ?? 0, 0, ',', '.') }}</div>
                                    </div>
                                </div>

                                @if($enrollment->pembayaran)
                                <div class="my-6 border-t border-slate-100 dark:border-slate-900/50 pt-6">
                                    <h5 class="text-sm font-extrabold text-slate-800 dark:text-white mb-5">Informasi Pembayaran</h5>

                                    <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                        <div>
                                            <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-credit-card text-brand-purple text-xs mr-1"></i> Jumlah Bayar</div>
                                            <div class="text-brand-purple text-sm font-bold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">Rp {{ number_format($enrollment->pembayaran->jumlah ?? 0, 0, ',', '.') }}</div>
                                        </div>
                                        <div>
                                            <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-clock text-brand-purple text-xs mr-1"></i> Status Pembayaran</div>
                                            <div class="pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">
                                                @php
                                                    $paymentStatusMap = [
                                                        'pending' => ['bg' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400', 'label' => 'Pending'],
                                                        'waiting' => ['bg' => 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400', 'label' => 'Menunggu'],
                                                        'success' => ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400', 'label' => 'Berhasil'],
                                                        'failed'  => ['bg' => 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400', 'label' => 'Gagal'],
                                                    ];
                                                    $payCfg = $paymentStatusMap[$enrollment->pembayaran->status] ?? ['bg' => 'bg-slate-100 text-slate-600', 'label' => $enrollment->pembayaran->status];
                                                @endphp
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg text-[10px] font-bold {{ $payCfg['bg'] }}">{{ $payCfg['label'] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if($enrollment->pembayaran->bukti)
                                    <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                        <div>
                                            <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-image text-brand-purple text-xs mr-1"></i> Bukti Transfer</div>
                                            <div class="pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">
                                                <a href="{{ asset('storage/' . $enrollment->pembayaran->bukti) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold border border-brand-purple/20 text-brand-purple hover:bg-brand-purple/10 transition-colors">
                                                    <i class="fas fa-eye text-[11px]"></i> Lihat Bukti
                                                </a>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-calendar text-brand-purple text-xs mr-1"></i> Batas Pembayaran</div>
                                            <div class="text-slate-850 dark:text-slate-200 text-sm font-semibold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">
                                                @if($enrollment->pembayaran->expired_at)
                                                    {{ $enrollment->pembayaran->expired_at->format('d M Y, H:i') }} WIB
                                                    @if($enrollment->pembayaran->expired_at < now())
                                                        <span class="inline-block bg-red-500 text-white text-[9px] px-1.5 py-0.5 rounded-md font-bold uppercase tracking-wider ml-1">Expired</span>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($enrollment->pembayaran->verifiedBy)
                                    <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                        <div>
                                            <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-user-check text-brand-purple text-xs mr-1"></i> Diverifikasi Oleh</div>
                                            <div class="text-slate-850 dark:text-slate-200 text-sm font-semibold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">{{ $enrollment->pembayaran->verifiedBy->username ?? '-' }}</div>
                                        </div>
                                        <div>
                                            <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-check-circle text-brand-purple text-xs mr-1"></i> Tanggal Verifikasi</div>
                                            <div class="text-slate-850 dark:text-slate-200 text-sm font-semibold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">
                                                @if($enrollment->pembayaran->verified_at)
                                                    {{ $enrollment->pembayaran->verified_at->format('d M Y, H:i') }} WIB
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($enrollment->pembayaran->catatan_admin)
                                    <div class="mt-4 p-4 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-950 rounded-xl">
                                        <div class="block text-[10px] font-bold uppercase tracking-wider text-red-500 dark:text-red-400 mb-1.5"><i class="fas fa-exclamation-circle text-red-500 text-xs mr-1"></i> Catatan Admin</div>
                                        <div class="text-red-700 dark:text-red-300 text-xs font-semibold">{{ $enrollment->pembayaran->catatan_admin }}</div>
                                    </div>
                                    @endif

                                    @if($enrollment->pembayaran->rejected_at)
                                    <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4 mt-4">
                                        <div>
                                            <div class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5"><i class="fas fa-times-circle text-brand-purple text-xs mr-1"></i> Tanggal Penolakan</div>
                                            <div class="text-slate-850 dark:text-slate-200 text-sm font-semibold pb-3 border-b border-slate-100 dark:border-slate-900/50 mb-5">{{ $enrollment->pembayaran->rejected_at->format('d M Y, H:i') }} WIB</div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <div class="flex justify-end pt-5 border-t border-slate-100 dark:border-slate-900/50">
                                    <a href="{{ route('superadmin.enrollment.index') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-center inline-flex items-center gap-1.5">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')
</body>

</html>
