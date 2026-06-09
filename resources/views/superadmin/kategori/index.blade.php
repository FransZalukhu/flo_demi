<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Manajemen Kategori — Flodemi'])

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

        .breadcrumb-modern a:hover {
            text-decoration: underline;
        }

        .breadcrumb-modern .separator {
            color: #9ca3af;
        }

        .breadcrumb-modern .current {
            color: #6b7280;
        }

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
            border-color: rgba(255, 255, 255, 0.08) !important;
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
            border-bottom-color: rgba(255, 255, 255, 0.08) !important;
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

        .content-card-title i {
            color: #9F66AF;
            font-size: 20px;
        }

        .content-card-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* ══════════ TOOLBAR SEARCH ══════════ */
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
            box-shadow: 0 0 0 3px rgba(159, 102, 175, 0.10);
            background: #ffffff;
        }

        [data-theme="dark"] .search-input-modern {
            background: #1a1825 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
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

        .search-input-modern input::placeholder {
            color: #9ca3af;
        }

        /* ══════════ BUTTONS ══════════ */
        .btn-brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 18px;
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
            box-shadow: 0 4px 14px rgba(159, 102, 175, 0.25);
        }

        .btn-brand-primary:hover {
            background: #8b56a0;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(159, 102, 175, 0.35);
        }

        .btn-brand-muted {
            background: #e5e7eb;
            color: #374151;
        }

        [data-theme="dark"] .btn-brand-muted {
            background: rgba(255, 255, 255, 0.08) !important;
            color: #9ca3af !important;
        }

        .btn-brand-muted:hover {
            background: #9ca3af;
            color: #fff;
        }

        .btn-brand-danger {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.25);
        }

        .btn-brand-danger:hover {
            background: #dc2626;
            color: #fff;
        }

        /* ══════════ TABLE ══════════ */
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

        [data-theme="dark"] .table-modern thead th {
            background: #1a1825 !important;
            color: #9ca3af !important;
            border-bottom-color: rgba(255, 255, 255, 0.08) !important;
        }

        .table-modern tbody tr {
            transition: background 0.2s ease;
            background: #ffffff;
        }

        .table-modern tbody tr:hover {
            background: #f3f0f7;
        }

        [data-theme="dark"] .table-modern tbody tr {
            background: #13111c !important;
        }

        [data-theme="dark"] .table-modern tbody tr:hover {
            background: rgba(159, 102, 175, 0.08) !important;
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

        [data-theme="dark"] .table-modern tbody td {
            color: #e5e7eb !important;
            border-bottom-color: rgba(255, 255, 255, 0.06) !important;
            background: inherit !important;
        }

        .badge-role {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            background: rgba(159, 102, 175, 0.1);
            color: #9F66AF;
            transition: background 0.35s ease, color 0.35s ease;
        }

        [data-theme="dark"] .badge-role {
            background: rgba(159, 102, 175, 0.15) !important;
            color: #c084fc !important;
        }

        .table-modern .category-title {
            font-weight: 700;
            color: #1f2937;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .category-title {
            color: #f3f4f6 !important;
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
            border-color: rgba(16, 185, 129, 0.3);
            color: #10b981;
        }

        .action-btn.edit:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
        }

        [data-theme="dark"] .action-btn.edit {
            border-color: rgba(52, 211, 153, 0.25) !important;
            color: #34d399 !important;
        }

        [data-theme="dark"] .action-btn.edit:hover {
            background: rgba(16, 185, 129, 0.15) !important;
        }

        .action-btn.delete {
            border-color: rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }

        .action-btn.delete:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
        }

        [data-theme="dark"] .action-btn.delete {
            border-color: rgba(248, 113, 113, 0.25) !important;
            color: #f87171 !important;
        }

        [data-theme="dark"] .action-btn.delete:hover {
            background: rgba(239, 68, 68, 0.15) !important;
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
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.25);
            color: #10b981;
        }

        [data-theme="dark"] .alert-modern.alert-success {
            background: rgba(16, 185, 129, 0.1) !important;
            border-color: rgba(52, 211, 153, 0.2) !important;
            color: #34d399 !important;
        }

        .alert-modern.alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.25);
            color: #ef4444;
        }

        [data-theme="dark"] .alert-modern.alert-danger {
            background: rgba(239, 68, 68, 0.1) !important;
            border-color: rgba(248, 113, 113, 0.2) !important;
            color: #f87171 !important;
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
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
            background: #ffffff;
            transition: background 0.35s ease, border-color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-content {
            background: #1a1825 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.5);
        }

        .modal-modern .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: #ffffff;
            transition: background 0.35s ease, border-color 0.35s ease;
        }

        [data-theme="dark"] .modal-modern .modal-header {
            background: #1a1825 !important;
            border-bottom-color: rgba(255, 255, 255, 0.08) !important;
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
            font-size: 14px;
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
            border-top-color: rgba(255, 255, 255, 0.08) !important;
        }

        .modal-modern .btn-close {
            filter: none;
        }

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

        .modal-modern .form-control {
            width: 100%;
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

        .modal-modern .form-control:focus {
            border-color: #9F66AF;
            box-shadow: 0 0 0 3px rgba(159, 102, 175, 0.10);
            background: #ffffff;
        }

        [data-theme="dark"] .modal-modern .form-control {
            background: #13111c !important;
            color: #f3f4f6 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        [data-theme="dark"] .modal-modern .form-control:focus {
            background: #13111c !important;
            border-color: #9F66AF !important;
            color: #f3f4f6 !important;
        }

        /* ══════════ ANIMATIONS ══════════ */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-out forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
            opacity: 0;
        }

        /* ══════════ RESPONSIVE & MOBILE-FRIENDLY OVERRIDES ══════════ */
        @media (max-width: 767.98px) {
            .page-hero {
                padding: 24px 20px 0;
            }

            .page-hero-greeting {
                font-size: 22px;
            }

            .content-card-header {
                padding: 18px 20px;
                flex-direction: column;
                align-items: stretch !important;
                gap: 14px;
            }

            .content-card-toolbar {
                flex-direction: column;
                align-items: stretch !important;
                width: 100%;
                gap: 10px;
            }

            .search-input-modern {
                width: 100%;
            }

            .search-input-modern input {
                width: 100% !important;
            }

            .btn-brand {
                width: 100%;
                justify-content: center;
                padding: 12px 18px;
            }

            /* Card-based rendering for modern tables on mobile screens */
            .table-modern, 
            .table-modern thead, 
            .table-modern tbody, 
            .table-modern th, 
            .table-modern td, 
            .table-modern tr {
                display: block;
            }

            .table-modern thead {
                display: none;
            }

            .table-modern tbody tr {
                margin: 16px;
                border: 1px solid #e5e7eb;
                border-radius: 16px;
                padding: 12px 16px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
            }

            [data-theme="dark"] .table-modern tbody tr {
                border-color: rgba(255, 255, 255, 0.06) !important;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
            }

            .table-modern tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border: none !important;
                font-size: 13px;
                background: transparent !important;
            }

            .table-modern tbody td::before {
                content: attr(data-label);
                font-weight: 700;
                color: #6b7280;
                text-transform: uppercase;
                font-size: 10px;
                letter-spacing: 0.5px;
            }

            [data-theme="dark"] .table-modern tbody td::before {
                color: #9ca3af !important;
            }

            /* Action Buttons full width on mobile card */
            .table-modern tbody td:last-child {
                border-top: 1px solid #f3f4f6 !important;
                padding-top: 12px;
                margin-top: 8px;
            }

            [data-theme="dark"] .table-modern tbody td:last-child {
                border-top-color: rgba(255, 255, 255, 0.05) !important;
            }

            .action-btns {
                width: 100%;
                justify-content: flex-end;
            }

            /* Responsive modern modals as Bottom Sheets on mobile devices */
            .modal-modern .modal-dialog {
                margin: 0;
                width: 100%;
                max-width: 100%;
                height: 100%;
                display: flex;
                align-items: flex-end;
            }

            .modal-modern .modal-content {
                border-radius: 24px 24px 0 0;
                border-left: none;
                border-right: none;
                border-bottom: none;
                margin-top: auto;
                width: 100%;
                max-height: 85%;
                overflow-y: auto;
                transform: translateY(0);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .modal-modern.fade .modal-content {
                transform: translateY(100px);
            }

            .modal-modern.show .modal-content {
                transform: translateY(0);
            }

            .modal-modern .modal-header {
                padding: 16px 20px;
            }

            .modal-modern .modal-body {
                padding: 20px;
            }

            .modal-modern .modal-footer {
                padding: 16px 20px;
                flex-direction: column;
                gap: 8px;
            }

            .modal-modern .modal-footer .btn-brand {
                width: 100%;
            }

            /* Stacking: Primary Action on Top, Cancel button on Bottom */
            .modal-modern .modal-footer .btn-brand:first-child {
                order: 2;
            }

            .modal-modern .modal-footer .btn-brand:last-child {
                order: 1;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-kategori'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Manajemen Kategori</span>
                    </div>
                    <p class="page-hero-sub">
                        Tambah, edit, dan hapus kategori pengelompokan course.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Kategori</span>
                    </div>
                </div>

                {{-- ══════════ CONTENT ══════════ --}}
                <div style="padding:24px 32px 32px;">

                    {{-- Alerts --}}
                    @if (session('success'))
                        <div class="alert-modern alert-success animate-slide-up">
                            <i class="ri-check-double-line"></i>
                            <div>
                                <strong>Berhasil!</strong> {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert-modern alert-danger animate-slide-up">
                            <i class="ri-error-warning-line"></i>
                            <div>
                                <strong>Gagal!</strong> {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <div class="content-card animate-slide-up delay-1">
                        <div class="content-card-header">
                            <div class="content-card-title">
                                <i class="ri-price-tag-3-line"></i>
                                Daftar Kategori
                            </div>
                            <div class="content-card-toolbar">
                                <div class="search-input-modern">
                                    <i class="ri-search-line"></i>
                                    <input type="text" id="searchKategori" placeholder="Cari kategori...">
                                </div>
                                <button class="btn-brand btn-brand-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahKategori">
                                    <i class="ri-add-line"></i> Tambah Kategori
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive" style="overflow-x: visible;">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th style="width:80px;">No</th>
                                        <th>Nama Kategori</th>
                                        <th style="width:200px;">Jumlah Course</th>
                                        <th style="width:180px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="kategoriTable">
                                    @forelse ($categories as $category)
                                        <tr data-id="{{ $category->id }}">
                                            <td style="font-weight:700;color:#6b7280;" class="index-cell" data-label="No">{{ $loop->iteration }}</td>
                                            <td data-label="Nama Kategori">
                                                <span class="category-title">{{ $category->nama }}</span>
                                            </td>
                                            <td data-label="Jumlah Course">
                                                <span class="badge-role">
                                                    <i class="ri-book-open-line" style="font-size:10px;"></i>
                                                    {{ $category->kursus_count }} Course
                                                </span>
                                            </td>
                                            <td data-label="Aksi">
                                                <div class="action-btns">
                                                    <button class="action-btn edit"
                                                        onclick="bukaModalEdit({{ $category->id }}, '{{ addslashes($category->nama) }}')">
                                                        <i class="ri-edit-line"></i> Edit
                                                    </button>
                                                    <button class="action-btn delete"
                                                        onclick="bukaModalHapus({{ $category->id }}, '{{ addslashes($category->nama) }}')">
                                                        <i class="ri-delete-bin-line"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="empty-row-placeholder">
                                            <td colspan="4">
                                                <div class="empty-state">
                                                    <i class="ri-inbox-line"></i>
                                                    <p>Belum ada data kategori</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ MODALS ══════════ --}}

    {{-- Modal Tambah --}}
    <div class="modal fade modal-modern" id="modalTambahKategori" tabindex="-1" aria-labelledby="labelTambah"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelTambah">
                        <i class="ri-price-tag-3-line" style="color:#9F66AF;margin-right:6px;"></i>
                        Tambah Kategori
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('superadmin.course.kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama" name="nama" required
                                placeholder="Contoh: Web Development" maxlength="255">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-brand btn-brand-primary">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade modal-modern" id="modalEditKategori" tabindex="-1" aria-labelledby="labelEdit"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelEdit">
                        <i class="ri-edit-line" style="color:#9F66AF;margin-right:6px;"></i>
                        Edit Kategori
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEditKategori" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" required
                                placeholder="Contoh: Web Development" maxlength="255">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-brand btn-brand-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade modal-modern" id="modalHapusKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ri-delete-bin-line" style="color:#ef4444;margin-right:6px;"></i>
                        Hapus Kategori
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formHapusKategori" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p class="modal-desc">
                            Apakah Anda yakin ingin menghapus kategori <strong id="hapus_nama"></strong>?
                        </p>
                        <p class="text-danger small mb-0">
                            <i class="ri-error-warning-line"></i> Tindakan ini tidak dapat dibatalkan. Kategori hanya
                            bisa dihapus jika tidak digunakan oleh course apa pun.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-brand btn-brand-danger">Hapus Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
        const routeUpdatePattern = "{{ route('superadmin.course.kategori.update', ':id') }}";
        const routeDeletePattern = "{{ route('superadmin.course.kategori.destroy', ':id') }}";

        // ── Client-side Search Filter ──
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchKategori');
            const tableBody = document.getElementById('kategoriTable');
            const tableRows = tableBody.querySelectorAll('tr:not(.empty-row-placeholder)');
            
            let emptySearchRow = document.createElement('tr');
            emptySearchRow.className = 'empty-search-placeholder';
            emptySearchRow.style.display = 'none';
            emptySearchRow.innerHTML = `
                <td colspan="4">
                    <div class="empty-state">
                        <i class="ri-search-2-line"></i>
                        <p>Kategori tidak ditemukan</p>
                    </div>
                </td>
            `;
            tableBody.appendChild(emptySearchRow);

            function filterTable() {
                const query = (searchInput?.value || '').toLowerCase().trim();
                let matchCount = 0;

                tableRows.forEach(row => {
                    const name = row.querySelector('.category-title')?.textContent.toLowerCase() || '';
                    const matchSearch = name.includes(query);
                    row.style.display = matchSearch ? '' : 'none';
                    if (matchSearch) matchCount++;
                });

                const originalEmptyPlaceholder = tableBody.querySelector('.empty-row-placeholder');
                
                if (originalEmptyPlaceholder) {
                    originalEmptyPlaceholder.style.display = '';
                    emptySearchRow.style.display = 'none';
                } else {
                    emptySearchRow.style.display = (matchCount === 0 && query !== '') ? '' : 'none';
                }
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterTable);
            }
        });

        // ── Modals Logic ──
        function bukaModalEdit(id, nama) {
            const form = document.getElementById('formEditKategori');
            form.action = routeUpdatePattern.replace(':id', id);
            document.getElementById('edit_nama').value = nama;

            const modal = new bootstrap.Modal(document.getElementById('modalEditKategori'));
            modal.show();
        }

        function bukaModalHapus(id, nama) {
            const form = document.getElementById('formHapusKategori');
            form.action = routeDeletePattern.replace(':id', id);
            document.getElementById('hapus_nama').textContent = nama;

            const modal = new bootstrap.Modal(document.getElementById('modalHapusKategori'));
            modal.show();
        }
    </script>
</body>

</html>
