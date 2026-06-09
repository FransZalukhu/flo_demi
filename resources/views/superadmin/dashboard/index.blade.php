<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard'])

    <style>
        /* ══════════ PAGE HEADER ══════════ */
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

        /* ══════════ METRIC CARDS ══════════ */
        .metric-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        [data-theme="dark"] .metric-card {
            background: #13111c !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(159,102,175,0.10);
            border-color: rgba(159,102,175,0.2);
        }

        [data-theme="dark"] .metric-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.3) !important;
            border-color: rgba(159,102,175,0.4) !important;
        }

        .metric-card-inner {
            padding: 24px 24px 16px;
        }

        .metric-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .metric-card-icon.icon-admin {
            background: linear-gradient(135deg, rgba(159,102,175,0.15), rgba(192,132,252,0.15));
            color: #9F66AF;
        }

        .metric-card-icon.icon-course {
            background: linear-gradient(135deg, rgba(59,130,246,0.15), rgba(96,165,250,0.15));
            color: #3b82f6;
        }

        .metric-card-icon.icon-mentee {
            background: linear-gradient(135deg, rgba(16,185,129,0.15), rgba(52,211,153,0.15));
            color: #10b981;
        }

        .metric-card-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #6b7280;
            margin-bottom: 6px;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .metric-card-label {
            color: #9ca3af !important;
        }

        .metric-card-value {
            font-size: 32px;
            font-weight: 800;
            color: #1f2937;
            letter-spacing: -1px;
            line-height: 1.1;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .metric-card-value {
            color: #f3f4f6 !important;
        }

        .metric-card-growth {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            margin-top: 8px;
        }

        .metric-card-growth.positive {
            background: rgba(16,185,129,0.1);
            color: #10b981;
        }

        [data-theme="dark"] .metric-card-growth.positive {
            background: rgba(16,185,129,0.15) !important;
            color: #34d399 !important;
        }

        .metric-card-growth.negative {
            background: rgba(239,68,68,0.1);
            color: #ef4444;
        }

        [data-theme="dark"] .metric-card-growth.negative {
            background: rgba(239,68,68,0.15) !important;
            color: #f87171 !important;
        }

        .metric-card-sparkline {
            padding: 0 16px 16px;
            height: 70px;
        }

        .metric-card-sparkline canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .metric-card-footer {
            border-top: 1px solid #e5e7eb;
            padding: 12px 24px;
            text-align: center;
            transition: border-color 0.35s ease;
        }

        [data-theme="dark"] .metric-card-footer {
            border-top-color: rgba(255,255,255,0.08) !important;
        }

        .metric-card-footer a {
            font-size: 12px;
            font-weight: 700;
            color: #9F66AF;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.2s, color 0.35s ease;
        }

        .metric-card-footer a:hover {
            gap: 8px;
            color: #8b56a0;
        }

        [data-theme="dark"] .metric-card-footer a {
            color: #c084fc !important;
        }

        [data-theme="dark"] .metric-card-footer a:hover {
            color: #d09dfa !important;
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
        }

        [data-theme="dark"] .badge-role {
            background: rgba(159,102,175,0.15) !important;
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
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }

        /* ══════════ RESPONSIVE ══════════ */
        @media (max-width: 767.98px) {
            .page-hero { padding: 20px 16px 0; }
            .page-hero-greeting { font-size: 20px; }
            .metric-card-value { font-size: 24px; }
            .content-card-header { padding: 16px; }
            .table-modern thead th,
            .table-modern tbody td { padding: 10px 12px; }
            .search-input-modern input { width: 120px; }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'dashboard', 'activePage' => 'dashboard-home'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">
                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        Hallo, <span>Superadmin</span>! 
                    </div>
                    <p class="page-hero-sub">
                        Dashboard terpusat untuk memantau performa sistem, mengelola data inti, serta menganalisis laporan.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Superadmin Dashboard</span>
                    </div>
                </div>

                {{-- ══════════ METRIC CARDS ══════════ --}}
                <div style="padding:24px 32px 0;">
                    <div class="row g-4">
                        {{-- Total Admin --}}
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="metric-card animate-slide-up delay-1">
                                <div class="metric-card-inner">
                                    <div class="metric-card-icon icon-admin">
                                        <i class="ri-shield-star-line"></i>
                                    </div>
                                    <div class="metric-card-label">Total Admin</div>
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="metric-card-value">{{ $totalAdmin }}</div>
                                        <div class="metric-card-growth {{ $adminGrowth >= 0 ? 'positive' : 'negative' }}">
                                            <i class="ri-arrow-{{ $adminGrowth >= 0 ? 'up' : 'down' }}-line"></i>
                                            {{ abs($adminGrowth) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="metric-card-sparkline">
                                    <canvas id="sparkline-income"></canvas>
                                </div>
                                <div class="metric-card-footer">
                                    <a href="{{ route('superadmin.admin.list') }}">Lihat Detail <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>

                        {{-- Total Course --}}
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="metric-card animate-slide-up delay-2">
                                <div class="metric-card-inner">
                                    <div class="metric-card-icon icon-course">
                                        <i class="ri-book-open-line"></i>
                                    </div>
                                    <div class="metric-card-label">Total Course</div>
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="metric-card-value">{{ $totalCourse }}</div>
                                        <div class="metric-card-growth {{ $courseGrowth >= 0 ? 'positive' : 'negative' }}">
                                            <i class="ri-arrow-{{ $courseGrowth >= 0 ? 'up' : 'down' }}-line"></i>
                                            {{ abs($courseGrowth) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="metric-card-sparkline">
                                    <canvas id="sparkline-cash"></canvas>
                                </div>
                                <div class="metric-card-footer">
                                    <a href="{{ route('superadmin.course.list') }}">Lihat Detail <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>

                        {{-- Total Mentee --}}
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="metric-card animate-slide-up delay-3">
                                <div class="metric-card-inner">
                                    <div class="metric-card-icon icon-mentee">
                                        <i class="ri-team-line"></i>
                                    </div>
                                    <div class="metric-card-label">Total Mentee</div>
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="metric-card-value">{{ $totalMentee }}</div>
                                        <div class="metric-card-growth {{ $menteeGrowth >= 0 ? 'positive' : 'negative' }}">
                                            <i class="ri-arrow-{{ $menteeGrowth >= 0 ? 'up' : 'down' }}-line"></i>
                                            {{ abs($menteeGrowth) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="metric-card-sparkline">
                                    <canvas id="sparkline-profit"></canvas>
                                </div>
                                <div class="metric-card-footer">
                                    <a href="{{ route('superadmin.mentee.list') }}">Lihat Detail <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ══════════ ADMIN TABLE ══════════ --}}
                <div style="padding:24px 32px 32px;">
                    <div class="content-card animate-slide-up delay-4">
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
                                        <th>Status</th>
                                        @if(auth()->user()->role === 'superadmin')
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="adminTable">
                                    @forelse($admins as $admin)
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
                                            <span class="badge-role">
                                                <i class="ri-shield-star-line" style="font-size:10px;"></i>
                                                {{ ucfirst($admin->role) }}
                                            </span>
                                        </td>
                                        <td>
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
                                    @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->role === 'superadmin' ? 5 : 4 }}">
                                            <div class="empty-state">
                                                <i class="ri-inbox-line"></i>
                                                <p>Belum ada data admin</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
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

    {{-- ══════════ STATUS MODAL ══════════ --}}
    <div class="modal fade modal-modern" id="statusModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage" style="color: #6b7280; transition: color 0.35s ease;"></p>
                </div>
                <div class="modal-footer" style="display:flex;gap:10px;justify-content:flex-end;">
                    <button class="btn-brand" style="background:#e5e7eb;color:#374151;transition:all 0.2s;" data-bs-dismiss="modal">Batal</button>
                    <button class="btn-brand btn-brand-primary" id="confirmAction">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    @php
        $adminChartDataJson = json_encode($adminChartData ?? []);
        $courseChartDataJson = json_encode($courseChartData ?? []);
        $menteeChartDataJson = json_encode($menteeChartData ?? []);
        $adminGrowthValue = $adminGrowth ?? 0;
        $courseGrowthValue = $courseGrowth ?? 0;
        $menteeGrowthValue = $menteeGrowth ?? 0;
    @endphp

    <script>
        window.dashboardChartData = {
            admin: {{ $adminChartDataJson }},
            mentor: {{ $courseChartDataJson }},
            mentee: {{ $menteeChartDataJson }}
        };
        window.adminGrowth = {{ $adminGrowthValue }};
        window.mentorGrowth = {{ $courseGrowthValue }};
        window.menteeGrowth = {{ $menteeGrowthValue }};
    </script>

    @vite(['resources/js/superadmin/pages/dashboard.js'])

    {{-- Table search & filter logic --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Status modal logic
        const statusModal = document.getElementById('statusModal');
        if (statusModal) {
            statusModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                if (!button) return;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const action = button.getAttribute('data-action');

                document.getElementById('modalTitle').textContent =
                    action === 'nonaktif' ? 'Nonaktifkan Admin' : 'Aktifkan Admin';
                document.getElementById('modalMessage').textContent =
                    action === 'nonaktif'
                        ? `Apakah Anda yakin ingin menonaktifkan admin "${name}"?`
                        : `Apakah Anda yakin ingin mengaktifkan kembali admin "${name}"?`;

                const confirmBtn = document.getElementById('confirmAction');
                confirmBtn.onclick = function() {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('/superadmin/admin') }}/${id}/status`;
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')}">
                        <input type="hidden" name="status" value="${action}">
                        <input type="hidden" name="_method" value="PATCH">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                };
            });
        }
    });
    </script>
</body>

</html>