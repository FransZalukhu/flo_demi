@extends('layouts.mentee.navbar')

@section('title', 'Flodemi - Tingkatkan Keahlian Anda')

@section('content')
<div class="bg-white dark:bg-gray-950 text-gray-900 dark:text-white font-manrope transition-colors duration-300">

    {{-- ══════════ HERO SECTION ══════════ --}}
    <section class="relative pt-35 pb-32 overflow-hidden bg-gradient-to-b from-white via-purple-50/30 to-white dark:from-gray-950 dark:via-brand-purple/5 dark:to-gray-950">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[600px] h-[600px] bg-brand-purple/10 dark:bg-brand-purple/20 rounded-full blur-[120px] opacity-50"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-[400px] h-[400px] bg-blue-400/10 dark:bg-blue-600/10 rounded-full blur-[100px] opacity-50"></div>
        
        {{-- Center Gradient Glow --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full pointer-events-none overflow-hidden flex items-center justify-center">
            {{-- Large Soft Base Glow --}}
            <div class="absolute w-[1000px] h-[700px] bg-brand-purple/[0.08] dark:bg-brand-purple/[0.12] rounded-[100%] blur-[150px]"></div>
            
            {{-- Medium Vibrant Core --}}
            <div class="absolute w-[600px] h-[400px] bg-gradient-to-tr from-brand-purple/20 to-blue-400/20 dark:from-brand-purple/30 dark:to-blue-600/30 rounded-[100%] blur-[100px] opacity-80"></div>
            
            {{-- Small Intense Center (The "Spot") --}}
            <div class="absolute w-[300px] h-[200px] bg-brand-purple/10 dark:bg-brand-purple/20 rounded-[100%] blur-[60px]"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10">
            <div class="max-w-4xl">

                {{-- Main Title --}}
                <h1 class="text-4xl md:text-7xl font-black tracking-tight leading-[1.1] mb-6 text-gray-900 dark:text-white">
                    Upgrade Your <span class="text-brand-purple">Skill</span>,<br>
                    Shape Your <span class="text-blue-600 dark:text-blue-400">Future</span>.
                </h1>

                {{-- Subtitle --}}
                <p class="text-base md:text-xl text-gray-500 dark:text-gray-400 mb-10 max-w-2xl leading-relaxed">
                    Belajar skill digital dari mentor berpengalaman dan bangun karier impianmu mulai hari ini!
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4 mb-12">
                    <a href="#course-section" class="w-full sm:w-auto justify-center px-8 py-4 bg-brand-purple text-white font-bold rounded-2xl shadow-xl shadow-purple-200 dark:shadow-purple-900/20 hover:bg-brand-purple-dark transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                        Lihat Program Belajar
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>

                {{-- Social Proof --}}
                <div class="flex items-center gap-6">
                    <div class="flex -space-x-3">
                        @for($i=1; $i<=4; $i++)
                        <div class="w-12 h-12 rounded-full border-4 border-white dark:border-gray-900 overflow-hidden shadow-sm">
                            <img src="https://i.pravatar.cc/150?u={{$i}}" alt="User" class="w-full h-full object-cover">
                        </div>
                        @endfor
                        <div class="w-12 h-12 rounded-full border-4 border-white dark:border-gray-900 bg-brand-purple flex items-center justify-center text-white text-xs font-bold shadow-sm">
                            10rb+
                        </div>
                    </div>
                    <div>
                        <div class="flex gap-1 text-amber-400 text-sm mb-1">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Dari 2.000+ ulasan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SEARCH BAR --}}
    <section class="relative z-20 -mt-10 px-4">
        <div class="container mx-auto max-w-4xl">
            <div class="bg-white dark:bg-gray-900 p-1.5 md:p-2 rounded-full md:rounded-3xl shadow-2xl shadow-brand-purple/20 dark:shadow-black/40 border border-brand-purple/20 dark:border-gray-800 flex items-center">
                <div class="flex-1 flex items-center px-4 md:px-6">
                    <i class="ri-search-line text-gray-400 dark:text-gray-500 text-base md:text-lg mr-3 md:mr-4"></i>
                    <input type="text" placeholder="Apa yang ingin Anda pelajari hari ini?" class="w-full py-3 md:py-4 text-sm md:text-base text-gray-700 dark:text-gray-200 bg-transparent outline-none placeholder:text-gray-400 dark:placeholder:text-gray-600 font-medium">
                </div>
                <button class="bg-brand-purple text-white w-11 h-11 sm:w-auto sm:h-auto sm:px-8 sm:py-4 rounded-full md:rounded-2xl font-bold transition-all hover:bg-brand-purple-dark shadow-lg shadow-purple-200 dark:shadow-purple-900/20 flex items-center justify-center shrink-0">
                    <i class="ri-search-line text-lg sm:hidden"></i>
                    <span class="hidden sm:inline">Cari</span>
                </button>
            </div>
        </div>
    </section>

    {{-- CATEGORIES --}}
    <section class="py-24">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-black tracking-tight mb-2 text-gray-900 dark:text-white">Jelajahi Kategori</h2>
                    <p class="text-gray-400 dark:text-gray-500">Temukan program terbaik untuk akselerasi karier Anda</p>
                </div>
                <a href="#" class="text-brand-purple font-bold text-sm flex items-center gap-2 hover:underline shrink-0">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @php
                    $categoryMapping = [
                        'UI/UX Design' => [
                            'icon' => 'bi-palette',
                            'color' => 'bg-pink-500',
                        ],
                        'Web Development' => [
                            'icon' => 'bi-code-slash',
                            'color' => 'bg-blue-500',
                            'display_name' => 'Web Dev'
                        ],
                        'Mobile Development' => [
                            'icon' => 'bi-phone',
                            'color' => 'bg-emerald-500',
                            'display_name' => 'Mobile Dev'
                        ],
                        'Data Science' => [
                            'icon' => 'bi-bar-chart',
                            'color' => 'bg-purple-500',
                            'display_name' => 'Data Science'
                        ],
                    ];
                @endphp

                @foreach($kategori->take(4) as $cat)
                    @php
                        $config = $categoryMapping[$cat->nama] ?? [
                            'icon' => 'bi-grid',
                            'color' => 'bg-brand-purple',
                            'display_name' => $cat->nama
                        ];
                        $displayName = $config['display_name'] ?? $cat->nama;
                    @endphp
                    <div class="group p-5 md:p-8 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl md:rounded-[32px] transition-all hover:bg-white dark:hover:bg-gray-800 hover:shadow-2xl hover:shadow-gray-200 dark:hover:shadow-black/40 hover:-translate-y-2 cursor-pointer">
                        <div class="w-10 h-10 md:w-12 md:h-12 {{ $config['color'] }} rounded-xl md:rounded-2xl flex items-center justify-center text-white text-lg md:text-xl mb-4 md:mb-6 shadow-lg shadow-gray-200 dark:shadow-black/20 transition-transform group-hover:scale-110">
                            <i class="bi {{ $config['icon'] }}"></i>
                        </div>
                        <h4 class="text-base md:text-xl font-bold mb-1 text-gray-900 dark:text-white">{{ $displayName }}</h4>
                        <p class="text-[10px] md:text-sm text-gray-400 dark:text-gray-500 font-bold uppercase tracking-wider">{{ $cat->kursus_count }}+ KURSUS</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════ TOOLS SECTION ══════════ --}}
    <section class="py-20 bg-gray-50 dark:bg-gray-900/50 border-y border-gray-100 dark:border-gray-800 overflow-hidden">
        <div class="container mx-auto px-4 lg:px-8 mb-16">
            <p class="text-center text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em]">Kuasai berbagai tools industri terpopuler</p>
        </div>

        {{-- Marquee Container --}}
        <div class="relative flex overflow-hidden py-12">
            <div class="flex flex-nowrap gap-12 sm:gap-16 md:gap-24 lg:gap-32 animate-scroll hover:pause-animation">
                @php 
                    $tools = [
                        ['img' => 'figma.svg', 'name' => 'Figma'],
                        ['img' => 'flutter.svg', 'name' => 'Flutter'],
                        ['img' => 'react.svg', 'name' => 'React JS'],
                        ['img' => 'laravel.svg', 'name' => 'Laravel'],
                        ['img' => 'kotlin.svg', 'name' => 'Kotlin'],
                        ['img' => 'python.svg', 'name' => 'Python'],
                        ['img' => 'golang.svg', 'name' => 'Golang'],
                        ['img' => 'vuejs.svg', 'name' => 'Vue JS'],
                    ]; 
                @endphp

                {{-- Loop Pertama --}}
                @foreach($tools as $tool)
                    <div class="flex flex-col items-center gap-4 group/tool flex-none">
                        <div class="h-12 sm:h-16 md:h-20 flex items-center justify-center">
                            <img src="{{ asset('assets/' . $tool['img']) }}" alt="{{ $tool['name'] }}" class="h-full w-auto object-contain grayscale opacity-40 group-hover/tool:grayscale-0 group-hover/tool:opacity-100 transition-all duration-500 group-hover/tool:scale-110 dark:invert-0 dark:brightness-100">
                        </div>
                        <span class="text-[10px] md:text-xs font-bold text-gray-400 dark:text-gray-500 opacity-0 group-hover/tool:opacity-100 transition-opacity uppercase tracking-tighter whitespace-nowrap">{{ $tool['name'] }}</span>
                    </div>
                @endforeach

                {{-- Loop Kedua (Duplikasi untuk menyambung animasi) --}}
                @foreach($tools as $tool)
                    <div class="flex flex-col items-center gap-4 group/tool flex-none">
                        <div class="h-12 sm:h-16 md:h-20 flex items-center justify-center">
                            <img src="{{ asset('assets/' . $tool['img']) }}" alt="{{ $tool['name'] }}" class="h-full w-auto object-contain grayscale opacity-40 group-hover/tool:grayscale-0 group-hover/tool:opacity-100 transition-all duration-500 group-hover/tool:scale-110 dark:invert-0 dark:brightness-100">
                        </div>
                        <span class="text-[10px] md:text-xs font-bold text-gray-400 dark:text-gray-500 opacity-0 group-hover/tool:opacity-100 transition-opacity uppercase tracking-tighter whitespace-nowrap">{{ $tool['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FEATURED COURSES --}}
    <section id="course-section" class="py-24">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <h2 class="text-3xl font-black tracking-tight mb-2 text-gray-900 dark:text-white">Kursus Unggulan</h2>
                    <p class="text-gray-400 dark:text-gray-500">Kurasi terbaik dari mentor berpengalaman kami</p>
                </div>
                
                {{-- Tabs --}}
                <div id="category-tabs" class="flex bg-gray-100 dark:bg-gray-900 p-1.5 rounded-2xl border border-gray-300 overflow-x-auto max-w-full scrollbar-none whitespace-nowrap gap-1">
                    <button data-filter="all" class="px-6 py-2.5 bg-white dark:bg-gray-800 shadow-sm rounded-xl text-sm font-bold text-gray-900 dark:text-white transition-all">Semua Kursus</button>
                    @foreach($kategori as $kat)
                        @if($kat->kursus_count > 0 || $kursus->where('kategori_id', $kat->id)->count() > 0)
                            <button data-filter="{{ $kat->id }}" class="px-6 py-2.5 text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-all rounded-xl">
                                {{ $kat->nama }}
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
                @forelse ($kursus as $item)
                <div class="course-card group relative bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-xl sm:rounded-2xl md:rounded-[20px] overflow-hidden shadow-sm hover:shadow-2xl hover:shadow-gray-200 dark:hover:shadow-black/40 transition-all duration-500 hover:-translate-y-2 flex flex-row sm:flex-col" data-category-id="{{ $item->kategori_id }}">
                    {{-- Thumbnail --}}
                    <div class="relative w-32 sm:w-full h-auto sm:h-40 md:h-48 xl:h-56 shrink-0 overflow-hidden">
                        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('assets/course.png') }}"
                             alt="{{ $item->judul }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        {{-- Category Badge --}}
                        <div class="absolute top-1.5 left-1.5 sm:top-4 sm:left-4 px-1.5 py-0.5 sm:px-3 sm:py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm rounded-full text-[7px] sm:text-[10px] font-bold uppercase tracking-widest text-gray-900 dark:text-white shadow-sm border border-gray-100 dark:border-gray-800">
                            {{ $item->kategori->nama ?? 'Umum' }}
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-3 sm:p-5 md:p-6 lg:p-8 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-amber-400 text-[8px] sm:text-[10px] md:text-xs mb-1 sm:mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <span class="text-gray-400 dark:text-gray-500 ml-0.5 sm:ml-1 font-bold">(4.9)</span>
                            </div>

                            <h4 class="text-xs sm:text-base md:text-lg font-bold text-gray-900 dark:text-white mb-1 sm:mb-3 md:mb-4 line-clamp-2 min-h-0 sm:min-h-[2.5rem] md:min-h-[3.5rem] leading-tight sm:leading-normal group-hover:text-brand-purple transition-colors">
                                {{ $item->judul }}
                            </h4>

                            <div class="hidden sm:block text-xs md:text-sm text-gray-400 dark:text-gray-500 mb-4 md:mb-6 line-clamp-2 leading-relaxed h-8 md:h-10">
                                @if($item->deskripsi)
                                    {{ Str::limit(strip_tags($item->deskripsi), 80) }}
                                @else
                                    Pelajari skill digital dari mentor berpengalaman di bidangnya.
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1.5 sm:pt-4 md:pt-6 border-t border-gray-50 dark:border-gray-800 mt-auto">
                            <div class="flex items-center gap-1 sm:gap-2">
                                <div class="w-5 h-5 sm:w-7 sm:h-7 md:w-8 md:h-8 rounded-full bg-brand-purple-light dark:bg-brand-purple/20 flex items-center justify-center overflow-hidden ring-2 ring-white dark:ring-gray-800">
                                    @if($item->mentor && $item->mentor->photo)
                                        <img src="{{ asset('storage/' . $item->mentor->photo) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-[7px] sm:text-[9px] md:text-[10px] font-bold text-brand-purple">{{ substr($item->mentor->username ?? 'A', 0, 1) }}</span>
                                    @endif
                                </div>
                                <span class="text-[9px] sm:text-[10px] md:text-[11px] font-bold text-gray-600 dark:text-gray-400 truncate max-w-[45px] sm:max-w-[60px] md:max-w-[80px]">{{ $item->mentor->username ?? 'Admin' }}</span>
                            </div>
                            <div class="text-xs sm:text-base md:text-lg font-black text-brand-purple tracking-tighter">
                                @if ($item->harga == 0)
                                    <span class="text-emerald-500 uppercase text-[8px] sm:text-[10px] md:text-xs tracking-widest">Gratis</span>
                                @else
                                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    {{-- Hidden Link --}}
                    <a href="{{ route('kursus.show', $item->id) }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                @empty
                <div class="col-span-full py-20 text-center bg-gray-50 dark:bg-gray-900 rounded-[40px] border-2 border-dashed border-gray-200 dark:border-gray-800">
                    <i class="bi bi-folder2-open text-5xl text-gray-200 dark:text-gray-700 mb-4 block"></i>
                    <p class="text-gray-400 dark:text-gray-600 italic">Belum ada kursus tersedia.</p>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-16">
                <button class="px-10 py-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white font-bold rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-all hover:scale-105 active:scale-95 shadow-lg shadow-gray-100 dark:shadow-black/20 flex items-center gap-2 mx-auto">
                    Muat Lebih Banyak
                    <i class="bi bi-arrow-down-short text-xl"></i>
                </button>
            </div>
        </div>
    </section>

    {{-- ══════════ FOOTER ══════════ --}}
    <footer class="bg-brand-purple dark:bg-gray-900 border-t border-white/10 dark:border-gray-800 pt-20 pb-10 text-white transition-colors duration-300">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1">
                    <img src="{{ asset('assets/logo1.png') }}" class="h-10 mb-6 brightness-0 invert" alt="Flodemi">
                    <p class="text-white/70 dark:text-gray-400 text-sm leading-relaxed mb-6">
                        PT. Flashsoft Indonesia<br>
                        Jl. Naga Sakti, Kecamatan Tampan,
                        <br>Pekanbaru, Riau, Indonesia
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 dark:bg-gray-800 flex items-center justify-center text-white hover:bg-white dark:hover:bg-brand-purple hover:text-brand-purple dark:hover:text-white transition-all">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 dark:bg-gray-800 flex items-center justify-center text-white hover:bg-white dark:hover:bg-brand-purple hover:text-brand-purple dark:hover:text-white transition-all">
                            <i class="bi bi-telegram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 dark:bg-gray-800 flex items-center justify-center text-white hover:bg-white dark:hover:bg-brand-purple hover:text-brand-purple dark:hover:text-white transition-all">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h6 class="font-bold mb-6 uppercase text-[10px] tracking-widest text-white/50 dark:text-gray-500">Program</h6>
                    <ul class="space-y-4 text-sm font-bold text-white/80 dark:text-gray-400">
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">UI/UX Design</a></li>
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Web Development</a></li>
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Data Science</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="font-bold mb-6 uppercase text-[10px] tracking-widest text-white/50 dark:text-gray-500">Perusahaan</h6>
                    <ul class="space-y-4 text-sm font-bold text-white/80 dark:text-gray-400">
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Mentor Kami</a></li>
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Karier</a></li>
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Blog</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="font-bold mb-6 uppercase text-[10px] tracking-widest text-white/50 dark:text-gray-500">Bantuan</h6>
                    <ul class="space-y-4 text-sm font-bold text-white/80 dark:text-gray-400">
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Ketentuan Layanan</a></li>
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-10 border-t border-white/10 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-xs font-bold text-white/50 dark:text-gray-500">© Hak Cipta 2026 || Flashsoft Indonesia</p>
                <div class="flex gap-8 text-xs font-bold text-white/50 dark:text-gray-500">
                    <a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white dark:hover:text-brand-purple transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }

    @keyframes float-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }

    /* Keyframes for Logo Marquee */
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-50% - 1rem)); } /* -50% karena konten diduplikasi 2x */
    }

    .animate-scroll {
        animation: scroll 30s linear infinite;
        display: flex;
        width: max-content;
    }

    .pause-animation:hover {
        animation-play-state: paused;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#category-tabs button');
    const cards = document.querySelectorAll('.course-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            // Remove active styles from all tabs
            tabs.forEach(t => {
                t.classList.remove('bg-white', 'dark:bg-gray-800', 'shadow-sm', 'text-gray-900', 'dark:text-white');
                t.classList.add('text-gray-400', 'dark:text-gray-500', 'hover:text-gray-600', 'dark:hover:text-gray-300');
            });

            // Add active styles to clicked tab
            this.classList.add('bg-white', 'dark:bg-gray-800', 'shadow-sm', 'text-gray-900', 'dark:text-white');
            this.classList.remove('text-gray-400', 'dark:text-gray-500', 'hover:text-gray-600', 'dark:hover:text-gray-300');

            const filterValue = this.getAttribute('data-filter');

            cards.forEach(card => {
                if (filterValue === 'all') {
                    card.style.display = 'flex';
                } else {
                    const cardCategoryId = card.getAttribute('data-category-id');
                    if (cardCategoryId === filterValue) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>
@endsection
