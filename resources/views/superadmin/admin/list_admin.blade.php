<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Manajemen Admin - List Admin'])

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

        .btn-brand-success {
            background: #10b981;
            color: #fff;
            box-shadow: 0 4px 14px rgba(16,185,129,0.25);
        }

        .btn-brand-success:hover {
            background: #059669;
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

        /* ── THEAD (Light mode default) ── */
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

        /* ── TBODY ROW (Light mode default) ── */
        .table-modern tbody tr {
            transition: background 0.2s ease;
            background: #ffffff;
        }

        .table-modern tbody tr:hover {
            background: #f3f0f7;
        }

        /* ── TBODY CELL (Light mode default) ── */
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

        /* ══════════════════════════════════
           DARK MODE — EXPLICIT OVERRIDES
        ══════════════════════════════════ */

        [data-theme="dark"] .table-responsive {
            background: #13111c !important;
        }

        /* ── THEAD — Dark mode ── */
        [data-theme="dark"] .table-modern thead th {
            background: #1a1825 !important;
            color: #9ca3af !important;
            border-bottom-color: rgba(255,255,255,0.08) !important;
        }

        /* ── TBODY ROW — Dark mode ── */
        [data-theme="dark"] .table-modern tbody tr {
            background: #13111c !important;
        }

        /* ── TBODY ROW HOVER — Dark mode (ungu samar) ── */
        [data-theme="dark"] .table-modern tbody tr:hover {
            background: rgba(159, 102, 175, 0.08) !important;
        }

        /* ── TBODY CELL — Dark mode ── */
        [data-theme="dark"] .table-modern tbody td {
            color: #e5e7eb !important;
            border-bottom-color: rgba(255,255,255,0.06) !important;
            background: inherit !important;
        }

        /* ══════════ TABLE CELLS ══════════ */
        .table-modern .admin-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-modern .admin-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid rgba(159,102,175,0.2);
            transition: border-color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .admin-avatar {
            border-color: rgba(192,132,252,0.3) !important;
        }

        .table-modern .admin-name {
            font-weight: 700;
            color: #1f2937;
            text-decoration: none;
            transition: color 0.2s;
        }

        .table-modern .admin-name:hover { color: #9F66AF; }

        [data-theme="dark"] .table-modern .admin-name {
            color: #f3f4f6 !important;
        }

        [data-theme="dark"] .table-modern .admin-name:hover {
            color: #c084fc !important;
        }

        .table-modern .email-cell {
            color: #6b7280;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .email-cell {
            color: #9ca3af !important;
        }

        /* ══════════ BADGE STATUS ══════════ */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            transition: background 0.35s ease, color 0.35s ease;
        }

        .badge-status.aktif {
            background: rgba(16,185,129,0.1);
            color: #10b981;
        }

        [data-theme="dark"] .badge-status.aktif {
            background: rgba(16,185,129,0.15) !important;
            color: #34d399 !important;
        }

        .badge-status.nonaktif {
            background: rgba(239,68,68,0.1);
            color: #ef4444;
        }

        [data-theme="dark"] .badge-status.nonaktif {
            background: rgba(239,68,68,0.15) !important;
            color: #f87171 !important;
        }

        .badge-role {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            background: rgba(159,102,175,0.1);
            color: #9F66AF;
            transition: background 0.35s ease, color 0.35s ease;
            margin-bottom: 4px;
            margin-right: 4px;
        }

        [data-theme="dark"] .badge-role {
            background: rgba(159,102,175,0.15) !important;
            color: #c084fc !important;
        }

        .badge-role.role-admin {
            background: rgba(59,130,246,0.1);
            color: #3b82f6;
        }

        [data-theme="dark"] .badge-role.role-admin {
            background: rgba(59,130,246,0.15) !important;
            color: #60a5fa !important;
        }

        .badge-permission {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 4px;
            margin-right: 4px;
            transition: background 0.35s ease, color 0.35s ease;
        }

        .badge-permission.mentor {
            background: rgba(16,185,129,0.1);
            color: #10b981;
        }

        .badge-permission.mentee {
            background: rgba(59,130,246,0.1);
            color: #3b82f6;
        }

        .badge-permission.course {
            background: rgba(245,158,11,0.1);
            color: #f59e0b;
        }

        [data-theme="dark"] .badge-permission.mentor {
            background: rgba(16,185,129,0.15) !important;
            color: #34d399 !important;
        }

        [data-theme="dark"] .badge-permission.mentee {
            background: rgba(59,130,246,0.15) !important;
            color: #60a5fa !important;
        }

        [data-theme="dark"] .badge-permission.course {
            background: rgba(245,158,11,0.15) !important;
            color: #fbbf24 !important;
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

        .action-btn.toggle-active {
            border-color: rgba(239,68,68,0.3);
            color: #ef4444;
        }

        .action-btn.toggle-active:hover {
            background: rgba(239,68,68,0.1);
            border-color: #ef4444;
        }

        [data-theme="dark"] .action-btn.toggle-active {
            border-color: rgba(248,113,113,0.25) !important;
            color: #f87171 !important;
        }

        [data-theme="dark"] .action-btn.toggle-active:hover {
            background: rgba(239,68,68,0.15) !important;
        }

        .action-btn.toggle-inactive {
            border-color: rgba(107,114,128,0.3);
            color: #6b7280;
        }

        .action-btn.toggle-inactive:hover {
            background: rgba(159,102,175,0.1);
            border-color: #6b7280;
        }

        [data-theme="dark"] .action-btn.toggle-inactive {
            border-color: rgba(156,163,175,0.25) !important;
            color: #9ca3af !important;
        }

        [data-theme="dark"] .action-btn.toggle-inactive:hover {
            background: rgba(159,102,175,0.15) !important;
        }

        .action-btn.reset {
            border-color: rgba(245,158,11,0.3);
            color: #f59e0b;
        }

        .action-btn.reset:hover {
            background: rgba(245,158,11,0.1);
            border-color: #f59e0b;
        }

        [data-theme="dark"] .action-btn.reset {
            border-color: rgba(251,191,36,0.25) !important;
            color: #fbbf24 !important;
        }

        [data-theme="dark"] .action-btn.reset:hover {
            background: rgba(245,158,11,0.15) !important;
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
            margin-bottom: 0;
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
        .delay-2 { animation-delay: 0.2s; opacity: 0; }

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
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-admin', 'activePage' => 'manajemen-admin-list'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Manajemen Admin</span> 
                    </div>
                    <p class="page-hero-sub">
                        Kelola akun admin, atur peran, dan pantau status pengguna secara terpusat.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Daftar Admin</span>
                    </div>
                </div>

                {{-- ══════════ ADMIN TABLE ══════════ --}}
                <div style="padding:24px 32px 32px;">
                    @if(session('success'))
                    <div class="alert-modern alert-success animate-slide-up" style="margin-bottom:20px;">
                        <i class="ri-check-double-line"></i>
                        <div>
                            <strong>Berhasil!</strong> {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    
                    <div class="content-card animate-slide-up delay-1">
                        <div class="content-card-header">
                            <div class="content-card-title">
                                <i class="ri-shield-star-line"></i>
                                Daftar Admin
                            </div>
                            <div class="content-card-toolbar">
                                <div class="search-input-modern">
                                    <i class="ri-search-line"></i>
                                    <input type="text" id="searchAdmin" placeholder="Cari admin...">
                                </div>
                                <select id="filterStatus" class="filter-select-modern">
                                    <option value="all">Semua Status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                                @if(auth()->user()->role === 'superadmin')
                                <a href="{{ route('superadmin.admin.add') }}" class="btn-brand btn-brand-primary">
                                    <i class="ri-add-line"></i> Tambah Admin
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Hak Akses</th>
                                        <th>Status</th>
                                        @if(auth()->user()->role === 'superadmin')
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="adminTable">
                                    @if(isset($admins) && $admins->count() > 0)
                                        @foreach($admins as $admin)
                                        <tr data-id="{{ $admin->id }}" data-status="{{ $admin->status ?? 'aktif' }}">
                                            <td>
                                                <div class="admin-cell">
                                                    @if($admin->photo)
                                                    <img src="{{ asset('storage/' . $admin->photo) }}" class="admin-avatar" alt="{{ $admin->username }}">
                                                    @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->username) }}&background=9F66AF&color=fff&size=128&font-size=0.4" class="admin-avatar" alt="{{ $admin->username }}">
                                                    @endif
                                                    <a href="{{ route('superadmin.admin.show', $admin->id) }}" class="admin-name">{{ $admin->username }}</a>
                                                </div>
                                            </td>
                                            <td class="email-cell">{{ $admin->email }}</td>
                                            <td>
                                                @if($admin->role === 'superadmin')
                                                    <span class="badge-role">
                                                        <i class="ri-shield-star-line" style="font-size:10px;"></i>
                                                        Superadmin
                                                    </span>
                                                @else
                                                    <span class="badge-role role-admin">
                                                        <i class="ri-admin-line" style="font-size:10px;"></i>
                                                        Admin
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $permissions = $admin->getPermissionsArray();
                                                @endphp
                                                @if(!empty($permissions))
                                                    @foreach($permissions as $permission)
                                                        @php
                                                            $permConfig = match($permission) {
                                                                'kelola_mentor' => ['icon' => 'ri-user-star-line', 'label' => 'Mentor', 'class' => 'mentor'],
                                                                'kelola_mentee' => ['icon' => 'ri-team-line', 'label' => 'Mentee', 'class' => 'mentee'],
                                                                'kelola_course' => ['icon' => 'ri-book-open-line', 'label' => 'Course', 'class' => 'course'],
                                                                default => ['icon' => 'ri-key-line', 'label' => $permission, 'class' => '']
                                                            };
                                                        @endphp
                                                        <span class="badge-permission {{ $permConfig['class'] }}">
                                                            <i class="{{ $permConfig['icon'] }}" style="font-size:10px;"></i>
                                                            {{ $permConfig['label'] }}
                                                        </span>
                                                    @endforeach
                                                @else
                                                    <span style="font-size:12px;color:#9ca3af;">-</span>
                                                @endif
                                            </td>
                                            <td class="status-cell">
                                                @if(($admin->status ?? 'aktif') === 'aktif')
                                                <span class="badge-status aktif">
                                                    <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                                                    Aktif
                                                </span>
                                                @else
                                                <span class="badge-status nonaktif">
                                                    <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                                                    Nonaktif
                                                </span>
                                                @endif
                                            </td>
                                            @if(auth()->user()->role === 'superadmin')
                                            <td>
                                                <div class="action-btns">
                                                    <a href="{{ route('superadmin.admin.edit', $admin->id) }}" class="action-btn edit" title="Edit Admin">
                                                        <i class="ri-edit-line"></i> Edit
                                                    </a>

                                                    <button class="action-btn {{ ($admin->status ?? 'aktif') === 'aktif' ? 'toggle-active' : 'toggle-inactive' }} toggle-status"
                                                        data-bs-toggle="modal" data-bs-target="#statusModal"
                                                        data-id="{{ $admin->id }}"
                                                        data-name="{{ $admin->username }}"
                                                        data-action="{{ ($admin->status ?? 'aktif') === 'aktif' ? 'nonaktif' : 'aktif' }}"
                                                        title="{{ ($admin->status ?? 'aktif') === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                        <i class="ri-{{ ($admin->status ?? 'aktif') === 'aktif' ? 'user-unfollow' : 'user-follow' }}-line"></i>
                                                        {{ ($admin->status ?? 'aktif') === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>

                                                    <a href="{{ route('superadmin.dashboard.admin.resetPasswordPage', $admin->id) }}" class="action-btn reset" title="Reset Password">
                                                        <i class="ri-key-line"></i> Reset
                                                    </a>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="{{ auth()->user()->role === 'superadmin' ? 6 : 5 }}">
                                                <div class="empty-state">
                                                    <i class="ri-inbox-line"></i>
                                                    <p>Belum ada data admin</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="pagination-modern">
                            {{ $admins->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ STATUS TOGGLE MODAL ══════════ --}}
    <div class="modal fade modal-modern" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">
                        <i class="ri-user-settings-line" style="color:#9F66AF;margin-right:6px;"></i>
                        Ubah Status Admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-desc" id="modalMessage"></p>
                </div>
                <div class="modal-footer" style="display:flex;gap:10px;justify-content:flex-end;">
                    <button class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                    <button class="btn-brand btn-brand-primary" id="confirmAction">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Search & filter ──
        const searchInput = document.getElementById('searchAdmin');
        const filterStatus = document.getElementById('filterStatus');
        const tableRows = document.querySelectorAll('#adminTable tr[data-id]');

        function filterTable() {
            const query = (searchInput?.value || '').toLowerCase();
            const status = filterStatus?.value || 'all';

            tableRows.forEach(row => {
                const name = row.querySelector('.admin-name')?.textContent.toLowerCase() || '';
                const email = row.querySelector('.email-cell')?.textContent.toLowerCase() || '';
                const rowStatus = row.getAttribute('data-status') || 'aktif';

                const matchSearch = name.includes(query) || email.includes(query);
                const matchStatus = status === 'all' || rowStatus === status;

                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (filterStatus) filterStatus.addEventListener('change', filterTable);

        // ── Status modal ──
        const statusModal = document.getElementById('statusModal');
        let currentToggleBtn = null;

        if (statusModal) {
            statusModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                if (!button) return;

                currentToggleBtn = button;
                const name = button.getAttribute('data-name');
                const action = button.getAttribute('data-action');

                const modalTitle = document.getElementById('modalTitle');
                const modalMessage = document.getElementById('modalMessage');
                const confirmBtn = document.getElementById('confirmAction');

                if (action === 'nonaktif') {
                    modalTitle.innerHTML = '<i class="ri-user-unfollow-line" style="color:#ef4444;margin-right:6px;"></i> Nonaktifkan Admin';
                    modalMessage.innerHTML = `Apakah Anda yakin ingin menonaktifkan admin <strong>"${name}"</strong>? Admin tersebut tidak dapat mengakses sistem hingga diaktifkan kembali.`;
                    confirmBtn.className = 'btn-brand btn-brand-danger';
                    confirmBtn.innerHTML = '<i class="ri-user-unfollow-line"></i> Ya, Nonaktifkan';
                } else {
                    modalTitle.innerHTML = '<i class="ri-user-follow-line" style="color:#10b981;margin-right:6px;"></i> Aktifkan Kembali Admin';
                    modalMessage.innerHTML = `Apakah Anda yakin ingin mengaktifkan kembali admin <strong>"${name}"</strong>? Admin tersebut dapat mengakses sistem seperti semula.`;
                    confirmBtn.className = 'btn-brand btn-brand-success';
                    confirmBtn.innerHTML = '<i class="ri-user-follow-line"></i> Ya, Aktifkan';
                }
            });

            document.getElementById('confirmAction').onclick = async function() {
                if (!currentToggleBtn) return;

                const adminId = currentToggleBtn.getAttribute('data-id');
                const actionType = currentToggleBtn.getAttribute('data-action');
                const row = currentToggleBtn.closest('tr');

                try {
                    const newStatus = actionType === 'nonaktif' ? 'nonaktif' : 'aktif';

                    const response = await fetch(`/superadmin/dashboard/admin/${adminId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                        },
                        body: JSON.stringify({ status: newStatus })
                    });

                    const result = await response.json();

                    if (result.success) {
                        row.setAttribute('data-status', newStatus);

                        const statusCell = row.querySelector('.status-cell');
                        const toggleBtn = row.querySelector('.toggle-status');

                        if (newStatus === 'nonaktif') {
                            statusCell.innerHTML = `
                                <span class="badge-status nonaktif">
                                    <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                                    Nonaktif
                                </span>`;
                            toggleBtn.className = 'action-btn toggle-inactive toggle-status';
                            toggleBtn.setAttribute('data-action', 'aktif');
                            toggleBtn.setAttribute('title', 'Aktifkan');
                            toggleBtn.innerHTML = '<i class="ri-user-follow-line"></i> Aktifkan';
                        } else {
                            statusCell.innerHTML = `
                                <span class="badge-status aktif">
                                    <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                                    Aktif
                                </span>`;
                            toggleBtn.className = 'action-btn toggle-active toggle-status';
                            toggleBtn.setAttribute('data-action', 'nonaktif');
                            toggleBtn.setAttribute('title', 'Nonaktifkan');
                            toggleBtn.innerHTML = '<i class="ri-user-unfollow-line"></i> Nonaktifkan';
                        }

                        filterTable();
                        bootstrap.Modal.getInstance(document.getElementById('statusModal')).hide();
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses permintaan');
                }
            };
        }
    });
    </script>
</body>

</html>