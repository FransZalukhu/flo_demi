@extends('layouts.mentee.navbar')

@section('title', $kursus->judul . ' - Flodemi')

@section('content')
<div class="bg-white dark:bg-gray-950 font-manrope transition-colors duration-300">
    {{-- HEADER / HERO --}}
    <section class="relative py-12 md:py-20 overflow-hidden bg-gradient-to-b from-white via-purple-50/30 to-white dark:from-gray-950 dark:via-brand-purple/5 dark:to-gray-950">
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
            {{-- Breadcrumbs --}}
            <nav class="flex items-center gap-2 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-6">
                <a href="{{ route('home') }}" class="hover:text-brand-purple transition-colors">Home</a>
                <i class="bi bi-chevron-right text-[10px]"></i>
                <a href="{{ route('home') }}#course-section" class="hover:text-brand-purple transition-colors">Kategori</a>
                <i class="bi bi-chevron-right text-[10px]"></i>
                <span class="text-brand-purple">{{ $kursus->kategori->nama ?? 'General' }}</span>
            </nav>

            <div class="max-w-4xl">
                {{-- Title --}}
                <h1 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white leading-tight mb-6">
                    {{ $kursus->judul }}
                </h1>

                {{-- Short Description --}}
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-8 max-w-2xl leading-relaxed">
                    @if($kursus->deskripsi)
                        {{ Str::limit(strip_tags($kursus->deskripsi), 180) }}
                    @else
                        Tingkatkan keahlian digital Anda bersama mentor berpengalaman. Kurikulum terstruktur yang dirancang untuk mempersiapkan Anda menjadi tenaga profesional di industri kreatif.
                    @endif
                </p>

                {{-- Meta Info --}}
                <div class="flex flex-wrap items-center gap-8 md:gap-12 pt-4 border-t border-gray-200 dark:border-gray-800">
                    {{-- Mentor --}}
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full overflow-hidden shadow-sm border-2 border-white dark:border-gray-800 ring-1 ring-gray-100 dark:ring-gray-800">
                            <img src="https://i.pravatar.cc/100?u={{ $kursus->id }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-0.5">Mentor</p>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $kursus->mentor->username ?? 'Admin' }}</p>
                        </div>
                    </div>

                    {{-- Rating --}}
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-0.5 text-center">Rating</p>
                        <div class="flex items-center gap-2">
                            <div class="flex text-amber-400 text-xs">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">4.9</span>
                        </div>
                    </div>

                    {{-- Students --}}
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-0.5">Terdaftar</p>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">
                            <i class="bi bi-people-fill text-brand-purple mr-1.5"></i>
                            {{ number_format($kursus->terdaftar_count) }} <span class="text-gray-400 dark:text-gray-500 font-medium">Mentee</span>
                        </p>
                    </div>

                    {{-- Quota --}}
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-0.5">Sisa Kuota</p>
                        <p class="text-sm font-bold {{ $kursus->kuota > 0 && $kursus->sisa_kuota <= 5 ? 'text-red-500' : 'text-gray-900 dark:text-white' }}">
                            <i class="bi bi-person-badge-fill text-brand-purple mr-1.5"></i>
                            @if($kursus->kuota == 0)
                                Unlimited
                            @else
                                {{ $kursus->sisa_kuota }} <span class="text-gray-400 dark:text-gray-500 font-medium">Slot</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--  MAIN CONTENT --}}
    <section class="py-12 md:py-20 relative bg-white dark:bg-gray-950">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12 items-start">
                
                {{-- LEFT COLUMN --}}
                <div class="flex-1 w-full lg:max-w-[calc(100%-400px)]">
                    
                    {{-- Local Tabs --}}
                    <div class="flex items-center gap-8 border-b border-gray-100 dark:border-gray-800 mb-6 overflow-x-auto no-scrollbar pb-1">
                        <a href="#tentang" class="text-sm font-bold text-brand-purple border-b-2 border-brand-purple pb-4 whitespace-nowrap">Deskripsi</a>
                        <a href="#benefit" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 pb-4 transition-colors whitespace-nowrap">Benefit</a>
                        <a href="#modul" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 pb-4 transition-colors whitespace-nowrap">Modul Kelas</a>
                        <a href="#mentor" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 pb-4 transition-colors whitespace-nowrap">Mentor</a>
                    </div>

                    {{-- Section: Tentang --}}
                    <div id="tentang" class="mb-2 scroll-mt-32">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-0">Tentang Kelas Ini</h2>
                        
                        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
                        
                        <div class="ql-snow">
                            <div class="ql-editor !p-0 text-gray-600 dark:text-gray-400 leading-relaxed text-[15px]">
                                @if($kursus->deskripsi)
                                    {!! $kursus->deskripsi !!}
                                @else
                                    <p>Belum Ada Deskripsi</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <style>
                        .ql-editor {
                            font-family: 'Manrope', sans-serif !important;
                            height: auto !important;
                            overflow: visible !important;
                            padding-top: 0 !important;
                        }

                        .ql-editor > *:first-child { margin-top: 4px !important; }
                        .ql-editor > *:last-child { margin-bottom: 0 !important; }
                        .ql-snow {
                            border: none !important;
                        }
                        .ql-editor ul, .ql-editor ol {
                            padding-left: 1.5em !important;
                        }
                        .ql-editor li {
                            margin-bottom: 0.3rem;
                        }
                        .dark .ql-editor h1, .dark .ql-editor h2, .dark .ql-editor h3 { color: white !important; }
                        .dark .ql-editor p { color: #9ca3af !important; }
                    </style>

                    {{-- Section: Benefit --}}
                    <div id="benefit" class="mb-12 scroll-mt-32">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8">Apa yang akan kamu dapatkan?</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @php
                                $benefits = [
                                    ['title' => 'Akses Grup Belajar', 'desc' => 'Bergabung dengan komunitas diskusi mentee dan mentor.', 'icon' => 'bi-chat-dots'],
                                    ['title' => 'Live Session', 'desc' => 'Sesi tanya jawab langsung dan review tugas mingguan.', 'icon' => 'bi-broadcast'],
                                    ['title' => 'e-Modul Premium', 'desc' => 'Materi bacaan komprehensif berformat PDF yang dapat diunduh.', 'icon' => 'bi-file-earmark-pdf'],
                                    ['title' => 'e-Sertifikat', 'desc' => 'Sertifikat kelulusan berbasis keahlian untuk portofolio CV.', 'icon' => 'bi-patch-check'],
                                ];
                            @endphp
                            @foreach($benefits as $b)
                            <div class="group p-6 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm transition-all hover:shadow-xl hover:shadow-brand-purple/10 hover:border-brand-purple/30 hover:-translate-y-1">
                                <div class="w-12 h-12 bg-gray-50 dark:bg-gray-800 text-brand-purple rounded-2xl flex items-center justify-center text-xl mb-6 transition-colors group-hover:bg-brand-purple group-hover:text-white">
                                    <i class="bi {{ $b['icon'] }}"></i>
                                </div>
                                <h4 class="text-lg font-bold mb-2 text-gray-900 dark:text-white">{{ $b['title'] }}</h4>
                                <p class="text-sm text-gray-400 dark:text-gray-500 leading-relaxed">{{ $b['desc'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Section: Modul --}}
                    <div id="modul" class="mb-20 scroll-mt-32">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl font-black text-gray-900 dark:text-white">Modul Kelas</h2>
                            <div class="flex items-center gap-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                                <span>{{ $kursus->modul->count() }} Modul Utama</span>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse ($kursus->modul as $index => $modul)
                            <div class="group p-6 bg-gray-50 dark:bg-gray-900/50 border border-transparent rounded-3xl transition-all hover:bg-white dark:hover:bg-gray-900 hover:border-brand-purple/20 hover:shadow-lg hover:shadow-gray-100 dark:hover:shadow-black/20">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <span class="text-sm font-black text-brand-purple mt-1 tracking-tighter">0{{ $index + 1 }}</span>
                                        <div>
                                            <h4 class="text-[16px] font-bold text-gray-900 dark:text-white mb-1 group-hover:text-brand-purple transition-colors">{{ $modul->judul }}</h4>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">Memahami konsep dasar dan implementasi praktis...</p>
                                        </div>
                                    </div>
                                    <div class="px-3 py-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest shadow-sm">
                                        PDF
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="p-8 text-center bg-gray-50 dark:bg-gray-900/50 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-800 text-gray-400 dark:text-gray-600 italic">
                                    Belum ada modul yang ditambahkan.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Section: Mentor --}}
                    <div id="mentor" class="mb-12 scroll-mt-32">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8">Mengenal Mentor Anda</h2>
                        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-[40px] p-8 md:p-12 shadow-sm hover:shadow-2xl hover:shadow-gray-100 dark:hover:shadow-black/20 transition-all flex flex-col md:flex-row gap-10 items-center md:items-start">
                            <div class="w-32 h-32 md:w-40 md:h-40 shrink-0 rounded-[40px] overflow-hidden shadow-2xl shadow-purple-100 dark:shadow-black/40 border-4 border-white dark:border-gray-800">
                                <img src="https://i.pravatar.cc/200?u={{ $kursus->id }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-1">{{ $kursus->mentor->username ?? 'Alex Rodriguez' }}</h3>
                                <p class="text-brand-purple font-bold text-sm mb-6 uppercase tracking-widest">Senior Product Designer @TechCorp</p>
                                <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-[15px] mb-8">
                                    Berpengalaman lebih dari 8 tahun di industri desain produk digital. Telah membantu startup dan perusahaan Fortune 500 dalam membangun antarmuka yang intuitif dan sistem desain yang scalable.
                                </p>
                                <div class="flex justify-center md:justify-start gap-4">
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center text-gray-400 dark:text-gray-500 hover:bg-brand-purple hover:text-white transition-all"><i class="bi bi-linkedin"></i></a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center text-gray-400 dark:text-gray-500 hover:bg-brand-purple hover:text-white transition-all"><i class="bi bi-dribbble"></i></a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center text-gray-400 dark:text-gray-500 hover:bg-brand-purple hover:text-white transition-all"><i class="bi bi-globe"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN (Floating Sidebar) --}}
                <div class="w-full lg:w-[360px] shrink-0 sticky top-28">
                    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-[40px] shadow-2xl shadow-gray-200/50 dark:shadow-black/40 overflow-hidden">
                        {{-- Thumbnail Preview --}}
                        <div class="relative h-52 bg-gray-100 dark:bg-gray-800">
                            <img src="{{ $kursus->gambar ? asset('storage/' . $kursus->gambar) : asset('assets/course.png') }}" class="w-full h-full object-cover">
                        </div>

                        <div class="p-8">
                            {{-- Quota Badge (Simple) --}}
                            <div class="mb-6">
                                <div class="flex items-center justify-between text-[11px] font-bold uppercase tracking-widest mb-2">
                                    <span class="text-gray-400">Kapasitas Kelas</span>
                                    <span class="{{ $kursus->kuota > 0 && $kursus->sisa_kuota <= 5 ? 'text-red-500' : 'text-brand-purple' }}">
                                        @if($kursus->kuota == 0)
                                            Unlimited Quota
                                        @else
                                            {{ $kursus->sisa_kuota }} / {{ $kursus->kuota }} Tersisa
                                        @endif
                                    </span>
                                </div>
                                <div class="w-full h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                                    @php
                                        $percent = ($kursus->kuota > 0) ? ($kursus->terdaftar_count / $kursus->kuota) * 100 : 0;
                                    @endphp
                                    @if($kursus->kuota > 0)
                                        <div class="h-full {{ $kursus->sisa_kuota <= 5 ? 'bg-red-500' : 'bg-brand-purple' }} transition-all duration-500" style="width: {{ $percent }}%"></div>
                                    @else
                                        <div class="h-full bg-brand-purple transition-all duration-500" style="width: 100%"></div>
                                    @endif
                                </div>
                            </div>

                            {{-- Pricing --}}
                            <div class="mb-8">
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">
                                        @if ($kursus->harga == 0) Gratis @else Rp{{ number_format($kursus->harga, 0, ',', '.') }} @endif
                                    </span>
                                    @if($kursus->harga > 0)
                                        <span class="px-2 py-0.5 rounded bg-red-500 text-white text-[10px] font-black">DISKON 50%</span>
                                    @endif
                                </div>
                                @if($kursus->harga > 0)
                                    <span class="text-sm text-gray-400 dark:text-gray-500 line-through">Rp{{ number_format($kursus->harga * 2, 0, ',', '.') }}</span>
                                @endif
                            </div>

                            {{-- CTA Buttons --}}
                            <div class="space-y-4 mb-8">
                                @if($kursus->isFull())
                                    <button disabled class="flex items-center justify-center w-full py-4 bg-gray-200 dark:bg-gray-800 text-gray-400 dark:text-gray-600 font-black rounded-2xl cursor-not-allowed uppercase tracking-widest text-xs">
                                        Kuota Sudah Penuh
                                    </button>
                                @else
                                    <a href="{{ route('checkout.show', $kursus->id) }}" class="flex items-center justify-center w-full py-4 bg-brand-purple text-white font-black rounded-2xl shadow-xl shadow-purple-200 dark:shadow-purple-900/20 transition-all hover:bg-brand-purple-dark hover:scale-[1.02] active:scale-95 uppercase tracking-widest text-xs">
                                        Gabung Kelas Sekarang
                                    </a>
                                @endif
                                <button class="flex items-center justify-center gap-2 w-full py-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold rounded-2xl transition-all hover:bg-gray-50 dark:hover:bg-gray-700 uppercase tracking-widest text-[10px]">
                                    <i class="bi bi-heart"></i>
                                    Simpan ke Wishlist
                                </button>
                            </div>

                            {{-- Features List --}}
                            <div class="space-y-4 pt-8 border-t border-gray-50 dark:border-gray-800">
                                <h5 class="text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.15em] mb-4">Termasuk dalam kelas:</h5>
                                <div class="flex items-center gap-3 text-sm font-bold text-gray-600 dark:text-gray-400">
                                    <i class="bi bi-journal-text text-brand-purple"></i>
                                    <span>{{ $kursus->modul->count() }} modul komprehensif</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm font-bold text-gray-600 dark:text-gray-400">
                                    <i class="bi bi-infinity text-brand-purple"></i>
                                    <span>Akses seumur hidup</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm font-bold text-gray-600 dark:text-gray-400">
                                    <i class="bi bi-tv text-brand-purple"></i>
                                    <span>Akses di HP dan Dekstop</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm font-bold text-gray-600 dark:text-gray-400">
                                    <i class="bi bi-patch-check text-brand-purple"></i>
                                    <span>Sertifikat kelulusan</span>
                                </div>
                            </div>

                            {{-- Guarantee --}}
                            <!-- <div class="mt-10 flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-800">
                                <div class="text-3xl text-gray-300 dark:text-gray-700">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div>
                                    <p class="text-[11px] font-black text-gray-900 dark:text-white uppercase tracking-wider">Garansi 7 Hari</p>
                                    <p class="text-[10px] text-gray-400 dark:text-gray-500 leading-tight">Uang kembali jika tidak puas dengan materi.</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($relatedCourses->count() > 0)
    {{-- ══════════ RELATED COURSES ══════════ --}}
    <section class="py-24 bg-white dark:bg-gray-950 border-t border-slate-100 dark:border-gray-800 transition-colors duration-300">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-6">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white flex items-center gap-4 mb-3">
                        <span class="w-2 h-8 bg-brand-purple rounded-full"></span>
                        Kelas Terkait
                    </h3>
                    <p class="text-slate-500 dark:text-gray-400 font-medium text-sm">Rekomendasi kelas lain di kategori <span class="text-brand-purple font-bold">{{ $kursus->kategori->nama ?? 'General' }}</span></p>
                </div>
                <a href="{{ route('home') }}#course-section" class="inline-flex items-center gap-2 bg-slate-50 dark:bg-gray-900 text-slate-700 dark:text-gray-300 px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-brand-purple hover:text-white transition-all shadow-sm">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
                @foreach($relatedCourses as $related)
                <div class="bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl border border-slate-100 dark:border-gray-800 shadow-sm overflow-hidden group hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-black/40 transition-all duration-500 flex flex-row sm:flex-col">
                    <div class="relative w-32 sm:w-full h-auto sm:h-40 md:h-48 overflow-hidden bg-slate-100 dark:bg-gray-800 shrink-0">
                        <img src="{{ $related->gambar ? asset('storage/' . $related->gambar) : asset('assets/course.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute top-1.5 left-1.5 sm:top-4 sm:left-4">
                            <span class="px-2 py-0.5 sm:px-3 sm:py-1 bg-black/50 backdrop-blur-md text-white text-[8px] sm:text-[9px] font-black uppercase tracking-widest rounded-lg border border-white/20">
                                {{ $related->kategori->nama ?? 'General' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-3 sm:p-5 md:p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h4 class="text-xs sm:text-[15px] font-bold text-slate-900 dark:text-white mb-2 sm:mb-4 line-clamp-2 min-h-0 sm:min-h-[2.5rem] leading-tight sm:leading-snug group-hover:text-brand-purple transition-colors">
                                {{ $related->judul }}
                            </h4>
                            
                            <div class="flex items-center gap-1.5 sm:gap-3 mb-2 sm:mb-6">
                                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-lg bg-brand-purple/10 dark:bg-brand-purple/20 flex items-center justify-center font-bold text-brand-purple border border-brand-purple/10 dark:border-brand-purple/20 text-[8px] sm:text-[10px]">
                                    {{ strtoupper(substr($related->mentor->username ?? '?', 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[7px] sm:text-[9px] text-slate-400 dark:text-gray-500 font-bold uppercase tracking-wider mb-0.5">Mentor</p>
                                    <p class="text-[10px] sm:text-xs font-bold text-slate-700 dark:text-gray-300 truncate">{{ $related->mentor->username ?? 'Mentor' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2.5 sm:pt-5 border-t border-slate-50 dark:border-gray-800 flex items-center justify-between mt-auto">
                            <div>
                                <p class="text-[7px] sm:text-[9px] text-slate-400 dark:text-gray-500 font-bold uppercase tracking-wider mb-0.5">Investasi</p>
                                <p class="text-xs sm:text-sm font-black text-brand-purple tracking-tighter">
                                    @if ($related->harga == 0) Gratis @else Rp{{ number_format($related->harga, 0, ',', '.') }} @endif
                                </p>
                            </div>
                            <a href="{{ route('kursus.show', $related->id) }}" class="w-7 h-7 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-purple-50 dark:bg-brand-purple/10 text-brand-purple flex items-center justify-center hover:bg-brand-purple hover:text-white transition-all shadow-sm">
                                <i class="bi bi-arrow-up-right text-xs sm:text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection
