@extends('layouts.mentee.navbar')

@section('title', 'Verifikasi Sertifikat - Flodemi')

@section('content')
<div class="min-h-[75vh] flex flex-col justify-center relative py-8 md:py-12 transition-colors duration-300 pattern-dots">
    
    {{-- Decorative Background Gradients --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full pointer-events-none overflow-hidden flex items-center justify-center z-0">
        <div class="absolute w-[600px] h-[400px] bg-brand-purple/[0.04] dark:bg-brand-purple/[0.08] rounded-[100%] blur-[100px]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        @if($nomor)
            {{-- Split-Layout --}}
            <div class="max-w-4xl mx-auto bg-white/70 dark:bg-gray-900/70 backdrop-blur-lg rounded-[24px] border border-gray-100 dark:border-gray-800/80 shadow-2xl p-5 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 items-stretch">
                    
                    {{-- Sisi Kiri: Panel Form Pencarian --}}
                    <div class="md:col-span-5 flex flex-col justify-between gap-5">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-10 h-10 rounded-xl bg-brand-purple/10 flex items-center justify-center text-brand-purple text-lg">
                                    <i class="ri-award-line"></i>
                                </div>
                                <div>
                                    <h2 class="text-sm font-black text-gray-900 dark:text-white leading-none">Verifikasi Sertifikat</h2>
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Flodemi</span>
                                </div>
                            </div>
                            
                            <p class="text-[11px] md:text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                Masukkan nomor sertifikat untuk memeriksa validitas.
                            </p>
                        </div>

                        <form action="{{ route('sertifikat.verify') }}" method="GET" class="space-y-2 mt-auto">
                            <div class="relative">
                                <i class="ri-key-line absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm"></i>
                                <input type="text" name="nomor" value="{{ $nomor }}" placeholder="Nomor sertifikat" required
                                    class="w-full pl-9 pr-4 py-2.5 text-xs text-gray-700 dark:text-gray-200 bg-gray-50 dark:bg-gray-950 border border-gray-200 dark:border-gray-800 rounded-xl outline-none focus:border-brand-purple dark:focus:border-brand-purple transition-all font-medium">
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-brand-purple hover:bg-brand-purple-dark text-white text-xs font-bold rounded-xl active:scale-95 transition-all shadow-lg shadow-purple-200 dark:shadow-none flex items-center justify-center gap-1.5">
                                <i class="ri-search-line"></i>
                                Periksa
                            </button>
                        </form>
                    </div>

                    {{-- Pemisah Tengah --}}
                    <div class="hidden md:block w-px bg-gray-100 dark:bg-gray-800/80 md:col-span-1 justify-self-center my-1"></div>

                    {{-- Sisi Kanan: Hasil Validasi --}}
                    <div class="md:col-span-6 flex flex-col justify-center">
                        @if($sertifikat)
                            {{-- Valid --}}
                            <div class="space-y-3.5 animate-fade-in">
                                <div class="flex items-center gap-3 p-3 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-600 dark:text-emerald-400">
                                    <i class="ri-checkbox-circle-fill text-lg shrink-0"></i>
                                    <div>
                                        <h4 class="font-bold text-xs">Sertifikat Valid</h4>
                                        <p class="text-[10px] text-gray-500 dark:text-gray-400 leading-none mt-0.5">Sertifikat resmi terdaftar.</p>
                                    </div>
                                </div>

                                <div class="bg-gray-50/50 dark:bg-gray-950/40 border border-gray-100 dark:border-gray-800/60 rounded-xl p-4 space-y-2.5">
                                    <div class="flex justify-between items-center border-b border-gray-100/80 dark:border-gray-800/40 pb-2">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Nama</span>
                                        <span class="text-xs font-bold text-gray-900 dark:text-white">{{ $sertifikat->pengguna->username }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-100/80 dark:border-gray-800/40 pb-2">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Kelas</span>
                                        <span class="text-xs font-bold text-gray-900 dark:text-white max-w-[190px] md:max-w-[210px] text-right truncate" title="{{ $sertifikat->kursus->judul }}">{{ $sertifikat->kursus->judul }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-100/80 dark:border-gray-800/40 pb-2">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Nomor</span>
                                        <span class="text-xs font-mono font-bold text-brand-purple">{{ $sertifikat->nomor_sertifikat }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-0">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Terbit</span>
                                        <span class="text-xs font-bold text-gray-900 dark:text-white">{{ $sertifikat->tanggal_terbit ? $sertifikat->tanggal_terbit->format('d M Y') : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Tidak Valid --}}
                            <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-600 dark:text-red-400 animate-fade-in flex gap-3 items-start">
                                <i class="ri-close-circle-fill text-xl shrink-0"></i>
                                <div>
                                    <h4 class="font-bold text-xs">Tidak Valid</h4>
                                    <p class="text-[10px] text-gray-500 dark:text-gray-400 leading-relaxed mt-0.5">
                                        Nomor <span class="font-mono font-bold text-red-700 dark:text-red-400">"{{ $nomor }}"</span> tidak terdaftar. Periksa kembali penulisan kode.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        @else
            {{-- Tampilan Awal --}}
            <div class="max-w-md mx-auto bg-white/70 dark:bg-gray-900/70 backdrop-blur-lg rounded-[24px] border border-gray-100 dark:border-gray-800/80 shadow-2xl p-5 md:p-8 text-center space-y-5 animate-fade-in">
                <div class="w-12 h-12 rounded-xl bg-brand-purple/10 flex items-center justify-center text-brand-purple text-xl mx-auto">
                    <i class="ri-award-line"></i>
                </div>
                
                <div class="space-y-1.5">
                    <h1 class="text-lg md:text-xl font-black text-gray-900 dark:text-white">Verifikasi Sertifikat</h1>
                    <p class="text-[11px] md:text-xs text-gray-400 dark:text-gray-500 max-w-xs mx-auto">
                        Masukkan nomor sertifikat untuk memeriksa validitas.
                    </p>
                </div>

                <form action="{{ route('sertifikat.verify') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                    <div class="flex-1 relative">
                        <i class="ri-key-line absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm"></i>
                        <input type="text" name="nomor" placeholder="Masukkan nomor sertifikat" required
                            class="w-full pl-9 pr-4 py-3 text-xs text-gray-700 dark:text-gray-200 bg-gray-50 dark:bg-gray-950 border border-gray-200 dark:border-gray-800 rounded-xl outline-none focus:border-brand-purple dark:focus:border-brand-purple transition-all font-medium">
                    </div>
                    <button type="submit" class="px-5 py-3 bg-brand-purple hover:bg-brand-purple-dark text-white text-xs font-bold rounded-xl active:scale-95 transition-all shadow-lg shadow-purple-200 dark:shadow-none flex items-center justify-center gap-1.5 shrink-0">
                        <i class="ri-search-line"></i>
                        Verifikasi
                    </button>
                </form>
            </div>
        @endif

        {{-- Mini Footer --}}
        <div class="text-center mt-12 text-[10px] text-gray-400 dark:text-gray-500 font-bold uppercase tracking-widest">
            © 2026 || PT. Flashsoft Indonesia
        </div>
    </div>
</div>

<style>
    .pattern-dots {
        background-image: radial-gradient(circle, #e2e8f0 1.2px, transparent 1.2px);
        background-size: 20px 20px;
    }
    .dark .pattern-dots {
        background-image: radial-gradient(circle, #1e293b 1.2px, transparent 1.2px);
    }

    @keyframes fade-in {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
</style>
@endsection
