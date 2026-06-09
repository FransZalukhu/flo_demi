@extends('layouts.mentee.sidebar')

@section('title', 'Dashboard Mentee - Flodemi')

@section('main-content')
    {{-- Toast Notifications --}}
    @if(session('success') || session('info'))
    <div id="toast" class="fixed top-24 right-6 z-[2000] flex items-center gap-4 px-6 py-4 rounded-[1.5rem] shadow-2xl border transition-all animate-slide-in {{ session('success') ? 'bg-white dark:bg-gray-900 border-green-100 dark:border-green-900/30 text-green-700 dark:text-green-400' : 'bg-white dark:bg-gray-900 border-blue-100 dark:border-blue-900/30 text-blue-700 dark:text-blue-400' }}">
        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ session('success') ? 'bg-green-500 text-white' : 'bg-blue-500 text-white' }}">
            <i class="{{ session('success') ? 'ri-check-line' : 'ri-information-line' }} text-xl"></i>
        </div>
        <span class="font-bold text-sm">{{ session('success') ?? session('info') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-4 text-slate-400 hover:text-slate-600 dark:hover:text-gray-200">
            <i class="ri-close-line"></i>
        </button>
    </div>
    @endif

    {{-- HERO HEADER --}}
    <header class="relative p-8 md:p-12 rounded-[2.5rem] overflow-hidden bg-white dark:bg-gray-900 text-slate-900 dark:text-white mb-12 border border-slate-100 dark:border-gray-800 shadow-sm">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-purple/5 dark:bg-brand-purple/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-blue-500/5 dark:bg-blue-500/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/4"></div>
        
        <div class="relative z-10 flex flex-col xl:flex-row xl:items-center justify-between gap-10">
            <div class="max-w-2xl">
                <div class="flex items-center gap-2 text-brand-purple font-bold text-sm mb-6 tracking-widest uppercase">
                    <i class="ri-sparkling-line"></i>
                    <span>Selamat datang kembali!</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-black mb-6 leading-tight tracking-tight text-slate-900 dark:text-white">
                    Siap melanjutkan<br>belajarmu, <span class="text-brand-purple">{{ auth()->user()->username }}</span>?
                </h2>
                <p class="text-slate-500 dark:text-gray-400 text-base md:text-lg leading-relaxed mb-0">
                    Lanjutkan progres kelasmu dan kembangkan skill digital baru hari ini bersama mentor ahli Flodemi.
                </p>
            </div>

            <div class="flex gap-4 sm:gap-6">
                <div class="bg-slate-50 dark:bg-gray-800 border border-slate-100 dark:border-gray-700 p-6 md:p-8 rounded-[2rem] min-w-[140px] md:min-w-[180px] shadow-sm">
                    <p class="text-slate-400 dark:text-gray-500 text-[10px] md:text-xs font-bold uppercase tracking-widest mb-3">Kelas Aktif</p>
                    <h3 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white">{{ $kursusSaya->where('pivot.status', 'aktif')->count() }}</h3>
                </div>
                <div class="bg-brand-purple/5 dark:bg-brand-purple/10 border border-brand-purple/10 dark:border-brand-purple/20 p-6 md:p-8 rounded-[2rem] min-w-[140px] md:min-w-[180px] shadow-sm">
                    <p class="text-brand-purple text-[10px] md:text-xs font-bold uppercase tracking-widest mb-3">Diselesaikan</p>
                    <h3 class="text-4xl md:text-5xl font-black text-brand-purple">{{ $kursusSaya->where('pivot.status', 'selesai')->count() }}</h3>
                </div>
            </div>
        </div>
    </header>

    {{-- COURSE SECTION HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-10 gap-6">
        <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Daftar Course Kamu</h3>
        
        <div class="grid grid-cols-4 sm:flex w-full sm:w-auto gap-1 sm:gap-2 bg-white dark:bg-gray-900 p-1.5 rounded-2xl border border-slate-100 dark:border-gray-800 shadow-sm">
            <button class="px-3 sm:px-6 py-2.5 text-[10px] sm:text-xs font-bold rounded-xl transition-all bg-brand-purple text-white shadow-purple-gradient filter-btn active whitespace-nowrap" data-filter="all">
                Semua
            </button>
            <button class="px-3 sm:px-6 py-2.5 text-[10px] sm:text-xs font-bold text-slate-500 dark:text-gray-400 rounded-xl transition-all hover:bg-slate-50 dark:hover:bg-gray-800 hover:text-brand-purple filter-btn whitespace-nowrap" data-filter="aktif">
                Aktif
            </button>
            <button class="px-3 sm:px-6 py-2.5 text-[10px] sm:text-xs font-bold text-slate-500 dark:text-gray-400 rounded-xl transition-all hover:bg-slate-50 dark:hover:bg-gray-800 hover:text-brand-purple filter-btn whitespace-nowrap" data-filter="selesai">
                Selesai
            </button>
            <button class="px-3 sm:px-6 py-2.5 text-[10px] sm:text-xs font-bold text-slate-500 dark:text-gray-400 rounded-xl transition-all hover:bg-slate-50 dark:hover:bg-gray-800 hover:text-brand-purple filter-btn whitespace-nowrap" data-filter="menunggu">
                Menunggu
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6" id="courseGrid">
        @forelse($kursusSaya as $kursus)
        @php
            $status = $kursus->pivot->status;
        @endphp
        <div class="bg-white dark:bg-gray-900 rounded-[1.5rem] border border-slate-100 dark:border-gray-800 overflow-hidden hover:shadow-2xl hover:shadow-purple-100 dark:hover:shadow-black/40 transition-all duration-500 group course-card" data-status="{{ $status }}">
            <div class="relative h-40 overflow-hidden bg-slate-100 dark:bg-gray-800">
                <img src="{{ $kursus->gambar ? asset('storage/' . $kursus->gambar) : asset('assets/default-course.png') }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                     alt="{{ $kursus->judul }}">
                
                {{-- Category Badge --}}
                <div class="absolute top-3 left-3 px-2.5 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md rounded-lg text-[8px] font-bold text-slate-900 dark:text-white uppercase tracking-widest border border-slate-100 dark:border-gray-800 shadow-sm">
                    {{ $kursus->kategori->nama ?? 'Course' }}
                </div>

                {{-- Status Badge --}}
                @php
                    $statusConfig = match($status) {
                        'aktif'                => ['bg' => 'bg-emerald-500', 'text' => 'Aktif'],
                        'selesai'              => ['bg' => 'bg-blue-500', 'text' => 'Selesai'],
                        'menunggu_pembayaran'  => ['bg' => 'bg-amber-400', 'text' => 'Belum Bayar'],
                        'menunggu_verifikasi'  => ['bg' => 'bg-blue-400', 'text' => 'Verifikasi'],
                        'ditolak'              => ['bg' => 'bg-red-500', 'text' => 'Ditolak'],
                        default                => ['bg' => 'bg-slate-500', 'text' => strtoupper($status)],
                    };
                @endphp
                <div class="absolute top-3 right-3 px-2.5 py-1 {{ $statusConfig['bg'] }} text-white text-[8px] font-bold rounded-full shadow-lg flex items-center gap-1.5">
                    <span class="w-1 h-1 rounded-full bg-white {{ $status === 'aktif' ? 'animate-pulse' : '' }}"></span>
                    {{ strtoupper($statusConfig['text']) }}
                </div>
            </div>

            <div class="p-5">
                <h5 class="font-bold text-slate-900 dark:text-white text-base line-clamp-2 mb-4 leading-snug group-hover:text-brand-purple transition-colors min-h-[2.5rem]">
                    {{ $kursus->judul }}
                </h5>
                
                <div class="flex flex-col gap-4 pt-4 border-t border-slate-50 dark:border-gray-800">
                    {{-- Mentor Info --}}
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 dark:bg-gray-800 flex items-center justify-center font-bold text-brand-purple border border-slate-100 dark:border-gray-700 text-[10px]">
                            {{ strtoupper(substr($kursus->mentor->username ?? '?', 0, 1)) }}
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-[8px] font-bold text-slate-400 dark:text-gray-500 uppercase tracking-tighter">Mentor</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-gray-300 truncate">{{ $kursus->mentor->username ?? 'Mentor' }}</span>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="w-full">
                        @if($status === 'aktif' || $status === 'selesai')
                            <a href="{{ route('mentee.course.detail', $kursus->id) }}" 
                               class="w-full block text-center py-2.5 {{ $status === 'selesai' ? 'bg-blue-500 shadow-blue-200' : 'bg-brand-purple shadow-purple-200' }} text-white text-[10px] font-bold rounded-xl transition-all hover:scale-[1.02] active:scale-95 shadow-lg dark:shadow-black/20">
                                {{ $status === 'selesai' ? 'Lihat Kembali' : 'Lanjutkan Belajar' }}
                            </a>
                        @elseif($status === 'menunggu_pembayaran' || $status === 'ditolak')
                            <a href="{{ route('mentee.pembayaran.invoice', $kursus->pivot->pembayaran_id) }}" 
                               class="w-full block text-center py-2.5 bg-amber-500 text-white text-[10px] font-black rounded-xl transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-amber-200 dark:shadow-black/20">
                                {{ $status === 'ditolak' ? 'Upload Ulang' : 'Bayar Sekarang' }}
                            </a>
                        @else
                            <div class="w-full py-2.5 bg-slate-100 dark:bg-gray-800 text-slate-400 dark:text-gray-600 text-[10px] font-bold rounded-xl text-center border border-slate-200 dark:border-gray-700">
                                <i class="ri-time-line mr-1"></i> Verifikasi
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-24 px-8 text-center bg-white dark:bg-gray-900 rounded-[3rem] border-2 border-dashed border-slate-200 dark:border-gray-800">
            <div class="w-20 h-20 bg-slate-50 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="ri-book-open-line text-4xl text-slate-300 dark:text-gray-700"></i>
            </div>
            <h5 class="text-2xl font-black text-slate-900 dark:text-white mb-3">Belum Ada Course</h5>
            <p class="text-slate-500 dark:text-gray-400 text-base mb-10 max-w-sm mx-auto">Mulai jelajahi katalog course kami dan temukan kelas yang sesuai dengan minatmu.</p>
            <a href="{{ route('home') }}#course-section" class="inline-flex items-center gap-2 px-8 py-4 bg-brand-purple text-white font-bold rounded-2xl hover:bg-brand-purple-dark transition-all hover:scale-105 active:scale-95 shadow-xl shadow-purple-200 dark:shadow-purple-900/20">
                <i class="ri-compass-3-line"></i>
                Eksplor Katalog
            </a>
        </div>
        @endforelse
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => toast.remove(), 300);
            }
        }, 4000);

        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const cards = document.querySelectorAll('.course-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const filter = this.dataset.filter;

                    filterBtns.forEach(b => {
                        b.classList.remove('bg-brand-purple', 'text-white', 'shadow-purple-gradient');
                        b.classList.add('text-slate-500', 'dark:text-gray-400', 'hover:bg-slate-50', 'dark:hover:bg-gray-800', 'hover:text-brand-purple');
                    });
                    this.classList.add('bg-brand-purple', 'text-white', 'shadow-purple-gradient');
                    this.classList.remove('text-slate-500', 'dark:text-gray-400', 'hover:bg-slate-50', 'dark:hover:bg-gray-800', 'hover:text-brand-purple');

                    cards.forEach(card => {
                        if (filter === 'all' || card.dataset.status === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endsection
