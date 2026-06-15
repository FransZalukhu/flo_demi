@extends('layouts.mentee.sidebar')

@section('title', 'Riwayat Transaksi - Flodemi')

@section('main-content')
    <header class="mb-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Riwayat Transaksi</h2>
                <p class="text-slate-500 dark:text-gray-400 font-medium">Pantau semua status pembayaran kursus kamu.</p>
            </div>
        </div>
    </header>

    <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] border border-slate-100 dark:border-gray-800 shadow-sm overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-gray-800/30 text-slate-400 dark:text-gray-500 text-[11px] font-black uppercase tracking-widest border-b border-slate-50 dark:border-gray-800">
                        <th class="px-8 py-6">ID Transaksi</th>
                        <th class="px-8 py-6">Kursus</th>
                        <th class="px-8 py-6">Nominal</th>
                        <th class="px-8 py-6">Status</th>
                        <th class="px-8 py-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-gray-800">
                    @forelse($payments as $payment)
                    @php
                        $isExpired = $payment->status === 'pending' && $payment->expired_at && $payment->expired_at->isPast();
                        $cfg = match($payment->status) {
                            'pending' => $isExpired 
                                ? ['bg' => 'bg-red-100 text-red-700', 'label' => 'Expired']
                                : ['bg' => 'bg-amber-100 text-amber-700', 'label' => 'Belum Bayar'],
                            'waiting' => ['bg' => 'bg-blue-100 text-blue-700', 'label' => 'Verifikasi'],
                            'success' => ['bg' => 'bg-emerald-100 text-emerald-700', 'label' => 'Berhasil'],
                            'failed'  => ['bg' => 'bg-red-100 text-red-700', 'label' => 'Ditolak'],
                        };
                    @endphp
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-colors">
                        <td class="px-8 py-6">
                            <span class="text-[13px] font-bold text-slate-700 dark:text-gray-300">#PAY-{{ $payment->id }}</span>
                            <div class="text-[10px] text-slate-400 mt-1 font-bold">{{ $payment->created_at->format('d M Y, H:i') }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl overflow-hidden shrink-0 bg-slate-100 dark:bg-gray-800">
                                    <img src="{{ $payment->kursus->gambar ? asset('storage/' . $payment->kursus->gambar) : asset('assets/default-course.png') }}" class="w-full h-full object-cover">
                                </div>
                                <span class="text-[13px] font-black text-slate-900 dark:text-white truncate max-w-[200px]">{{ $payment->kursus->judul }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-[14px] font-black text-brand-purple">Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-4 py-1.5 {{ $cfg['bg'] }} rounded-full text-[10px] font-black uppercase tracking-widest">
                                {{ $cfg['label'] }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('mentee.pembayaran.detail', $payment->id) }}" 
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 dark:bg-gray-800 text-slate-600 dark:text-gray-300 text-[10px] font-black rounded-lg hover:bg-slate-200 dark:hover:bg-gray-700 transition-all border border-slate-200 dark:border-gray-700"
                                   title="Lihat Detail Transaksi">
                                    <i class="ri-eye-line text-xs"></i>
                                    DETAIL
                                </a>

                                @if(($payment->status === 'pending' || $payment->status === 'failed') && !$isExpired)
                                    <a href="{{ route('mentee.pembayaran.invoice', $payment->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-purple text-white text-[10px] font-black rounded-lg hover:scale-105 transition-all shadow-lg shadow-purple-100 dark:shadow-none whitespace-nowrap">
                                        <i class="ri-wallet-3-line"></i>
                                        BAYAR SEKARANG
                                    </a>
                                @elseif($isExpired)
                                    <span class="text-[10px] font-bold text-red-500 uppercase tracking-tighter">
                                        <i class="ri-close-circle-line text-xs"></i> EXPIRED
                                    </span>
                                @elseif($payment->status === 'waiting')
                                    <a href="{{ route('mentee.pembayaran.invoice', $payment->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white text-[10px] font-black rounded-lg hover:scale-105 transition-all shadow-lg shadow-blue-100 dark:shadow-none whitespace-nowrap">
                                        <i class="ri-time-line"></i>
                                        CEK INVOICE
                                    </a>
                                @else
                                    <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-tighter">
                                        <i class="ri-checkbox-circle-line text-xs"></i> SELESAI
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 dark:bg-gray-800 rounded-3xl flex items-center justify-center text-slate-200 dark:text-gray-700 mb-4">
                                    <i class="ri-refund-2-line text-4xl"></i>
                                </div>
                                <p class="text-sm font-bold text-slate-400 dark:text-gray-500">Belum ada riwayat transaksi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="block md:hidden divide-y divide-slate-100 dark:divide-gray-800">
            @forelse($payments as $payment)
            @php
                $isExpired = $payment->status === 'pending' && $payment->expired_at && $payment->expired_at->isPast();
                $cfg = match($payment->status) {
                    'pending' => $isExpired 
                        ? ['bg' => 'bg-red-100 text-red-700', 'label' => 'Expired']
                        : ['bg' => 'bg-amber-100 text-amber-700', 'label' => 'Belum Bayar'],
                    'waiting' => ['bg' => 'bg-blue-100 text-blue-700', 'label' => 'Verifikasi'],
                    'success' => ['bg' => 'bg-emerald-100 text-emerald-700', 'label' => 'Berhasil'],
                    'failed'  => ['bg' => 'bg-red-100 text-red-700', 'label' => 'Ditolak'],
                };
            @endphp
            <div class="p-6 space-y-4 hover:bg-slate-50/30 dark:hover:bg-gray-800/10 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[12px] font-bold text-slate-500 dark:text-gray-400">#PAY-{{ $payment->id }}</span>
                        <div class="text-[10px] text-slate-400 dark:text-gray-500 font-medium">{{ $payment->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <span class="px-2.5 py-1 {{ $cfg['bg'] }} rounded-full text-[9px] font-black uppercase tracking-wider">
                        {{ $cfg['label'] }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-slate-100 dark:bg-gray-800 border border-slate-100 dark:border-gray-700">
                        <img src="{{ $payment->kursus->gambar ? asset('storage/' . $payment->kursus->gambar) : asset('assets/default-course.png') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="text-[13px] font-black text-slate-900 dark:text-white truncate mb-0.5">{{ $payment->kursus->judul }}</h4>
                        <span class="text-[13px] font-black text-brand-purple">Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <a href="{{ route('mentee.pembayaran.detail', $payment->id) }}" 
                       class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-slate-50 dark:bg-gray-800 text-slate-600 dark:text-gray-300 text-[10px] font-black rounded-lg hover:bg-slate-100 dark:hover:bg-gray-700 transition-colors border border-slate-200 dark:border-gray-700">
                        <i class="ri-eye-line text-xs"></i>
                        DETAIL
                    </a>

                    @if(($payment->status === 'pending' || $payment->status === 'failed') && !$isExpired)
                        <a href="{{ route('mentee.pembayaran.invoice', $payment->id) }}" 
                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-brand-purple text-white text-[10px] font-black rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="ri-wallet-3-line"></i>
                            BAYAR
                        </a>
                    @elseif($isExpired)
                        <span class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-red-50 dark:bg-red-950/20 text-red-600 dark:text-red-400 text-[10px] font-black rounded-lg">
                            <i class="ri-close-circle-line"></i> EXPIRED
                        </span>
                    @elseif($payment->status === 'waiting')
                        <a href="{{ route('mentee.pembayaran.invoice', $payment->id) }}" 
                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-blue-500 text-white text-[10px] font-black rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="ri-time-line"></i>
                            INVOICE
                        </a>
                    @else
                        <span class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-[10px] font-black rounded-lg">
                            <i class="ri-checkbox-circle-line"></i> SELESAI
                        </span>
                    @endif
                </div>
            </div>
            @empty
            <div class="px-8 py-20 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-slate-50 dark:bg-gray-800 rounded-3xl flex items-center justify-center text-slate-200 dark:text-gray-700 mb-4">
                        <i class="ri-refund-2-line text-4xl"></i>
                    </div>
                    <p class="text-sm font-bold text-slate-400 dark:text-gray-500">Belum ada riwayat transaksi.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($payments->hasPages())
        <div class="px-8 py-6 bg-slate-50/50 dark:bg-gray-800/30 border-t border-slate-50 dark:border-gray-800">
            {{ $payments->links() }}
        </div>
        @endif
    </div>
@endsection
