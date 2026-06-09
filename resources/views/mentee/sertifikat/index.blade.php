@extends('layouts.mentee.sidebar')

@section('title', 'Sertifikat Saya - Flodemi')

@section('main-content')
@php
    $count = $sertifikat->count();
    $rankTitle = "Mulai Belajar";
    $rankDesc = "Selesaikan kelas pertama Anda untuk membuka sertifikat.";
    $rankBadge = "ri-medal-line bg-gray-100 text-gray-400";
@endphp

{{-- HEADER & STATS BANNER --}}
<div class="mb-10 animate-slide-in">
    <div class="relative bg-gradient-to-r from-purple-900 via-brand-purple to-indigo-800 rounded-3xl p-6 md:p-8 text-white overflow-hidden shadow-xl shadow-purple-100 dark:shadow-none mb-8">
        {{-- Decorative circles --}}
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
        <div class="absolute right-20 -bottom-10 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="px-3.5 py-1.5 bg-white/10 backdrop-blur-md rounded-full text-[10px] font-black tracking-widest uppercase mb-4 inline-block border border-white/10">
                    Sertifikat Flodemi
                </span>
                <h2 class="text-2xl md:text-3xl font-black tracking-tight mb-2">Sertifikat Saya</h2>
                <p class="text-purple-100/80 text-sm max-w-xl font-medium">Kumpulan pencapaian dan sertifikat kelulusan kursus Anda di Flodemi.</p>
            </div>
            
            <div class="bg-white dark:bg-gray-900 border border-slate-100 dark:border-gray-800/80 p-5 rounded-2xl shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/20 text-brand-purple flex items-center justify-center text-lg shrink-0">
                <i class="ri-file-list-3-line"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 dark:text-gray-500 font-extrabold uppercase tracking-wider">Total Sertifikat</p>
                <h3 class="text-lg font-black text-slate-800 dark:text-white mt-0.5">{{ $count }}</h3>
            </div>
        </div>
        </div>
    </div>
</div>

