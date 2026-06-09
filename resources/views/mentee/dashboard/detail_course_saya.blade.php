@extends('layouts.mentee.navbar')

@section('title', 'Belajar: ' . $kursus->judul . ' - Flodemi')

@section('content')
<div class="flex flex-col lg:flex-row bg-[#F1F5F9] dark:bg-gray-950 overflow-hidden transition-colors duration-300" style="height: calc(100vh - 80px);">

    {{-- Toast Notifications --}}
    @if(session('success') || session('info') || session('error'))
    <div id="toast" class="fixed top-24 right-6 z-[3000] flex items-center gap-4 px-6 py-4 rounded-[1.5rem] shadow-2xl border transition-all animate-slide-in 
        {{ session('success') ? 'bg-white dark:bg-gray-900 border-green-100 dark:border-green-900/30 text-green-700 dark:text-green-400' : 
           (session('error') ? 'bg-white dark:bg-gray-900 border-red-100 dark:border-red-900/30 text-red-700 dark:text-red-400' : 
           'bg-white dark:bg-gray-900 border-blue-100 dark:border-blue-900/30 text-blue-700 dark:text-blue-400') }}">
        <div class="w-10 h-10 rounded-full flex items-center justify-center 
            {{ session('success') ? 'bg-green-500 text-white' : (session('error') ? 'bg-red-500 text-white' : 'bg-blue-500 text-white') }}">
            <i class="{{ session('success') ? 'ri-check-line' : (session('error') ? 'ri-error-warning-line' : 'ri-information-line') }} text-xl"></i>
        </div>
        <span class="font-bold text-sm">{{ session('success') ?? session('error') ?? session('info') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-4 text-slate-400 hover:text-slate-600 dark:hover:text-gray-200">
            <i class="ri-close-line"></i>
        </button>
    </div>
    @endif

    {{-- SIDEBAR --}}
    <aside id="sidebarContent" 
           class="fixed inset-0 z-[2000] flex flex-col w-full bg-[#F1F5F9] dark:bg-gray-950 transition-transform duration-300 -translate-x-full lg:translate-x-0 lg:static lg:inset-auto lg:z-20 lg:w-[340px] p-6 overflow-y-auto custom-scrollbar">
        
        {{-- MOBILE CLOSE BUTTON --}}
        <div class="lg:hidden flex justify-end mb-4">
            <button id="closeDrawerBtn" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-gray-900 text-slate-900 dark:text-white shadow-sm">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>

        {{-- BLOCK 1: COURSE SAYA --}}
        <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-6 mb-6 shadow-sm border border-slate-200/50 dark:border-gray-800">
            <div class="flex items-center justify-between mb-6 px-1">
                <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 dark:bg-gray-800 flex items-center justify-center text-slate-400 dark:text-gray-500">
                            <i class="ri-layout-grid-line"></i>
                        </div>
                    <span class="text-xs font-bold text-slate-900 dark:text-white tracking-wide">Course Saya</span>
                </div>
                <i class="ri-arrow-up-s-line text-slate-400 dark:text-gray-500"></i>
            </div>

            <div class="space-y-5">
                {{-- Current Course --}}
                <div class="group cursor-pointer">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center mb-1">
                                <p class="text-[11px] font-bold text-slate-800 dark:text-gray-200 truncate">{{ $kursus->judul }}</p>
                                <span class="text-[10px] font-bold text-brand-purple">{{ $persenProgress }}%</span>
                            </div>
                            <div class="w-full h-1 bg-slate-100 dark:bg-gray-800 rounded-full overflow-hidden">
                                <div class="h-full bg-brand-purple" style="width: {{ $persenProgress }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($otherCourses as $oc)
                <a href="{{ route('mentee.course.detail', $oc->id) }}" class="block group cursor-pointer opacity-70 hover:opacity-100 transition-opacity">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center mb-1">
                                <p class="text-[11px] font-bold text-slate-700 dark:text-gray-400 truncate">{{ $oc->judul }}</p>
                                <span class="text-[10px] font-bold text-indigo-500 dark:text-indigo-400">{{ $oc->percent }}%</span>
                            </div>
                            <div class="w-full h-1 bg-slate-100 dark:bg-gray-800 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-400 dark:bg-indigo-500" style="width: {{ $oc->percent }}%"></div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <a href="{{ route('mentee.dashboard') }}" class="flex items-center justify-center gap-2 w-full mt-8 py-3 bg-slate-50 dark:bg-gray-800 hover:bg-slate-100 dark:hover:bg-gray-700 text-slate-500 dark:text-gray-400 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                <i class="ri-grid-fill"></i>
                Semua Course
            </a>
        </div>

        {{-- BLOCK 2: MODUL PEMBELAJARAN --}}
        <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-6 flex-1 flex flex-col min-h-0 shadow-sm border border-slate-200/50 dark:border-gray-800">
            <div class="flex items-start justify-between mb-6 px-1">
                <div>
                    <p class="text-[9px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-2">Modul Pembelajaran</p>
                    <h6 class="text-sm font-black text-slate-900 dark:text-white leading-tight">{{ $kursus->judul }}</h6>
                </div>
                <div class="w-7 h-7 rounded-full bg-slate-50 dark:bg-gray-800 flex items-center justify-center text-slate-400 dark:text-gray-500">
                    <i class="ri-information-line"></i>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto overflow-x-hidden custom-scrollbar space-y-4 pr-1">
                @foreach($kursus->modul as $index => $modul)
                    @php
                        $progress     = $progressList[$modul->id] ?? null;
                        $sudahSelesai = $progress && $progress->status_modul === 'selesai';
                        $isAktif      = $modulAktif && $modulAktif->id === $modul->id;
                    @endphp

                    <a href="{{ route('mentee.detailCourseSaya', ['id' => $kursus->id, 'modul_id' => $modul->id]) }}" 
                       class="relative flex items-center gap-4 p-1 group">
                        @if($isAktif)
                            <div class="absolute -inset-y-2 -inset-x-3 bg-brand-purple/5 dark:bg-brand-purple/10 border border-brand-purple/10 dark:border-brand-purple/20 rounded-2xl"></div>
                        @endif
                        
                        <div class="relative z-10 w-9 h-9 rounded-full flex items-center justify-center shrink-0 transition-all {{ $sudahSelesai ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-100 dark:shadow-black/20' : ($isAktif ? 'bg-brand-purple text-white shadow-lg shadow-purple-200 dark:shadow-black/20 scale-110' : 'bg-slate-50 dark:bg-gray-800 text-slate-400 dark:text-gray-500 group-hover:bg-slate-100 dark:group-hover:bg-gray-700') }}">
                            @if($sudahSelesai)
                                <i class="ri-check-line text-lg font-bold"></i>
                            @elseif($isAktif)
                                <i class="ri-play-fill text-lg"></i>
                            @else
                                <span class="text-[11px] font-black">{{ $index + 1 }}</span>
                            @endif
                        </div>
                        
                        <div class="relative z-10 flex-1 min-w-0">
                            <p class="text-[12px] font-bold truncate {{ $isAktif ? 'text-brand-purple' : ($sudahSelesai ? 'text-slate-700 dark:text-gray-300' : 'text-slate-500 dark:text-gray-400') }}">
                                {{ $modul->judul }}
                            </p>
                            <p class="text-[10px] font-bold mt-0.5 uppercase tracking-wider {{ $isAktif ? 'text-brand-purple/60' : ($sudahSelesai ? 'text-emerald-500' : 'text-slate-400 dark:text-gray-500') }}">
                                @if($sudahSelesai)
                                    Selesai
                                @elseif($isAktif)
                                    Sedang dipelajari
                                @else
                                    Belum dimulai
                                @endif
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- BOTTOM ACTION --}}
        <div class="mt-6">
            <a href="https://wa.me/6281996663358" target="_blank" class="flex items-center justify-center gap-3 w-full py-4 px-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl text-[13px] font-black transition-all shadow-xl shadow-emerald-100 dark:shadow-black/20 active:scale-95 group">
                <i class="ri-whatsapp-line text-lg transition-transform group-hover:rotate-12"></i>
                <span>Grup Live Session</span>
            </a>
        </div>
    </aside>

    {{-- DRAWER OVERLAY (MOBILE ONLY) --}}
    <div id="drawerOverlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300"></div>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        {{-- CONTENT WRAPPER --}}
        <div class="p-4 md:p-8 lg:p-10 max-w-5xl mx-auto w-full">
            
            {{-- Header --}}
            <header class="mb-8 pl-2">
                @if($kursus->pivot->status === 'selesai')
                <div class="mb-8 p-6 bg-gradient-to-r from-brand-purple to-indigo-600 rounded-[2rem] text-white shadow-xl shadow-purple-200 dark:shadow-black/40 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-5 text-center md:text-left">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-3xl">
                            🎉
                        </div>
                        <div>
                            <h4 class="text-xl font-black mb-1">Selamat! Kamu Telah Lulus</h4>
                            <p class="text-sm text-white/80 font-medium">Sertifikat kelulusan kamu sudah terbit dan siap diunduh.</p>
                        </div>
                    </div>
                    @php
                        $sertifikat = auth()->user()->sertifikat()->where('kursus_id', $kursus->id)->first();
                    @endphp
                    @if($sertifikat)
                    <a href="{{ route('mentee.sertifikat.download', $sertifikat->id) }}" class="download-btn flex items-center gap-2 px-8 py-4 bg-white text-brand-purple rounded-2xl font-black text-sm hover:scale-105 transition-all shadow-lg active:scale-95">
                        <i class="ri-medal-line text-lg"></i>
                        Unduh Sertifikat
                    </a>
                    @endif
                </div>
                @endif

                <div class="flex items-center gap-2 text-brand-purple font-black text-[10px] tracking-[0.2em] mb-3 uppercase">
                    <span id="greeting">Selamat Belajar!</span>
                </div>
                <h1 class="text-2xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ $modulAktif ? $modulAktif->judul : $kursus->judul }}
                </h1>
            </header>

            {{-- Content Viewer (Mac-like Window) --}}
            <div class="flex flex-col bg-white dark:bg-gray-900 rounded-[2.5rem] border border-slate-200 dark:border-gray-800 shadow-2xl shadow-slate-200/50 dark:shadow-black/40 overflow-hidden mb-10">
                
                {{-- Toolbar --}}
                <div class="px-6 py-4 border-b border-slate-100 dark:border-gray-800 flex items-center justify-between bg-white dark:bg-gray-900">
                    <div class="flex gap-2 shrink-0">
                        <div class="w-3 h-3 rounded-full bg-[#FF5F56]"></div>
                        <div class="w-3 h-3 rounded-full bg-[#FFBD2E]"></div>
                        <div class="w-3 h-3 rounded-full bg-[#27C93F]"></div>
                    </div>
                    <div class="hidden md:block text-[10px] font-black text-slate-400 dark:text-gray-500 truncate px-4 uppercase tracking-widest flex-1 text-center">
                        <i class="ri-file-pdf-fill mr-1 text-brand-purple"></i>
                        {{ $modulAktif ? $modulAktif->judul : 'Pilih Modul' }}.pdf
                    </div>
                    <div class="flex items-center gap-5 text-slate-400 dark:text-gray-500 shrink-0">
                        <i class="ri-search-line text-base"></i>
                        <span class="text-[10px] font-black tracking-widest">100%</span>
                        <i class="ri-zoom-in-line text-base"></i>
                    </div>
                </div>

                <div class="relative bg-[#F8FAFC] dark:bg-gray-950 min-h-[500px] md:min-h-[650px]">
                    @if($modulAktif && $modulAktif->file)
                        {{-- Loader --}}
                        <div id="pdf-loader" class="absolute inset-0 flex items-center justify-center bg-white dark:bg-gray-900 z-10 transition-opacity duration-300">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-10 h-10 border-4 border-brand-purple/10 border-t-brand-purple rounded-full animate-spin"></div>
                                <p class="text-[9px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em]">Memuat Modul...</p>
                            </div>
                        </div>

                        <iframe src="{{ asset('storage/' . $modulAktif->file) }}#toolbar=0"
                                class="absolute inset-0 w-full h-full border-0"
                                title="{{ $modulAktif->judul }}"
                                allow="fullscreen"
                                onload="document.getElementById('pdf-loader').style.opacity = '0'; setTimeout(() => document.getElementById('pdf-loader').remove(), 300);"></iframe>
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-12 text-center bg-white dark:bg-gray-900">
                            <div class="w-20 h-20 rounded-[1.5rem] bg-brand-purple/5 dark:bg-brand-purple/10 flex items-center justify-center text-brand-purple mb-6">
                                <i class="ri-file-pdf-line text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white mb-3 tracking-tight">Materi Modul</h3>
                            <p class="text-xs text-slate-500 dark:text-gray-400 max-w-xs mx-auto leading-relaxed font-medium">
                                Dokumen PDF ini berisi panduan lengkap pembelajaran modul ini.
                            </p>
                            @if($modulAktif && $modulAktif->file)
                                <a href="{{ asset('storage/' . $modulAktif->file) }}" download class="mt-8 flex items-center gap-2 px-6 py-3 bg-slate-900 dark:bg-white text-white dark:text-gray-900 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-black dark:hover:bg-gray-100 transition-all">
                                    <i class="ri-download-cloud-line text-base"></i>
                                    Unduh untuk membaca offline
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- Action Bar --}}
            <div class="bg-white dark:bg-gray-900 p-6 md:p-10 rounded-[2.5rem] md:rounded-[3rem] border border-slate-200 dark:border-gray-800 shadow-xl shadow-slate-100/50 dark:shadow-black/20 flex flex-col xl:flex-row items-center justify-between gap-8">
                <div class="flex items-center gap-6 w-full xl:w-auto">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-500 shrink-0 shadow-inner">
                        <i class="ri-information-line text-3xl"></i>
                    </div>
                    <div>
                        <h5 class="text-sm font-black text-slate-800 dark:text-white mb-1 tracking-tight">Sudah Selesai Membaca?</h5>
                        <p class="text-xs text-slate-500 dark:text-gray-400 font-medium leading-relaxed">Tandai modul ini sebagai selesai untuk mencatat progres belajarmu.</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full xl:w-auto">
                    @php
                        $fileUrl = ($modulAktif && $modulAktif->file) ? asset('storage/' . $modulAktif->file) : null;
                        $modulAktifSelesai = $modulAktif && isset($progressList[$modulAktif->id]) && $progressList[$modulAktif->id]->status_modul === 'selesai';
                    @endphp

                    @if($fileUrl)
                        <a href="{{ $fileUrl }}" download class="w-full sm:w-auto flex items-center justify-center gap-3 px-8 py-5 bg-slate-900 dark:bg-white text-white dark:text-gray-900 text-[13px] font-black rounded-2xl transition-all hover:bg-black dark:hover:bg-gray-100 shadow-xl shadow-slate-200 dark:shadow-black/20 active:scale-95 group">
                            <i class="ri-download-line text-lg group-hover:translate-y-0.5 transition-transform"></i>
                            <span>Unduh Materi</span>
                        </a>
                    @endif

                    @if($modulAktif)
                        @if($modulAktifSelesai)
                            <div class="w-full sm:w-auto flex items-center justify-center gap-3 px-10 py-5 bg-emerald-500 text-white text-[13px] font-black rounded-2xl shadow-xl shadow-emerald-100 dark:shadow-black/20">
                                <i class="ri-checkbox-circle-line text-xl"></i>
                                <span>Selesai Dipelajari</span>
                            </div>
                        @else
                            <form action="{{ route('mentee.tandaiSelesai') }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <input type="hidden" name="kursus_id" value="{{ $kursus->id }}">
                                <input type="hidden" name="modul_id"  value="{{ $modulAktif->id }}">
                                <button type="submit" class="w-full flex items-center justify-center gap-3 px-10 py-5 bg-brand-purple text-white text-[13px] font-black rounded-2xl shadow-xl shadow-purple-200 dark:shadow-purple-900/20 transition-all hover:bg-brand-purple-dark active:scale-95 group">
                                    <i class="ri-check-double-line text-xl transition-transform group-hover:scale-110"></i>
                                    <span>Tandai Selesai</span>
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </main>

    {{-- MOBILE FAB --}}
    <button id="openDrawerBtn" class="lg:hidden fixed bottom-6 right-6 z-30 w-14 h-14 bg-brand-purple text-white rounded-2xl shadow-2xl flex items-center justify-center transition-all active:scale-90">
        <i class="ri-menu-2-line text-2xl"></i>
    </button>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94A3B8; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const username = @json(auth()->user()->username);
    const greetingEl = document.getElementById('greeting');
    if (greetingEl) greetingEl.textContent = 'SELAMAT BELAJAR, ' + username.toUpperCase() + '!';

    // MOBILE SIDEBAR DRAWER
    const openBtn = document.getElementById('openDrawerBtn');
    const closeBtn = document.getElementById('closeDrawerBtn');
    const sidebar = document.getElementById('sidebarContent');
    const overlay = document.getElementById('drawerOverlay');
    
    function toggleDrawer() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    }

    if (openBtn) openBtn.addEventListener('click', toggleDrawer);
    if (closeBtn) closeBtn.addEventListener('click', toggleDrawer);
    if (overlay) overlay.addEventListener('click', toggleDrawer);

    // Auto-hide toast
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-[-20px]');
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    }

    // Protection for certificate download button (double/spam click)
    document.querySelectorAll('.download-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.classList.contains('pointer-events-none')) {
                e.preventDefault();
                return;
            }

            const originalHtml = this.innerHTML;
            this.classList.add('pointer-events-none', 'opacity-50');
            this.innerHTML = `<i class="ri-loader-4-line animate-spin text-lg"></i> MEMPROSES...`;

            setTimeout(() => {
                this.classList.remove('pointer-events-none', 'opacity-50');
                this.innerHTML = originalHtml;
            }, 6000);
        });
    });
});
</script>
@endsection
