<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Modul Course'])

    <style>
        /* ══════════ PAGE HERO ══════════ */
        .page-hero {
            padding: 32px 32px 0;
        }

        .page-hero-greeting {
            font-size: 26px;
            font-weight: 800;
            color: #1f2937;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .page-hero-greeting {
            color: #f3f4f6 !important;
        }

        .page-hero-greeting span {
            background: linear-gradient(135deg, #9F66AF, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-hero-sub {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 20px;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .page-hero-sub {
            color: #9ca3af !important;
        }

        .breadcrumb-modern {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .breadcrumb-modern a {
            color: #9F66AF;
            text-decoration: none;
        }

        .breadcrumb-modern a:hover { text-decoration: underline; }

        .breadcrumb-modern .separator { color: #9ca3af; }

        .breadcrumb-modern .current { color: #6b7280; }

        [data-theme="dark"] .breadcrumb-modern .separator,
        [data-theme="dark"] .breadcrumb-modern .current {
            color: #9ca3af !important;
        }

        /* ══════════ CONTENT CARD ══════════ */
        .content-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: background 0.35s ease, border-color 0.35s ease;
        }

        [data-theme="dark"] .content-card {
            background: #13111c !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        .content-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            transition: border-color 0.35s ease;
        }

        [data-theme="dark"] .content-card-header {
            border-bottom-color: rgba(255,255,255,0.08) !important;
        }

        .content-card-title {
            font-size: 16px;
            font-weight: 800;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .content-card-title {
            color: #f3f4f6 !important;
        }

        .content-card-title i { color: #9F66AF; }

        .content-card-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* ══════════ SEARCH & FILTER ══════════ */
        .search-input-modern {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            transition: all 0.2s;
        }

        .search-input-modern:focus-within {
            border-color: #9F66AF;
            box-shadow: 0 0 0 3px rgba(159,102,175,0.10);
            background: #ffffff;
        }

        [data-theme="dark"] .search-input-modern {
            background: #1a1825 !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .search-input-modern:focus-within {
            background: #1a1825 !important;
            border-color: #9F66AF !important;
        }

        .search-input-modern i {
            color: #6b7280;
            font-size: 15px;
        }

        [data-theme="dark"] .search-input-modern i {
            color: #9ca3af !important;
        }

        .search-input-modern input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            font-weight: 500;
            color: #1f2937;
            width: 180px;
        }

        [data-theme="dark"] .search-input-modern input {
            color: #f3f4f6 !important;
        }

        .search-input-modern input::placeholder { color: #9ca3af; }

        .filter-select-modern {
            padding: 8px 14px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
            background: #f9fafb;
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s, background 0.35s, color 0.35s;
        }

        .filter-select-modern:focus {
            border-color: #9F66AF;
            box-shadow: 0 0 0 3px rgba(159,102,175,0.10);
        }

        [data-theme="dark"] .filter-select-modern {
            background: #1a1825 !important;
            color: #f3f4f6 !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .filter-select-modern option {
            background: #1a1826;
            color: #f0eef5;
        }

        /* ══════════ BUTTONS ══════════ */
        .btn-brand {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-brand-primary {
            background: #9F66AF;
            color: #fff;
            box-shadow: 0 4px 14px rgba(159,102,175,0.25);
        }

        .btn-brand-primary:hover {
            background: #8b56a0;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(159,102,175,0.35);
        }

        .btn-brand-muted {
            background: #e5e7eb;
            color: #374151;
        }

        [data-theme="dark"] .btn-brand-muted {
            background: rgba(255,255,255,0.08) !important;
            color: #9ca3af !important;
        }

        .btn-brand-muted:hover {
            background: #9ca3af;
            color: #fff;
        }

        .btn-brand-danger {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 4px 14px rgba(239,68,68,0.25);
        }

        .btn-brand-danger:hover {
            background: #dc2626;
            color: #fff;
        }

        /* ══════════════════════════════════════
           TABLE — ROBUST DARK/LIGHT MODE
        ══════════════════════════════════════ */
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-modern thead th {
            padding: 12px 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6b7280;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            white-space: nowrap;
            transition: background 0.35s ease, color 0.35s ease, border-color 0.35s ease;
        }

        .table-modern tbody tr {
            transition: background 0.2s ease;
            background: #ffffff;
        }

        .table-modern tbody tr:hover {
            background: #f3f0f7;
        }

        .table-modern tbody td {
            padding: 14px 20px;
            font-size: 13px;
            font-weight: 500;
            color: #1f2937;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
            background: inherit;
            transition: color 0.35s ease, border-color 0.35s ease, background 0.2s ease;
        }

        [data-theme="dark"] .table-responsive {
            background: #13111c !important;
        }

        [data-theme="dark"] .table-modern thead th {
            background: #1a1825 !important;
            color: #9ca3af !important;
            border-bottom-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .table-modern tbody tr {
            background: #13111c !important;
        }

        [data-theme="dark"] .table-modern tbody tr:hover {
            background: rgba(159, 102, 175, 0.08) !important;
        }

        [data-theme="dark"] .table-modern tbody td {
            color: #e5e7eb !important;
            border-bottom-color: rgba(255,255,255,0.06) !important;
            background: inherit !important;
        }

        /* ══════════ TABLE CELLS ══════════ */
        .badge-role {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            background: rgba(59,130,246,0.1);
            color: #3b82f6;
            transition: background 0.35s ease, color 0.35s ease;
        }

        [data-theme="dark"] .badge-role {
            background: rgba(59,130,246,0.15) !important;
            color: #60a5fa !important;
        }

        .table-modern .module-title {
            font-weight: 700;
            color: #1f2937;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .module-title {
            color: #f3f4f6 !important;
        }

        .table-modern .order-num {
            font-weight: 700;
            color: #9F66AF;
        }

        [data-theme="dark"] .table-modern .order-num {
            color: #c084fc !important;
        }

        /* ══════════ ACTION BTNS ══════════ */
        .action-btns {
            display: flex;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            background: transparent;
            white-space: nowrap;
        }

        .action-btn.edit {
            border-color: rgba(16,185,129,0.3);
            color: #10b981;
        }

        .action-btn.edit:hover {
            background: rgba(16,185,129,0.1);
            border-color: #10b981;
        }

        [data-theme="dark"] .action-btn.edit {
            border-color: rgba(52,211,153,0.25) !important;
            color: #34d399 !important;
        }

        [data-theme="dark"] .action-btn.edit:hover {
            background: rgba(16,185,129,0.15) !important;
        }

        .action-btn.delete {
            border-color: rgba(239,68,68,0.3);
            color: #ef4444;
        }

        .action-btn.delete:hover {
            background: rgba(239,68,68,0.1);
            border-color: #ef4444;
        }

        [data-theme="dark"] .action-btn.delete {
            border-color: rgba(248,113,113,0.25) !important;
            color: #f87171 !important;
        }

        [data-theme="dark"] .action-btn.delete:hover {
            background: rgba(239,68,68,0.15) !important;
        }

        .action-btn.view-proof {
            border-color: rgba(159,102,175,0.3);
            color: #9F66AF;
        }

        .action-btn.view-proof:hover {
            background: rgba(159,102,175,0.1);
            border-color: #9F66AF;
        }

        [data-theme="dark"] .action-btn.view-proof {
            border-color: rgba(192,132,252,0.25) !important;
            color: #c084fc !important;
        }

        [data-theme="dark"] .action-btn.view-proof:hover {
            background: rgba(159,102,175,0.15) !important;
        }

        .no-file-text {
            font-size: 12px;
            font-weight: 500;
            color: #9ca3af;
            font-style: italic;
        }

        /* ══════════ EMPTY STATE ══════════ */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 48px;
            color: #9ca3af;
            opacity: 0.3;
        }

        .empty-state p {
            font-size: 14px;
            color: #9ca3af;
            margin-top: 12px;
        }

        /* ══════════ ALERTS ══════════ */
        .alert-modern {
            padding: 14px 20px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
            transition: background 0.35s ease, border-color 0.35s ease, color 0.35s ease;
        }

        .alert-modern i {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-modern.alert-success {
            background: rgba(16,185,129,0.1);
            border-color: rgba(16,185,129,0.25);
            color: #10b981;
        }

        [data-theme="dark"] .alert-modern.alert-success {
            background: rgba(16,185,129,0.1) !important;
            border-color: rgba(52,211,153,0.2) !important;
            color: #34d399 !important;
        }

        .alert-modern.alert-danger {
            background: rgba(239,68,68,0.1);
            border-color: rgba(239,68,68,0.25);
            color: #ef4444;
        }

        [data-theme="dark"] .alert-modern.alert-danger {
            background: rgba(239,68,68,0.1) !important;
            border-color: rgba(248,113,113,0.2) !important;
            color: #f87171 !important;
        }

        /* ══════════ MODAL ══════════ */
        .modal-modern .modal-content {
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0,0,0,0.15);
            background: #ffffff;
            transition: background 0.35s ease, border-color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-content {
            background: #1a1825 !important;
            border-color: rgba(255,255,255,0.08) !important;
            box-shadow: 0 25px 80px rgba(0,0,0,0.5);
        }

        .modal-modern .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: #ffffff;
            transition: background 0.35s ease, border-color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-header {
            background: #1a1825 !important;
            border-bottom-color: rgba(255,255,255,0.08) !important;
        }

        .modal-modern .modal-title {
            font-weight: 800;
            font-size: 16px;
            color: #1f2937;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-title {
            color: #f3f4f6 !important;
        }

        .modal-modern .modal-body {
            padding: 24px;
            font-size: 14px;
            color: #6b7280;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-body {
            color: #9ca3af !important;
        }

        .modal-modern .modal-body p.modal-desc {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 8px;
            line-height: 1.6;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-body p.modal-desc {
            color: #9ca3af !important;
        }

        .modal-modern .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            transition: border-color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-footer {
            border-top-color: rgba(255,255,255,0.08) !important;
        }

        .modal-modern .btn-close { filter: none; }

        [data-theme="dark"] .modal-modern .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* ══════════ FORM INSIDE MODAL ══════════ */
        .modal-modern .form-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #6b7280;
            display: block;
            margin-bottom: 8px;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .form-label {
            color: #9ca3af !important;
        }

        .modal-modern .form-control,
        .modal-modern .form-select {
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            font-size: 13px;
            font-weight: 500;
            color: #1f2937;
            background: #f9fafb;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.35s ease, color 0.35s ease;
        }

        .modal-modern .form-control:focus,
        .modal-modern .form-select:focus {
            border-color: #9F66AF;
            box-shadow: 0 0 0 3px rgba(159,102,175,0.10);
            background: #ffffff;
        }

        [data-theme="dark"] .modal-modern .form-control,
        [data-theme="dark"] .modal-modern .form-select {
            background: #13111c !important;
            color: #f3f4f6 !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .modal-modern .form-control:focus,
        [data-theme="dark"] .modal-modern .form-select:focus {
            background: #13111c !important;
            border-color: #9F66AF !important;
            color: #f3f4f6 !important;
        }

        [data-theme="dark"] .modal-modern .form-select option {
            background: #1a1826;
            color: #f0eef5;
        }

        .modal-modern .form-text {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 6px;
        }

        .modal-modern .form-control::placeholder {
            color: #9ca3af;
        }

        /* ══════════ PAGINATION ══════════ */
        .pagination-modern {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .pagination-modern .page-link {
            border-radius: 10px !important;
            margin: 0 3px;
            font-size: 12px;
            font-weight: 700;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            padding: 8px 14px;
            transition: all 0.2s;
            background: #ffffff;
        }

        .pagination-modern .page-link:hover {
            background: rgba(159,102,175,0.1);
            border-color: #9F66AF;
            color: #9F66AF;
        }

        [data-theme="dark"] .pagination-modern .page-link {
            background: #1a1825 !important;
            color: #9ca3af !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .pagination-modern .page-link:hover {
            background: rgba(159,102,175,0.15) !important;
            border-color: #c084fc !important;
            color: #c084fc !important;
        }

        .pagination-modern .page-item.active .page-link {
            background: #9F66AF !important;
            border-color: #9F66AF !important;
            color: #fff !important;
        }

        .pagination-modern .page-item.disabled .page-link {
            background: #f9fafb;
            color: #9ca3af;
            border-color: #e5e7eb;
        }

        [data-theme="dark"] .pagination-modern .page-item.disabled .page-link {
            background: #13111c !important;
            color: #4b5563 !important;
            border-color: rgba(255,255,255,0.05) !important;
        }

        /* ══════════ ANIMATIONS ══════════ */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-slide-up { animation: slideUp 0.5s ease-out forwards; }

        .delay-1 { animation-delay: 0.1s; opacity: 0; }

        /* ══════════ RESPONSIVE ══════════ */
        @media (max-width: 767.98px) {
            .page-hero { padding: 20px 16px 0; }
            .page-hero-greeting { font-size: 20px; }
            .content-card-header { padding: 16px; }
            .table-modern thead th,
            .table-modern tbody td { padding: 10px 12px; }
            .search-input-modern input { width: 120px; }
            .content-card-toolbar { width: 100%; }
            .action-btns { flex-wrap: wrap; }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-modul'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Manajemen Modul</span> 
                    </div>
                    <p class="page-hero-sub">
                        Tambah, edit, dan kelola modul pembelajaran pada setiap kursus.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('superadmin.course.list') }}">Manajemen Course</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Modul</span>
                    </div>
                </div>

                {{-- ══════════ CONTENT ══════════ --}}
                <div style="padding:24px 32px 32px;">

                    {{-- Alerts --}}
                    @if (session('success'))
                    <div class="alert-modern alert-success animate-slide-up">
                        <i class="ri-check-double-line"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert-modern alert-danger animate-slide-up">
                        <i class="ri-error-warning-line"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    @endif

                    <div class="content-card animate-slide-up delay-1">
                        <div class="content-card-header">
                            <div class="content-card-title">
                                <i class="ri-folder-3-line"></i>
                                Daftar Modul
                            </div>
                            <div class="content-card-toolbar">
                                <form method="GET" action="{{ route('superadmin.course.modul') }}" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                                    <div class="search-input-modern">
                                        <i class="ri-search-line"></i>
                                        <input type="text" name="search" placeholder="Cari modul..." value="{{ request('search') }}">
                                    </div>
                                    <select name="kursus_id" class="filter-select-modern" onchange="this.form.submit()">
                                        <option value="">Semua Kursus</option>
                                        @foreach ($kursusAll as $k)
                                            <option value="{{ $k->id }}" {{ request('kursus_id') == $k->id ? 'selected' : '' }}>
                                                {{ $k->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (request('search') || request('kursus_id'))
                                    <a href="{{ route('superadmin.course.modul') }}" class="btn-brand btn-brand-muted" style="padding:8px 14px;">
                                        <i class="ri-refresh-line"></i> Reset
                                    </a>
                                    @endif
                                </form>
                                <button class="btn-brand btn-brand-primary" data-bs-toggle="modal" data-bs-target="#modalTambahModul">
                                    <i class="ri-add-line"></i> Tambah Modul
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kursus</th>
                                        <th>Judul Modul</th>
                                        <th>Urutan</th>
                                        <th>File PDF</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($moduls as $index => $modul)
                                    <tr>
                                        <td style="font-weight:700;color:#6b7280;">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge-role">
                                                <i class="ri-book-open-line" style="font-size:10px;"></i>
                                                {{ $modul->kursus->judul ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="module-title">{{ $modul->judul }}</span>
                                        </td>
                                        <td>
                                            <span class="order-num">{{ $modul->urutan }}</span>
                                        </td>
                                        <td>
                                            @if ($modul->file)
                                                <a href="{{ asset('storage/' . $modul->file) }}" target="_blank" class="action-btn view-proof">
                                                    <i class="ri-file-pdf-2-line"></i> Lihat PDF
                                                </a>
                                            @else
                                                <span class="no-file-text">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="action-btn edit" onclick="bukaModalEdit(
                                                    {{ $modul->id }},
                                                    {{ $modul->kursus_id }},
                                                    '{{ addslashes($modul->judul) }}',
                                                    {{ $modul->urutan }}
                                                )">
                                                    <i class="ri-edit-line"></i> Edit
                                                </button>
                                                <button class="action-btn delete" onclick="bukaModalHapus({{ $modul->id }}, '{{ addslashes($modul->judul) }}')">
                                                    <i class="ri-delete-bin-line"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state">
                                                <i class="ri-inbox-line"></i>
                                                <p>Tidak ada data modul ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if(method_exists($moduls, 'links'))
                        <div class="pagination-modern">
                            {{ $moduls->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    </div>

                </div>

            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ MODAL TAMBAH MODUL ══════════ --}}
    <div class="modal fade modal-modern" id="modalTambahModul" tabindex="-1" aria-labelledby="labelTambah" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelTambah">
                        <i class="ri-add-circle-line" style="color:#9F66AF;margin-right:6px;"></i>
                        Tambah Modul
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('superadmin.course.modul.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kursus <span style="color:#ef4444;">*</span></label>
                            <select name="kursus_id" class="form-select" required>
                                <option value="">-- Pilih Kursus --</option>
                                @foreach ($kursusAll as $k)
                                    <option value="{{ $k->id }}" {{ old('kursus_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul Modul <span style="color:#ef4444;">*</span></label>
                            <input type="text" name="judul" class="form-control" placeholder="Contoh: Pengenalan UI/UX" value="{{ old('judul') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Urutan <span style="color:#ef4444;">*</span></label>
                            <input type="number" name="urutan" class="form-control" min="1" placeholder="1" value="{{ old('urutan') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">File PDF <span style="color:#ef4444;">*</span></label>
                            <input type="file" name="file" class="form-control" accept=".pdf" required>
                            <div class="form-text">Format: PDF. Maksimal 20MB.</div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display:flex;gap:10px;justify-content:flex-end;">
                        <button type="button" class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-brand btn-brand-primary">
                            <i class="ri-save-line"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ══════════ MODAL EDIT MODUL ══════════ --}}
    <div class="modal fade modal-modern" id="modalEditModul" tabindex="-1" aria-labelledby="labelEdit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelEdit">
                        <i class="ri-edit-line" style="color:#10b981;margin-right:6px;"></i>
                        Edit Modul
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kursus <span style="color:#ef4444;">*</span></label>
                            <select name="kursus_id" id="edit_kursus_id" class="form-select" required>
                                <option value="">-- Pilih Kursus --</option>
                                @foreach ($kursusAll as $k)
                                    <option value="{{ $k->id }}">{{ $k->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul Modul <span style="color:#ef4444;">*</span></label>
                            <input type="text" name="judul" id="edit_judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Urutan <span style="color:#ef4444;">*</span></label>
                            <input type="number" name="urutan" id="edit_urutan" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ganti File PDF</label>
                            <input type="file" name="file" class="form-control" accept=".pdf">
                            <div class="form-text">Kosongkan jika tidak ingin mengganti file. Format: PDF. Maksimal 20MB.</div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display:flex;gap:10px;justify-content:flex-end;">
                        <button type="button" class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-brand btn-brand-success">
                            <i class="ri-save-line"></i> Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ══════════ MODAL HAPUS MODUL ══════════ --}}
    <div class="modal fade modal-modern" id="modalHapusModul" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ri-delete-bin-line" style="color:#ef4444;margin-right:6px;"></i>
                        Hapus Modul
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formHapus" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p class="modal-desc">Apakah Anda yakin ingin menghapus modul:</p>
                        <p style="font-weight:800;font-size:15px;color:#1f2937;margin-bottom:8px;" id="namaModulHapus"></p>
                        <p style="font-size:12px;color:#ef4444;display:flex;align-items:center;gap:4px;">
                            <i class="ri-error-warning-line"></i> File PDF yang terkait juga akan ikut dihapus.
                        </p>
                    </div>
                    <div class="modal-footer" style="display:flex;gap:10px;justify-content:flex-end;">
                        <button type="button" class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-brand btn-brand-danger">
                            <i class="ri-delete-bin-line"></i> Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
        function bukaModalEdit(id, kursusId, judul, urutan) {
            document.getElementById('formEdit').action = '/superadmin/course/modul/' + id + '/update';
            document.getElementById('edit_kursus_id').value = kursusId;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_urutan').value = urutan;
            var modal = new bootstrap.Modal(document.getElementById('modalEditModul'));
            modal.show();
        }

        function bukaModalHapus(id, judul) {
            document.getElementById('formHapus').action = '/superadmin/course/modul/' + id + '/hapus';
            document.getElementById('namaModulHapus').textContent = '"' + judul + '"';
            var modal = new bootstrap.Modal(document.getElementById('modalHapusModul'));
            modal.show();
        }

        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.alert-modern').forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-8px)';
                    setTimeout(() => alert.remove(), 400);
                }, 5000);
            });
        });
    </script>
</body>

</html>