{{-- CERTIFICATES LIST --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8 animate-slide-in">
    @forelse($sertifikat as $cert)
    <div class="bg-white dark:bg-gray-900 rounded-2xl sm:rounded-[2rem] border border-slate-100 dark:border-gray-800/80 p-4 sm:p-6 shadow-sm hover:shadow-xl hover:shadow-purple-100/20 dark:hover:shadow-none hover:-translate-y-1.5 transition-all duration-300 flex flex-row sm:flex-col h-full gap-4 sm:gap-0 group">
        {{-- ICON WRAPPER --}}
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-50 dark:bg-purple-950/30 text-brand-purple rounded-xl flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-inner group-hover:scale-110 transition-transform sm:mb-5">
            <i class="ri-medal-fill"></i>
        </div>
        
        {{-- CONTENT WRAPPER --}}
        <div class="flex-1 min-w-0 flex flex-col">
            {{-- TOP ROW (badges) --}}
            <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-between gap-1.5 sm:gap-2 mb-2 sm:mb-0">
                <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 bg-purple-50 dark:bg-purple-950/20 text-brand-purple rounded-lg text-[8px] sm:text-[9px] font-extrabold uppercase tracking-wider self-start">
                    {{ $cert->kursus->kategori->nama ?? 'Umum' }}
                </span>
                <span class="text-[8px] sm:text-[10px] text-slate-400 dark:text-gray-500 font-bold flex items-center gap-1">
                    <i class="ri-calendar-event-line"></i>
                    {{ $cert->tanggal_terbit->translatedFormat('d M Y') }}
                </span>
            </div>

            {{-- COURSE TITLE --}}
            <h4 class="text-xs sm:text-lg font-black text-slate-800 dark:text-white mb-2 sm:mb-2 leading-snug group-hover:text-brand-purple transition-colors line-clamp-2 min-h-0 sm:min-h-[3rem]">
                {{ $cert->kursus->judul }}
            </h4>

            {{-- CERTIFICATE NO WITH COPY ACTION --}}
            <div class="relative bg-slate-50 dark:bg-gray-950 p-2 sm:p-3.5 rounded-xl sm:rounded-2xl border border-slate-100 dark:border-gray-800 flex items-center justify-between gap-2 sm:gap-3 mt-1 sm:mt-4 mb-3 sm:mb-6">
                <div class="min-w-0">
                    <p class="text-[7px] sm:text-[8px] text-slate-400 dark:text-gray-500 font-extrabold uppercase tracking-wider mb-0.5">Nomor Sertifikat</p>
                    <p class="text-[9px] sm:text-[11px] font-bold text-slate-600 dark:text-gray-400 truncate tracking-tight font-mono">{{ $cert->nomor_sertifikat }}</p>
                </div>
                
                {{-- Tooltip info --}}
                <span id="tooltip-copy-{{ $cert->id }}" class="absolute right-10 sm:right-12 top-1.5 px-2 py-0.5 bg-slate-800 text-white text-[8px] sm:text-[9px] rounded-md font-bold opacity-0 transition-opacity duration-300 pointer-events-none">Copied!</span>
                
                <button id="copy-{{ $cert->id }}" 
                        onclick="copyToClipboard('{{ $cert->nomor_sertifikat }}', 'copy-{{ $cert->id }}')" 
                        class="w-6 h-6 sm:w-8 sm:h-8 rounded-lg bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 text-slate-500 hover:text-brand-purple dark:hover:text-purple-400 hover:bg-slate-50 flex items-center justify-center transition-colors active:scale-90 shrink-0"
                        title="Salin Nomor Sertifikat">
                    <i class="ri-file-copy-line text-xs sm:text-sm"></i>
                </button>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="mt-auto pt-2 sm:pt-4 border-t border-slate-100 dark:border-gray-800">
                <a href="{{ route('mentee.sertifikat.download', $cert->id) }}" class="download-btn flex items-center justify-center gap-2 w-full py-2 sm:py-3.5 bg-brand-purple text-white text-[10px] sm:text-[13px] font-black rounded-lg sm:rounded-xl shadow-lg shadow-purple-100 dark:shadow-none hover:bg-purple-700 hover:scale-[1.02] active:scale-95 transition-all">
                    <i class="ri-download-cloud-2-line text-xs sm:text-lg"></i>
                    UNDUH SERTIFIKAT (PDF)
                </a>
            </div>
        </div>
    </div>
    @empty
    {{-- EMPTY STATE REDESIGN --}}
    <div class="col-span-full py-20 px-6 text-center bg-white dark:bg-gray-900 rounded-[2.5rem] border border-slate-100 dark:border-gray-800/80 shadow-sm max-w-2xl mx-auto">
        <div class="w-16 h-16 bg-slate-50 dark:bg-gray-950 border-2 border-dashed border-slate-200 dark:border-gray-800 rounded-2xl mx-auto mb-6 flex items-center justify-center text-slate-300 dark:text-gray-700 text-2xl">
            <i class="ri-lock-line"></i>
        </div>
        
        <h5 class="text-xl font-black text-slate-800 dark:text-white mb-2.5">Belum Ada Sertifikat Kelulusan</h5>
        <p class="text-slate-400 dark:text-gray-500 text-sm mb-8 max-w-sm mx-auto leading-relaxed">Teruslah belajar, tuntaskan modul, dan selesaikan kuis untuk mendapatkan sertifikasi resmi Flodemi.</p>
        <a href="{{ route('mentee.dashboard') }}" class="inline-flex items-center gap-2.5 px-8 py-4 bg-brand-purple hover:bg-purple-700 text-white font-extrabold rounded-2xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-purple-100 dark:shadow-none text-xs uppercase tracking-widest">
            <i class="ri-play-circle-line text-base"></i>
            Eksplor Kursus Anda
        </a>
    </div>
    @endforelse
</div>

<script>
// Click-to-copy handler
function copyToClipboard(text, btnId) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => showCopySuccess(btnId));
    } else {
        // Fallback for non-https/insecure environments
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            showCopySuccess(btnId);
        } catch (err) {
            console.error('Gagal menyalin teks: ', err);
        }
        document.body.removeChild(textArea);
    }
}

function showCopySuccess(btnId) {
    const btn = document.getElementById(btnId);
    const tooltip = document.getElementById('tooltip-' + btnId);
    const originalIcon = btn.innerHTML;
    
    // Change button state
    btn.innerHTML = `<i class="ri-check-line text-emerald-500"></i>`;
    btn.classList.add('bg-emerald-50', 'dark:bg-emerald-950/20', 'border-emerald-200');
    
    // Show tooltip
    if (tooltip) {
        tooltip.classList.remove('opacity-0');
        tooltip.classList.add('opacity-100');
    }

    setTimeout(() => {
        btn.innerHTML = originalIcon;
        btn.classList.remove('bg-emerald-50', 'dark:bg-emerald-950/20', 'border-emerald-200');
        if (tooltip) {
            tooltip.classList.remove('opacity-100');
            tooltip.classList.add('opacity-0');
        }
    }, 2000);
}

// Download loading spinner trigger
document.querySelectorAll('.download-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        if (this.classList.contains('pointer-events-none')) {
            e.preventDefault();
            return;
        }

        const originalHtml = this.innerHTML;
        this.classList.add('pointer-events-none', 'opacity-60');
        this.innerHTML = `<i class="ri-loader-4-line animate-spin text-lg"></i> MEMPROSES...`;

        setTimeout(() => {
            this.classList.remove('pointer-events-none', 'opacity-60');
            this.innerHTML = originalHtml;
        }, 6000);
    });
});
</script>
@endsection
