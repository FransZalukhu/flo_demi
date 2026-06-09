@extends('layouts.mentee.navbar')

@section('title', 'Detail Transaksi - Flodemi')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] dark:bg-gray-950 py-12 px-6">
    <div class="max-w-4xl mx-auto">
        
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('mentee.pembayaran.riwayat') }}" class="w-10 h-10 bg-white dark:bg-gray-900 rounded-full flex items-center justify-center border border-slate-200 dark:border-gray-800 text-slate-600 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-800 transition-all">
                <i class="ri-arrow-left-line text-lg"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Detail Transaksi</h2>
                <p class="text-sm text-slate-500 dark:text-gray-400">Informasi lengkap transaksi pembayaran</p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-gray-800 shadow-sm mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-8 border-b border-slate-50 dark:border-gray-800">
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white mb-2">#PAY-{{ $payment->id }}</h3>
                    <p class="text-sm text-slate-500 dark:text-gray-400">{{ $payment->created_at->translatedFormat('d M Y, H:i') }} WIB</p>
                </div>
                @php
                    $statusConfig = match($payment->status) {
                        'pending' => ['bg' => 'bg-amber-100 text-amber-700 border-amber-200', 'text' => 'Belum Bayar'],
                        'waiting' => ['bg' => 'bg-blue-100 text-blue-700 border-blue-200', 'text' => 'Menunggu Verifikasi'],
                        'failed'  => ['bg' => 'bg-red-100 text-red-700 border-red-200', 'text' => 'Pembayaran Gagal'],
                        'success' => ['bg' => 'bg-green-100 text-green-700 border-green-200', 'text' => 'Pembayaran Berhasil'],
                    };
                @endphp
                <span class="px-4 py-2 {{ $statusConfig['bg'] }} border rounded-full text-xs font-black uppercase tracking-widest shadow-sm">
                    {{ $statusConfig['text'] }}
                </span>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Kursus</p>
                        <div class="flex items-center gap-4">
                            <div>
                                <h4 class="text-sm font-extrabold text-slate-900 dark:text-white">{{ $payment->kursus->judul }}</h4>
                                <p class="text-xs text-slate-500 dark:text-gray-400">{{ $payment->kursus->kategori->nama ?? 'Kursus' }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Nominal Pembayaran</p>
                        <p class="text-2xl font-black text-brand-purple">Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</p>
                    </div>
                </div>

                @if($payment->metode)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Metode Pembayaran</p>
                        <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $payment->metode }}</p>
                    </div>
                    @if($payment->bukti)
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Bukti Transfer</p>
                        <a href="{{ asset('storage/' . $payment->bukti) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold text-brand-purple hover:underline">
                            <i class="ri-image-line"></i>
                            Lihat Bukti
                        </a>
                    </div>
                    @endif
                </div>
                @endif

                @if($payment->verifiedBy)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Diverifikasi Oleh</p>
                        <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $payment->verifiedBy->name ?? $payment->verifiedBy->username }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Tanggal Verifikasi</p>
                        <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $payment->verified_at ? $payment->verified_at->translatedFormat('d M Y, H:i') : '-' }} WIB</p>
                    </div>
                </div>
                @endif

                @if($payment->catatan_admin)
                <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-900/30 rounded-2xl">
                    <p class="text-[10px] font-black text-red-600 dark:text-red-400 uppercase mb-1">Catatan Admin:</p>
                    <p class="text-xs text-red-700 dark:text-red-300 font-bold">{{ $payment->catatan_admin }}</p>
                </div>
                @endif

                @if(($payment->status === 'pending' || $payment->status === 'failed') && $payment->expired_at)
                <div class="p-5 {{ $payment->expired_at->isPast() ? 'bg-red-50 dark:bg-red-900/10 border-red-100 dark:border-red-900/30' : 'bg-amber-50 dark:bg-amber-900/10 border-amber-100 dark:border-amber-900/30' }} border rounded-[2rem] flex items-center gap-4">
                    <div class="w-12 h-12 {{ $payment->expired_at->isPast() ? 'bg-red-100 dark:bg-red-900/20 text-red-600' : 'bg-amber-100 dark:bg-amber-900/20 text-amber-600' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="ri-time-line text-2xl {{ !$payment->expired_at->isPast() ? 'animate-pulse' : '' }}"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black {{ $payment->expired_at->isPast() ? 'text-red-600' : 'text-amber-600' }} uppercase mb-0.5 tracking-widest">
                            {{ $payment->expired_at->isPast() ? 'Batas Waktu Terlewati' : 'Batas Waktu Pembayaran' }}
                        </p>
                        <p class="text-sm font-bold {{ $payment->expired_at->isPast() ? 'text-red-700' : 'text-amber-700' }} dark:text-white">
                            {{ $payment->expired_at->translatedFormat('d F Y, H:i') }} WIB
                        </p>
                    </div>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-8 border-t border-slate-50 dark:border-gray-800 text-center">
                <p class="text-[10px] text-slate-400 dark:text-gray-500 font-black uppercase mb-4 tracking-widest">Butuh bantuan atau kendala pembayaran?</p>
                <a href="https://wa.me/6281996663358" target="_blank" 
                   class="inline-flex items-center gap-3 px-8 py-3.5 bg-green-50 dark:bg-green-900/10 border border-green-100 dark:border-green-900/20 text-green-600 dark:text-green-400 font-black text-sm rounded-2xl hover:bg-green-600 hover:text-white hover:shadow-xl hover:shadow-green-200 dark:hover:shadow-none transition-all duration-500 group">
                    <i class="ri-whatsapp-line text-xl group-hover:rotate-12 transition-transform"></i>
                    <span>Hubungi Admin via WhatsApp</span>
                </a>
            </div>
        </div>

        @if(in_array($payment->status, ['pending', 'failed']) && !$payment->expired_at->isPast())
        <div class="flex justify-end">
            <a href="{{ route('mentee.pembayaran.invoice', $payment->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-purple text-white font-black rounded-2xl shadow-purple-gradient hover:scale-105 transition-all text-sm">
                <i class="ri-wallet-3-line"></i>
                Bayar Sekarang
            </a>
        </div>
        @else
        <div class="flex justify-end">
            <a href="{{ route('mentee.pembayaran.riwayat') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 dark:bg-gray-800 text-slate-600 dark:text-gray-300 font-bold rounded-2xl hover:bg-slate-200 dark:hover:bg-gray-700 transition-all text-sm">
                <i class="ri-arrow-left-line"></i>
                Kembali ke Riwayat
            </a>
        </div>
        @endif

    </div>
</div>
@endsection