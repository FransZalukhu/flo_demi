<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Manajemen Pendaftaran'])

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
        .table-modern .mentee-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-modern .mentee-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid rgba(159,102,175,0.2);
            transition: border-color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .mentee-avatar {
            border-color: rgba(192,132,252,0.3) !important;
        }

        .table-modern .mentee-name {
            font-weight: 700;
            color: #1f2937;
            text-decoration: none;
            transition: color 0.2s;
        }

        .table-modern .mentee-name:hover { color: #9F66AF; }

        [data-theme="dark"] .table-modern .mentee-name {
            color: #f3f4f6 !important;
        }

        [data-theme="dark"] .table-modern .mentee-name:hover {
            color: #c084fc !important;
        }

        .table-modern .email-cell {
            color: #6b7280;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .email-cell {
            color: #9ca3af !important;
        }

        .table-modern .course-name {
            font-weight: 700;
            color: #1f2937;
            display: block;
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .course-name {
            color: #f3f4f6 !important;
        }

        .table-modern .course-price {
            font-size: 12px;
            font-weight: 700;
            color: #9F66AF;
        }

        [data-theme="dark"] .table-modern .course-price {
            color: #c084fc !important;
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

        .badge-status.menunggu-pembayaran {
            background: rgba(245,158,11,0.1);
            color: #f59e0b;
        }

        [data-theme="dark"] .badge-status.menunggu-pembayaran {
            background: rgba(245,158,11,0.15) !important;
            color: #fbbf24 !important;
        }

        .badge-status.menunggu-verifikasi {
            background: rgba(159,102,175,0.1);
            color: #9F66AF;
        }

        [data-theme="dark"] .badge-status.menunggu-verifikasi {
            background: rgba(159,102,175,0.15) !important;
            color: #c084fc !important;
        }

        .badge-status.aktif {
            background: rgba(16,185,129,0.1);
            color: #10b981;
        }

        [data-theme="dark"] .badge-status.aktif {
            background: rgba(16,185,129,0.15) !important;
            color: #34d399 !important;
        }

        .badge-status.ditolak {
            background: rgba(239,68,68,0.1);
            color: #ef4444;
        }

        [data-theme="dark"] .badge-status.ditolak {
            background: rgba(239,68,68,0.15) !important;
            color: #f87171 !important;
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

        .action-btn.approve {
            border-color: rgba(16,185,129,0.3);
            color: #10b981;
        }

        .action-btn.approve:hover {
            background: rgba(16,185,129,0.1);
            border-color: #10b981;
        }

        [data-theme="dark"] .action-btn.approve {
            border-color: rgba(52,211,153,0.25) !important;
            color: #34d399 !important;
        }

        [data-theme="dark"] .action-btn.approve:hover {
            background: rgba(16,185,129,0.15) !important;
        }

        .action-btn.reject {
            border-color: rgba(239,68,68,0.3);
            color: #ef4444;
        }

        .action-btn.reject:hover {
            background: rgba(239,68,68,0.1);
            border-color: #ef4444;
        }

        [data-theme="dark"] .action-btn.reject {
            border-color: rgba(248,113,113,0.25) !important;
            color: #f87171 !important;
        }

        [data-theme="dark"] .action-btn.reject:hover {
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

        .action-btn.no-action {
            border: none;
            padding: 0;
            font-size: 12px;
            font-weight: 600;
            color: #9ca3af;
            cursor: default;
        }

        .no-proof-text {
            font-size: 12px;
            font-weight: 500;
            color: #9ca3af;
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

        .modal-modern .modal-body textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            color: #1f2937;
            background: #f9fafb;
            resize: vertical;
            min-height: 100px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.35s ease, color 0.35s ease;
        }

        .modal-modern .modal-body textarea:focus {
            border-color: #9F66AF;
            box-shadow: 0 0 0 3px rgba(159,102,175,0.10);
        }

        [data-theme="dark"] .modal-modern .modal-body textarea {
            background: #13111c !important;
            color: #f3f4f6 !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        .modal-modern .modal-body textarea::placeholder {
            color: #9ca3af;
        }

        .modal-modern .modal-body label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #6b7280;
            display: block;
            margin-bottom: 8px;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-body label {
            color: #9ca3af !important;
        }

        .modal-modern .modal-body p.modal-desc {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 16px;
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
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'dashboard', 'activePage' => 'manajemen-pendaftaran'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Manajemen Pendaftaran</span> 
                    </div>
                    <p class="page-hero-sub">
                        Verifikasi pembayaran dan kelola akses kursus mentee.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Manajemen Pendaftaran</span>
                    </div>
                </div>

                {{-- ══════════ ENROLLMENT TABLE ══════════ --}}
                <div style="padding:24px 32px 32px;">
                    <div class="content-card animate-slide-up delay-1">
                        <div class="content-card-header">
                            <div class="content-card-title">
                                <i class="ri-file-list-3-line"></i>
                                Daftar Transaksi & Pendaftaran
                            </div>
                            <div class="content-card-toolbar">
                                <div class="search-input-modern">
                                    <i class="ri-search-line"></i>
                                    <input type="text" id="searchEnrollment" placeholder="Cari mentee atau kursus...">
                                </div>
                                <select id="filterStatus" class="filter-select-modern">
                                    <option value="all" {{ request('status') === null ? 'selected' : '' }}>Semua Status</option>
                                    <option value="menunggu_verifikasi" {{ request('status') === 'menunggu_verifikasi' ? 'selected' : '' }}>Butuh Verifikasi</option>
                                    <option value="menunggu_pembayaran" {{ request('status') === 'menunggu_pembayaran' ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <a href="{{ route('superadmin.enrollment.index', ['status' => 'menunggu_verifikasi']) }}" class="btn-brand btn-brand-primary">
                                    <i class="ri-shield-check-line"></i> Butuh Verifikasi
                                </a>
                                <a href="{{ route('superadmin.enrollment.index') }}" class="btn-brand btn-brand-muted">
                                    <i class="ri-list-check"></i> Semua
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Mentee</th>
                                        <th>Kursus</th>
                                        <th>Status</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="enrollmentTable">
                                    @forelse($enrollments as $reg)
                                    @php
                                        $actor = $reg->pengguna;
                                        $actorName = $actor->username ?? 'User';
                                        if ($actor && isset($actor->photo) && $actor->photo) {
                                            $avatar = asset('storage/' . $actor->photo);
                                        } else {
                                            $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($actorName) . '&background=9F66AF&color=fff&size=128&font-size=0.4';
                                        }

                                        $statusMap = [
                                            'menunggu_pembayaran' => 'menunggu-pembayaran',
                                            'menunggu_verifikasi' => 'menunggu-verifikasi',
                                            'aktif'               => 'aktif',
                                            'ditolak'             => 'ditolak',
                                        ];
                                        $statusLabelMap = [
                                            'menunggu_pembayaran' => 'Belum Bayar',
                                            'menunggu_verifikasi' => 'Verifikasi',
                                            'aktif'               => 'Aktif',
                                            'ditolak'             => 'Ditolak',
                                        ];
                                        $statusClass = $statusMap[$reg->status] ?? '';
                                        $statusLabel = $statusLabelMap[$reg->status] ?? $reg->status;
                                    @endphp
                                    <tr data-id="{{ $reg->id }}" data-status="{{ $reg->status }}"
                                        data-name="{{ $actorName }}"
                                        data-course="{{ $reg->kursus->judul ?? '' }}">
                                        <td>
                                            <div class="mentee-cell">
                                                <img src="{{ $avatar }}" class="mentee-avatar" alt="{{ $actorName }}">
                                                <div>
                                                    <span class="mentee-name">{{ $actorName }}</span>
                                                    <div class="email-cell" style="font-size:12px;">{{ $reg->pengguna->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="course-name">{{ $reg->kursus->judul }}</span>
                                            <span class="course-price">Rp {{ number_format($reg->kursus->harga, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            <span class="badge-status {{ $statusClass }}">
                                                <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($reg->pembayaran && $reg->pembayaran->bukti)
                                                <a href="{{ asset('storage/' . $reg->pembayaran->bukti) }}" target="_blank" class="action-btn view-proof">
                                                    <i class="ri-image-line"></i> Lihat
                                                </a>
                                            @else
                                                <span class="no-proof-text">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($reg->status === 'menunggu_verifikasi')
                                                <div class="action-btns">
                                                    <form action="{{ route('superadmin.enrollment.approve', $reg->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="action-btn approve" title="Setujui Pembayaran">
                                                            <i class="ri-check-line"></i> Setujui
                                                        </button>
                                                    </form>
                                                    <button class="action-btn reject" title="Tolak Pembayaran"
                                                        data-bs-toggle="modal" data-bs-target="#rejectModal"
                                                        data-id="{{ $reg->id }}"
                                                        data-name="{{ $actorName }}"
                                                        data-course="{{ $reg->kursus->judul }}">
                                                        <i class="ri-close-line"></i> Tolak
                                                    </button>
                                                </div>
                                            @else
                                                <span class="action-btn no-action">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="empty-state">
                                                <i class="ri-inbox-line"></i>
                                                <p>Tidak ada data pendaftaran.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="pagination-modern">
                            {{ $enrollments->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ REJECT MODAL ══════════ --}}
    <div class="modal fade modal-modern" id="rejectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ri-close-circle-line" style="color:#ef4444;margin-right:6px;"></i>
                        Tolak Pembayaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="modal-desc" id="rejectModalDesc">
                            Berikan alasan penolakan agar mentee dapat memperbaiki bukti pembayarannya.
                        </p>
                        <label>Alasan Penolakan</label>
                        <textarea name="catatan" placeholder="Contoh: Bukti transfer tidak terbaca atau nominal kurang." required></textarea>
                    </div>
                    <div class="modal-footer" style="display:flex;gap:10px;justify-content:flex-end;">
                        <button type="button" class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-brand btn-brand-danger">
                            <i class="ri-close-circle-line"></i> Konfirmasi Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Search & filter ──
        const searchInput = document.getElementById('searchEnrollment');
        const filterStatus = document.getElementById('filterStatus');
        const tableRows = document.querySelectorAll('#enrollmentTable tr[data-id]');

        function filterTable() {
            const query = (searchInput?.value || '').toLowerCase();
            const status = filterStatus?.value || 'all';

            tableRows.forEach(row => {
                const name = (row.getAttribute('data-name') || '').toLowerCase();
                const course = (row.getAttribute('data-course') || '').toLowerCase();
                const rowStatus = row.getAttribute('data-status') || '';

                const matchSearch = name.includes(query) || course.includes(query);
                const matchStatus = status === 'all' || rowStatus === status;

                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (filterStatus) filterStatus.addEventListener('change', filterTable);

        // ── Reject modal ──
        const rejectModal = document.getElementById('rejectModal');
        if (rejectModal) {
            rejectModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                if (!button) return;

                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const course = button.getAttribute('data-course');

                const desc = document.getElementById('rejectModalDesc');
                if (desc) {
                    desc.textContent = `Tolak pembayaran dari "${name}" untuk kursus "${course}". Berikan alasan agar mentee dapat memperbaiki bukti pembayarannya.`;
                }

                const form = document.getElementById('rejectForm');
                form.action = `/superadmin/enrollment/${id}/reject`;
            });
        }
    });
    </script>
</body>
</html>