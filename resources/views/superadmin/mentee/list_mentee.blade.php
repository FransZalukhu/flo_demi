<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - List Mentee'])
    
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        /* ─────────────────────────────────────────────────────
           1. CSS VARIABLES & GLOBAL RESET
           ───────────────────────────────────────────────────── */
        :root {
            --brand-purple: #9F66AF;
            --brand-purple-dark: #8b55a0;
            --brand-purple-light: rgba(159, 102, 175, 0.15);
            
            --text-primary: #2d3436;
            --text-secondary: #636e72;
            --text-muted: #b2bec3;
            
            --bg-body: #f5f6fa;
            --card-bg: #ffffff;
            --input-bg: #f8f9fa;
            --input-focus-bg: #ffffff;
            --border-color: #e0e0e0;
            
            --danger: #d63031;
            --danger-light: rgba(214, 48, 49, 0.1);
            --success: #00b894;
            --success-light: rgba(0, 184, 148, 0.1);
        }

        [data-theme="dark"] {
            --bg-body: #0f0d17;
            --text-primary: #e5e7eb;
            --text-secondary: #9ca3af;
            --text-muted: #6b7280;
            --card-bg: #13111c;
            --input-bg: #1a1825;
            --input-focus-bg: #221f30;
            --border-color: rgba(255,255,255,0.08);
            --brand-purple-light: rgba(159, 102, 175, 0.25);
        }

        /* ─────────────────────────────────────────────────────
           2. MODERN LAYOUT (REFERENCE)
           ───────────────────────────────────────────────────── */
        .main-wrapper { display: flex; min-height: 100vh; background: var(--bg-body); }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slideUp 0.6s ease-out forwards; opacity: 0; }
        .delay-1 { animation-delay: 0.1s; }

        /* Page Hero */
        .page-hero {
            padding: 32px 32px 10px;
        }
        .page-hero-greeting {
            font-size: 26px; font-weight: 800; color: var(--text-primary);
            letter-spacing: -0.5px; margin-bottom: 6px;
        }
        .page-hero-greeting span {
            background: linear-gradient(135deg, var(--brand-purple), #c084fc);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .page-hero-sub { font-size: 14px; color: var(--text-secondary); margin-bottom: 20px; }
        
        .breadcrumb-modern {
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; font-weight: 600; color: var(--text-secondary);
        }
        .breadcrumb-modern a { color: var(--brand-purple); text-decoration: none; }
        .breadcrumb-modern a:hover { text-decoration: underline; }
        .breadcrumb-modern .separator { color: var(--text-muted); }
        .breadcrumb-modern .current { color: var(--text-muted); }

        /* Content Card */
        .content-card {
            background: var(--card-bg);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .content-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between;
        }
        .content-card-title {
            font-size: 16px; font-weight: 800; color: var(--text-primary);
            display: flex; align-items: center; gap: 10px;
        }
        .content-card-title i { color: var(--brand-purple); font-size: 20px; }
        .content-card-body { padding: 24px; }

        /* Form Elements */
        .form-modern .form-control, .form-modern .form-select {
            padding: 10px 14px; border-radius: 10px; border: 1px solid var(--border-color);
            background: var(--input-bg); color: var(--text-primary);
            font-size: 13px; outline: none; transition: all 0.2s;
        }
        .form-modern .form-control:focus, .form-modern .form-select:focus {
            border-color: var(--brand-purple); background: var(--input-focus-bg);
            box-shadow: 0 0 0 3px var(--brand-purple-light);
        }
        .form-modern .form-control::placeholder { color: var(--text-muted); opacity: 0.7; }

        /* Buttons */
        .btn-brand {
            display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px;
            border-radius: 8px; font-size: 13px; font-weight: 600;
            border: none; cursor: pointer; transition: 0.2s; text-decoration: none;
        }
        .btn-brand-primary { background: var(--brand-purple); color: #fff; box-shadow: 0 4px 14px rgba(159,102,175,0.25); }
        .btn-brand-primary:hover { background: var(--brand-purple-dark); color: #fff; transform: translateY(-1px); }
        .btn-brand-muted { background: transparent; color: var(--text-secondary); font-size: 12px; }
        .btn-brand-muted:hover { color: var(--danger); text-decoration: underline; }

        /* ─────────────────────────────────────────────────────
           3. MODERN TABLE STYLES
           ───────────────────────────────────────────────────── */
        .table-responsive { overflow-x: auto; border-radius: 12px; border: 1px solid var(--border-color); }
        
        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
        }

        .modern-table thead th {
            background: var(--input-bg);
            color: var(--text-secondary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 11px;
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            transition: background 0.35s ease, color 0.35s ease, border-color 0.35s ease;
        }
        
        .modern-table thead th:first-child { border-radius: 12px 0 0 0; }
        .modern-table thead th:last-child { border-radius: 0 12px 0 0; }

        .modern-table tbody tr {
            background: var(--card-bg);
            transition: background 0.2s ease;
        }

        .modern-table tbody tr:hover {
            background: var(--input-bg);
        }

        .modern-table td {
            padding: 16px;
            color: var(--text-primary);
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
            transition: color 0.35s ease, border-color 0.35s ease, background 0.2s ease;
        }
        
        .modern-table tr:last-child td { border-bottom: none; }
        
        .badge-category {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 4px 10px; border-radius: 6px;
            font-size: 11px; font-weight: 700;
            background: rgba(59,130,246,0.1); color: #3b82f6;
            transition: background 0.35s ease, color 0.35s ease;
        }

        .text-empty-state {
            text-align: center; padding: 40px; color: var(--text-muted);
            font-size: 14px;
        }

        .mentee-name {
            font-weight: 700; color: var(--text-primary);
            transition: color 0.35s ease;
        }

        .course-name {
            font-weight: 500; color: var(--text-secondary);
            transition: color 0.35s ease;
        }

        /* ─────────────────────────────────────────────────────
           4. EXPLICIT DARK MODE OVERRIDES (MATCH REFERENCE)
           ───────────────────────────────────────────────────── */

        /* ── Content Card ── */
        [data-theme="dark"] .content-card {
            background: #13111c !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .content-card-header {
            border-bottom-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .content-card-title {
            color: #f3f4f6 !important;
        }

        /* ── Page Hero ── */
        [data-theme="dark"] .page-hero-greeting {
            color: #e5e7eb !important;
        }

        [data-theme="dark"] .page-hero-sub {
            color: #9ca3af !important;
        }

        [data-theme="dark"] .breadcrumb-modern .current {
            color: #6b7280 !important;
        }

        /* ── Form Controls ── */
        [data-theme="dark"] .form-modern .form-control,
        [data-theme="dark"] .form-modern .form-select {
            background: #1a1825 !important;
            border-color: rgba(255,255,255,0.08) !important;
            color: #e5e7eb !important;
        }

        [data-theme="dark"] .form-modern .form-control:focus,
        [data-theme="dark"] .form-modern .form-select:focus {
            background: #221f30 !important;
            border-color: var(--brand-purple) !important;
            box-shadow: 0 0 0 3px var(--brand-purple-light) !important;
        }

        [data-theme="dark"] .form-modern .form-control::placeholder {
            color: #6b7280 !important;
        }

        [data-theme="dark"] .form-modern .form-select option {
            background: #1a1825 !important;
            color: #e5e7eb !important;
        }

        /* ── Table Responsive ── */
        [data-theme="dark"] .table-responsive {
            background: #13111c !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        /* ── Table THEAD ── */
        [data-theme="dark"] .modern-table thead th {
            background: #1a1825 !important;
            color: #9ca3af !important;
            border-bottom-color: rgba(255,255,255,0.08) !important;
        }

        /* ── Table TBODY ROW ── */
        [data-theme="dark"] .modern-table tbody tr {
            background: #13111c !important;
        }

        /* ── Table TBODY ROW HOVER ── */
        [data-theme="dark"] .modern-table tbody tr:hover {
            background: rgba(159, 102, 175, 0.08) !important;
        }

        /* ── Table TBODY CELL ── */
        [data-theme="dark"] .modern-table td {
            color: #e5e7eb !important;
            border-bottom-color: rgba(255,255,255,0.06) !important;
            background: inherit !important;
        }

        /* ── Mentee Name ── */
        [data-theme="dark"] .mentee-name {
            color: #f3f4f6 !important;
        }

        /* ── Course Name ── */
        [data-theme="dark"] .course-name {
            color: #9ca3af !important;
        }

        /* ── Badge Category ── */
        [data-theme="dark"] .badge-category {
            background: rgba(59,130,246,0.15) !important;
            color: #60a5fa !important;
        }

        /* ── Muted text in table ── */
        [data-theme="dark"] .modern-table .text-muted {
            color: #6b7280 !important;
        }

        /* ── Buttons ── */
        [data-theme="dark"] .btn-brand-muted {
            color: #9ca3af !important;
        }

        [data-theme="dark"] .btn-brand-muted:hover {
            color: #f87171 !important;
        }

        /* ── Search icon ── */
        [data-theme="dark"] .search-icon {
            color: #6b7280 !important;
        }

        /* ── Empty state ── */
        [data-theme="dark"] .text-empty-state {
            color: #6b7280 !important;
        }

        [data-theme="dark"] .text-empty-state i {
            color: #6b7280 !important;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        {{-- Sidebar --}}
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-mentee', 'activePage' => 'manajemen-mentee-list'])

        <div style="flex:1;display:flex;flex-direction:column;min-height:100vh;">
            {{-- Header --}}
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">
                
                {{-- 1. PAGE HERO --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Daftar Mentee</span> 
                    </div>
                    <p class="page-hero-sub">
                        Kelola dan pantau data mentee yang terdaftar beserta kursus yang diikuti.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Manajemen Mentee</span>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Daftar Mentee</span>
                    </div>
                </div>

                {{-- 2. CONTENT CARD --}}
                <div style="padding: 24px 32px 32px;">
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            
                            <div class="content-card animate-slide-up delay-1">
                                <div class="content-card-header">
                                    <div class="content-card-title">
                                        <i class="ri-list-check"></i>
                                        Data Mentee
                                    </div>
                                </div>

                                <div class="content-card-body">
                                    
                                    {{-- FILTER & SEARCH BAR --}}
                                    <form method="GET" action="{{ route('superadmin.mentee.list') }}" class="form-modern mb-4">
                                        <div style="display:flex; flex-wrap:wrap; gap:16px; align-items:center; justify-content:space-between;">
                                            
                                            {{-- Search Input --}}
                                            <div style="position:relative; flex:1; min-width:250px; max-width:400px;">
                                                <i class="ri-search-line search-icon" style="position:absolute; left:12px; top:10px; color:var(--text-muted);"></i>
                                                <input
                                                    type="text"
                                                    name="search"
                                                    class="form-control" 
                                                    placeholder="Cari nama mentee..." 
                                                    value="{{ request('search') }}"
                                                    style="padding-left:36px;"
                                                >
                                            </div>

                                            {{-- Filter Kategori & Actions --}}
                                            <div style="display:flex; gap:12px; align-items:center;">
                                                <select name="kategori_id" class="form-select" style="min-width:200px;" onchange="this.form.submit()">
                                                    <option value="">Semua Kategori</option>
                                                    @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                            {{ $kategori->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                {{-- Reset Button --}}
                                                @if (request('search') || request('kategori_id'))
                                                    <a href="{{ route('superadmin.mentee.list') }}" class="btn-brand btn-brand-muted">
                                                        <i class="ri-refresh-line"></i> Reset Filter
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>

                                    {{-- MODERN TABLE --}}
                                    <div class="table-responsive">
                                        <table class="modern-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px; text-align: center;">No</th>
                                                    <th>Nama Mentee</th>
                                                    <th>Kategori</th>
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
                                                        <tr>
                                                            <td style="text-align: center;">{{ $index + 1 }}</td>
                                                            <td>
                                                                <span class="mentee-name">{{ $mentee->username }}</span>
                                                            </td>
                                                            <td colspan="2">
                                                                <span class="text-muted fst-italic" style="font-size:13px;">
                                                                    <i class="ri-information-line"></i> Belum mengikuti kursus
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($kursusFiltered as $kursusIndex => $kursus)
                                                            <tr>
                                                                {{-- Rowspan Logic --}}
                                                                @if ($kursusIndex === 0)
                                                                    <td rowspan="{{ $kursusFiltered->count() }}" style="text-align: center; vertical-align: middle;">
                                                                        {{ $index + 1 }}
                                                                    </td>
                                                                    <td rowspan="{{ $kursusFiltered->count() }}" style="vertical-align: middle;">
                                                                        <div style="display:flex; align-items:center; gap:10px;">
                                                                            <span class="mentee-name">{{ $mentee->username }}</span>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                                
                                                                <td>
                                                                    @if($kursus->kategori)
                                                                        <span class="badge-category">
                                                                            <i class="ri-folder-line" style="font-size:10px;"></i>
                                                                            {{ $kursus->kategori->nama }}
                                                                        </span>
                                                                    @else
                                                                        <span class="text-muted">-</span>
                                                                    @endif
                                                                </td>
                                                                
                                                                <td>
                                                                    <span class="course-name">{{ $kursus->judul }}</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="4">
                                                            <div class="text-empty-state">
                                                                <i class="ri-inbox-line" style="font-size:32px; display:block; margin-bottom:10px; opacity:0.3;"></i>
                                                                Tidak ada data mentee ditemukan.
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Pagination --}}
                                    <div class="pagination-modern">
                                        {{ $mentees->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>

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