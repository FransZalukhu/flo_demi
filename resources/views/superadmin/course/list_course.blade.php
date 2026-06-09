<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - List Course'])

    <style>
        /* ══════════ PAGE HERO ══════════ */
        .page-hero {
            padding: 32px 32px 0;
        }

        .page-hero-greeting {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .page-hero-greeting span {
            background: linear-gradient(135deg, var(--brand-purple), #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-hero-sub {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 20px;
        }

        .breadcrumb-modern {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .breadcrumb-modern a {
            color: var(--brand-purple);
            text-decoration: none;
        }

        .breadcrumb-modern a:hover { text-decoration: underline; }

        .breadcrumb-modern .separator { color: var(--text-muted); }

        .breadcrumb-modern .current { color: var(--text-muted); }

        /* ══════════ CONTENT CARD ══════════ */
        .content-card {
            background: var(--card-bg);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .content-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .content-card-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .content-card-title i { color: var(--brand-purple); }

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
            border: 1px solid var(--border-color);
            background: var(--input-bg);
            transition: all 0.2s;
        }

        .search-input-modern:focus-within {
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 3px rgba(159,102,175,0.10);
            background: var(--input-focus-bg);
        }

        .search-input-modern i {
            color: var(--text-muted);
            font-size: 15px;
        }

        .search-input-modern input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
            width: 180px;
        }

        .search-input-modern input::placeholder { color: var(--text-muted); }

        .filter-select-modern {
            padding: 8px 14px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            background: var(--card-bg);
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s, background 0.35s, color 0.35s;
        }

        .filter-select-modern:focus {
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 3px rgba(159,102,175,0.10);
        }

        [data-theme="dark"] .filter-select-modern {
            background: #1a1926;
            color: #f0eef5;
        }

        [data-theme="dark"] .filter-select-modern option {
            background: #1a1926;
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
            background: var(--brand-purple);
            color: #fff;
            box-shadow: 0 4px 14px rgba(159,102,175,0.25);
        }

        .btn-brand-primary:hover {
            background: var(--brand-purple-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(159,102,175,0.35);
        }

        .btn-brand-muted {
            background: var(--border-color);
            color: var(--text-secondary);
        }

        .btn-brand-muted:hover {
            background: var(--text-muted);
            color: #fff;
        }

        .btn-brand-danger {
            background: var(--danger);
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
            /* CRITICAL: inherit agar td ikut warna tr saat hover */
            background: inherit;
            transition: color 0.35s ease, border-color 0.35s ease, background 0.2s ease;
        }

        /* ══════════════════════════════════
           DARK MODE — EXPLICIT OVERRIDES
        ══════════════════════════════════ */

        /* ── Card ── */
        [data-theme="dark"] .content-card {
            background: #13111c !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .content-card-header {
            border-bottom-color: rgba(255,255,255,0.08) !important;
        }

        /* ── Table Responsive wrapper ── */
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

        /* ── TBODY ROW HOVER — Dark mode (ungu samar, BUKAN putih) ── */
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
        .table-modern .course-title {
            font-weight: 700;
            color: var(--text-primary);
            display: block;
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .course-title {
            color: #f3f4f6 !important;
        }

        .table-modern .category-badge {
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

        [data-theme="dark"] .table-modern .category-badge {
            background: rgba(59,130,246,0.15) !important;
            color: #60a5fa !important;
        }

        .table-modern .mentor-cell {
            color: #6b7280;
            font-weight: 600;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .table-modern .mentor-cell {
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

        .badge-status.publish {
            background: rgba(16,185,129,0.1);
            color: #10b981;
        }

        [data-theme="dark"] .badge-status.publish {
            background: rgba(16,185,129,0.15) !important;
            color: #34d399 !important;
        }

        .badge-status.draft {
            background: rgba(245,158,11,0.1);
            color: #f59e0b;
        }

        [data-theme="dark"] .badge-status.draft {
            background: rgba(245,158,11,0.15) !important;
            color: #fbbf24 !important;
        }

        .badge-status.tersedia {
            background: rgba(16,185,129,0.1);
            color: #10b981;
        }

        [data-theme="dark"] .badge-status.tersedia {
            background: rgba(16,185,129,0.15) !important;
            color: #34d399 !important;
        }

        .badge-status.penuh {
            background: rgba(239,68,68,0.1);
            color: #ef4444;
        }

        [data-theme="dark"] .badge-status.penuh {
            background: rgba(239,68,68,0.15) !important;
            color: #f87171 !important;
        }

        .quota-text {
            font-weight: 700;
            color: #1f2937;
            transition: color 0.35s ease;
        }

        [data-theme="dark"] .quota-text {
            color: #e5e7eb !important;
        }

        .mentee-count {
            font-weight: 700;
            color: #9F66AF;
        }

        [data-theme="dark"] .mentee-count {
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

        .action-btn.modul {
            border-color: rgba(159,102,175,0.3);
            color: #9F66AF;
        }

        .action-btn.modul:hover {
            background: rgba(159,102,175,0.1);
            border-color: #9F66AF;
        }

        [data-theme="dark"] .action-btn.modul {
            border-color: rgba(192,132,252,0.25) !important;
            color: #c084fc !important;
        }

        [data-theme="dark"] .action-btn.modul:hover {
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
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-list'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Manajemen Course</span> 
                    </div>
                    <p class="page-hero-sub">
                        Kelola daftar kursus, pantau kuota, dan atur modul pembelajaran.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Daftar Course</span>
                    </div>
                </div>

                {{-- ══════════ COURSE TABLE ══════════ --}}
                <div style="padding:24px 32px 32px;">
                    <div class="content-card animate-slide-up delay-1">
                        <div class="content-card-header">
                            <div class="content-card-title">
                                <i class="ri-book-open-line"></i>
                                Daftar Course
                            </div>
                            <div class="content-card-toolbar">
                                <div class="search-input-modern">
                                    <i class="ri-search-line"></i>
                                    <input type="text" id="searchCourse" placeholder="Cari course...">
                                </div>
                                <select id="filterCategory" class="filter-select-modern">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ strtolower($category->nama) }}">{{ $category->nama }}</option>
                                    @endforeach
                                </select>
                                <select id="filterStatus" class="filter-select-modern">
                                    <option value="">Semua Status</option>
                                    <option value="publish">Publish</option>
                                    <option value="draft">Draft</option>
                                </select>
                                <a href="{{ route('superadmin.course.add') }}" class="btn-brand btn-brand-primary">
                                    <i class="ri-add-line"></i> Tambah Course
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Judul Course</th>
                                        <th>Kategori</th>
                                        <th>Mentor</th>
                                        <th>Status</th>
                                        <th>Kuota</th>
                                        <th>Total Mentee</th>
                                        <th>Ketersediaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="courseTable">
                                    @forelse ($courses as $course)
                                        @php
                                            $totalMentee = $course->pendaftaran->count();
                                            $kuotaText   = $course->kuota ? $course->kuota : 'Unlimited';
                                            $kuotaVal    = $course->kuota ? $course->kuota : 'unlimited';
                                        @endphp
                                        <tr data-status="{{ strtolower($course->status) }}"
                                            data-category="{{ strtolower($course->kategori->nama ?? '') }}"
                                            data-title="{{ strtolower($course->judul) }}"
                                            data-mentor="{{ strtolower($course->mentor->username ?? '') }}">
                                            <td>
                                                <span class="course-title">{{ $course->judul }}</span>
                                            </td>
                                            <td>
                                                <span class="category-badge">
                                                    <i class="ri-folder-line" style="font-size:10px;"></i>
                                                    {{ $course->kategori->nama ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="mentor-cell">{{ $course->mentor->username ?? '-' }}</span>
                                            </td>
                                            <td>
                                                @if(strtolower($course->status) === 'publish')
                                                <span class="badge-status publish">
                                                    <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                                                    Publish
                                                </span>
                                                @else
                                                <span class="badge-status draft">
                                                    <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                                                    Draft
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="quota-text">{{ $kuotaText }}</span>
                                            </td>
                                            <td>
                                                <span class="mentee-count">{{ $totalMentee }}</span>
                                            </td>
                                            <td class="quota-status" data-quota="{{ $kuotaVal }}" data-mentee="{{ $totalMentee }}">
                                                {{-- Rendered by JS --}}
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="{{ route('superadmin.course.edit', $course->id) }}" class="action-btn edit" title="Edit Course">
                                                        <i class="ri-edit-line"></i> Edit
                                                    </a>

                                                    @if(strtolower($course->status) === 'draft')
                                                    <button class="action-btn delete" title="Hapus Course"
                                                        data-bs-toggle="modal" data-bs-target="#deleteCourseModal"
                                                        data-id="{{ $course->id }}"
                                                        data-judul="{{ $course->judul }}">
                                                        <i class="ri-delete-bin-line"></i> Hapus
                                                    </button>
                                                    @endif

                                                    <a href="{{ route('superadmin.course.modul', ['id' => $course->id]) }}" class="action-btn modul" title="Cek Modul">
                                                        <i class="ri-folder-3-line"></i> Modul
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">
                                                <div class="empty-state">
                                                    <i class="ri-inbox-line"></i>
                                                    <p>Belum ada data course</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if(isset($courses) && method_exists($courses, 'links'))
                        <div class="pagination-modern">
                            {{ $courses->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    </div>
                </div>

            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ DELETE COURSE MODAL ══════════ --}}
    <div class="modal fade modal-modern" id="deleteCourseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ri-delete-bin-line" style="color:#ef4444;margin-right:6px;"></i>
                        Hapus Course
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-desc" id="deleteModalMessage">
                        Apakah Anda yakin ingin menghapus course ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
                <div class="modal-footer" style="display:flex;gap:10px;justify-content:flex-end;">
                    <button type="button" class="btn-brand btn-brand-muted" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn-brand btn-brand-danger" id="confirmDeleteCourse">
                        <i class="ri-delete-bin-line"></i> Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Search & filter ──
        const searchInput = document.getElementById('searchCourse');
        const filterStatus = document.getElementById('filterStatus');
        const filterCategory = document.getElementById('filterCategory');
        const tableRows = document.querySelectorAll('#courseTable tr[data-status]');

        function filterTable() {
            const query = (searchInput?.value || '').toLowerCase();
            const status = filterStatus?.value || '';
            const category = filterCategory?.value || '';

            tableRows.forEach(row => {
                const title = (row.getAttribute('data-title') || '').toLowerCase();
                const mentor = (row.getAttribute('data-mentor') || '').toLowerCase();
                const rowStatus = row.getAttribute('data-status') || '';
                const rowCategory = row.getAttribute('data-category') || '';

                const matchSearch = title.includes(query) || mentor.includes(query);
                const matchStatus = !status || rowStatus === status;
                const matchCategory = !category || rowCategory === category;

                row.style.display = (matchSearch && matchStatus && matchCategory) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (filterStatus) filterStatus.addEventListener('change', filterTable);
        if (filterCategory) filterCategory.addEventListener('change', filterTable);

        // ── Quota Badge Rendering ──
        function renderQuotaStatus() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';

            document.querySelectorAll('.quota-status').forEach(cell => {
                const quota = cell.dataset.quota;
                const mentee = parseInt(cell.dataset.mentee);

                if (quota === 'unlimited' || mentee < parseInt(quota)) {
                    cell.innerHTML = `
                        <span class="badge-status tersedia">
                            <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                            Tersedia
                        </span>`;
                } else {
                    cell.innerHTML = `
                        <span class="badge-status penuh">
                            <i class="ri-checkbox-blank-circle-fill" style="font-size:6px;"></i>
                            Penuh
                        </span>`;
                }
            });
        }
        renderQuotaStatus();

        // ── Delete Modal ──
        let selectedCourseRow = null;
        const deleteModalEl = document.getElementById('deleteCourseModal');

        if (deleteModalEl) {
            deleteModalEl.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                if (!button) return;

                const row = button.closest('tr');
                if (!row) return;

                if (row.dataset.status !== 'draft') {
                    event.preventDefault();
                    alert('Course harus berstatus Draft terlebih dahulu sebelum dihapus.');
                    return;
                }

                selectedCourseRow = row;
                const courseName = button.getAttribute('data-judul') || 'Course ini';
                const msg = document.getElementById('deleteModalMessage');

                if (msg) {
                    msg.innerHTML = `Apakah Anda yakin ingin menghapus course <strong>"${courseName}"</strong>? Tindakan ini tidak dapat dibatalkan.`;
                }
            });

            document.getElementById('confirmDeleteCourse')?.addEventListener('click', function() {
                if (!selectedCourseRow) return;

                const courseId = selectedCourseRow.querySelector('.action-btn.delete')?.getAttribute('data-id');

                // If you have an actual delete endpoint, uncomment below:
                // fetch(`/superadmin/course/${courseId}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': ... } })

                selectedCourseRow.remove();
                selectedCourseRow = null;
                bootstrap.Modal.getInstance(deleteModalEl)?.hide();
            });

            deleteModalEl.addEventListener('hidden.bs.modal', function() {
                selectedCourseRow = null;
            });
        }
    });
    </script>
</body>

</html>