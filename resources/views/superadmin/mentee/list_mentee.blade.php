<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - List Mentee'])
</head>

<body class="bg-slate-50 dark:bg-[#0f0e17] font-manrope transition-colors duration-300">
    <div class="main-wrapper">
        {{-- Sidebar --}}
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-mentee', 'activePage' => 'manajemen-mentee-list'])

        <div class="flex-1 flex flex-col min-w-0">
            {{-- Header --}}
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">
                
                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Daftar Mentee</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Kelola dan pantau data mentee yang terdaftar beserta kursus yang diikuti.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Manajemen Mentee</span>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Daftar Mentee</span>
                    </div>
                </div>

                {{-- ══════════ CONTENT CARD ══════════ --}}
                <div class="p-6 md:p-4">
                    <div class="content-card">
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between flex-wrap gap-3">
                            <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                <i class="ri-team-line text-brand-purple"></i>
                                Data Mentee
                            </div>
                        </div>

                        <div class="p-6">
                            
                            {{-- FILTER & SEARCH BAR --}}
                            <form method="GET" action="{{ route('superadmin.mentee.list') }}" class="mb-6">
                                <div class="flex items-center justify-between flex-wrap gap-4">
                                    
                                    {{-- Search Input --}}
                                    <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 focus-within:border-brand-purple focus-within:ring-4 focus-within:ring-brand-purple/10 focus-within:bg-white dark:focus-within:bg-[#13111c] transition-all flex-1 min-w-[280px]">
                                        <i class="ri-search-line text-slate-400 text-sm"></i>
                                        <input
                                            type="text"
                                            name="search"
                                            class="border-none bg-transparent outline-none text-xs font-semibold text-slate-800 dark:text-slate-200 w-full placeholder-slate-400" 
                                            placeholder="Cari nama mentee..." 
                                            value="{{ request('search') }}"
                                        >
                                    </div>

                                    {{-- Filter Kategori & Actions --}}
                                    <div class="flex items-center gap-3 flex-wrap md:w-full">
                                        <select name="kategori_id" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-xs font-bold text-slate-700 dark:text-slate-300 cursor-pointer focus:outline-none focus:border-brand-purple transition-all md:w-full min-w-[200px]" onchange="this.form.submit()">
                                            <option value="">Semua Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama }}
                                                </option>
                                            @endforeach
                                        </select>

                                        {{-- Reset Button --}}
                                        @if (request('search') || request('kategori_id'))
                                            <a href="{{ route('superadmin.mentee.list') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-705 text-slate-650 dark:text-slate-300 text-xs font-bold rounded-xl transition-all flex items-center gap-1.5 md:w-full md:justify-center">
                                                <i class="ri-refresh-line"></i> Reset Filter
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>

                            {{-- MODERN TABLE --}}
                            <div class="overflow-x-auto">
                                <table class="table-modern">
                                    <thead>
                                        <tr>
                                            <th class="w-16 text-center">No</th>
                                            <th>Nama Mentee</th>
                                            <th class="w-52">Kategori</th>
                                            <th>Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mentees as $index => $mentee)
                                            @php
                                                // Filter kursus sesuai kategori yang dipilih
                                                $kursusFiltered = request('kategori_id')
                                                    ? $mentee->kursus->where('kategori_id', request('kategori_id'))->values()
                                                    : $mentee->kursus->values();
                                            @endphp

                                            @if ($kursusFiltered->isEmpty())
                                                <tr class="hover:bg-slate-50/50 dark:hover:bg-brand-purple/5 transition-colors">
                                                    <td class="text-center font-bold text-slate-500 dark:text-slate-400">{{ $index + 1 }}</td>
                                                    <td>
                                                        <span class="font-bold text-slate-800 dark:text-slate-100">{{ $mentee->username }}</span>
                                                    </td>
                                                    <td colspan="2">
                                                        <span class="text-slate-400 dark:text-slate-500 italic text-xs flex items-center gap-1">
                                                            <i class="ri-information-line"></i> Belum mengikuti kursus
                                                        </span>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($kursusFiltered as $kursusIndex => $kursus)
                                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-brand-purple/5 transition-colors">
                                                        {{-- Rowspan Logic --}}
                                                        @if ($kursusIndex === 0)
                                                            <td rowspan="{{ $kursusFiltered->count() }}" class="text-center font-bold text-slate-500 dark:text-slate-400 align-middle">
                                                                {{ $index + 1 }}
                                                            </td>
                                                            <td rowspan="{{ $kursusFiltered->count() }}" class="align-middle border-b border-slate-50 dark:border-slate-900">
                                                                <span class="font-bold text-slate-800 dark:text-slate-100">{{ $mentee->username }}</span>
                                                            </td>
                                                        @endif
                                                        
                                                        <td>
                                                            @if($kursus->kategori)
                                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400">
                                                                    <i class="ri-folder-line text-[10px]"></i>
                                                                    {{ $kursus->kategori->nama }}
                                                                </span>
                                                            @else
                                                                <span class="text-slate-450 dark:text-slate-500">-</span>
                                                            @endif
                                                        </td>
                                                        
                                                        <td>
                                                            <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $kursus->judul }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <div class="flex flex-col items-center justify-center py-12 text-slate-400 dark:text-slate-500">
                                                        <i class="ri-inbox-line text-4xl opacity-30 mb-2"></i>
                                                        <p class="text-xs font-semibold">Tidak ada data mentee ditemukan.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if(isset($mentees) && method_exists($mentees, 'links'))
                            <div class="mt-6 flex justify-center">
                                {{ $mentees->withQueryString()->links('pagination::tailwind') }}
                            </div>
                            @endif

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