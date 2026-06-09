<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Tambah Course'])

    <!-- External Libraries -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Menggunakan Remix Icon untuk ikon referensi -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* ─────────────────────────────────────────────────────
           1. CSS VARIABLES & GLOBAL RESET
           ───────────────────────────────────────────────────── */
        :root {
            /* Brand Colors */
            --brand-purple: #9F66AF;
            --brand-purple-dark: #8b55a0;
            --brand-purple-light: rgba(159, 102, 175, 0.15);
            
            /* Text Colors */
            --text-primary: #2d3436;
            --text-secondary: #636e72;
            --text-muted: #b2bec3;
            
            /* Backgrounds & Borders */
            --bg-body: #f5f6fa;
            --card-bg: #ffffff;
            --input-bg: #f8f9fa;
            --input-focus-bg: #ffffff;
            --border-color: #e0e0e0;
            
            /* Status Colors */
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
           2. MODERN LAYOUT (REFERENCE STYLE)
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
        .content-card-body { padding: 28px; }

        /* ─────────────────────────────────────────────────────
           3. FORM ELEMENTS
           ───────────────────────────────────────────────────── */
        .form-modern .form-label {
            font-size: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.8px; color: var(--text-secondary); margin-bottom: 8px;
        }
        .form-modern .form-control, .form-modern .form-select {
            padding: 12px 16px; border-radius: 12px;
            border: 1px solid var(--border-color);
            background: var(--input-bg); color: var(--text-primary);
            font-size: 14px; font-weight: 500;
            transition: all 0.2s;
        }
        .form-modern .form-control:focus, .form-modern .form-select:focus {
            background: var(--input-focus-bg);
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 4px var(--brand-purple-light);
        }
        .form-modern .form-control::placeholder { color: var(--text-muted); opacity: 0.7; }

        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        @media (max-width: 768px) { .form-row-2 { grid-template-columns: 1fr; } }

        .form-divider {
            display: flex; align-items: center; gap: 12px;
            margin: 32px 0 24px; color: var(--text-muted);
            font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        }
        .form-divider::before, .form-divider::after { content: ''; flex: 1; height: 1px; background: var(--border-color); }
        .form-divider i { color: var(--brand-purple); font-size: 14px; }

        /* Radio Card (Status) */
        .status-options { display: flex; gap: 12px; }
        .status-option-card { flex: 1; position: relative; }
        .status-option-card input { position: absolute; opacity: 0; cursor: pointer; height: 0; width: 0; }
        .status-card-content {
            display: flex; align-items: center; padding: 14px;
            background: var(--input-bg); border: 1.5px solid var(--border-color);
            border-radius: 12px; cursor: pointer; transition: all 0.2s;
        }
        .status-option-card input:checked ~ .status-card-content {
            background: var(--brand-purple-light); border-color: var(--brand-purple);
        }
        .status-card-content i { margin-right: 10px; color: var(--text-muted); transition: 0.2s; }
        .status-option-card input:checked ~ .status-card-content i { color: var(--brand-purple); }
        .status-text { font-size: 13px; font-weight: 600; color: var(--text-primary); }

        /* Buttons */
        .btn-brand {
            display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px;
            border-radius: 12px; font-size: 13px; font-weight: 700;
            border: none; cursor: pointer; transition: all 0.2s; text-decoration: none;
        }
        .btn-brand-primary {
            background: var(--brand-purple); color: #fff; box-shadow: 0 4px 12px rgba(159,102,175,0.3);
        }
        .btn-brand-primary:hover { background: var(--brand-purple-dark); transform: translateY(-1px); color: #fff; }
        .btn-brand-muted {
            background: var(--border-color); color: var(--text-secondary);
        }
        .btn-brand-muted:hover { background: var(--text-muted); color: #fff; }

        /* Modern Alert */
        .alert-modern {
            padding: 14px 20px; border-radius: 12px;
            font-size: 13px; font-weight: 500; display: flex; align-items: flex-start; gap: 12px;
            margin-bottom: 20px; animation: slideUp 0.3s ease-out;
        }
        .alert-modern.alert-error { background: var(--danger-light); border: 1px solid rgba(214,48,49,0.3); color: var(--danger); }
        .alert-modern.alert-success { background: var(--success-light); border: 1px solid rgba(0,184,148,0.3); color: var(--success); }

        /* ─────────────────────────────────────────────────────
           4. OVERRIDES: QUILL EDITOR (FIXED FOR DARK MODE)
           ───────────────────────────────────────────────────── */
        .quill-editor-wrapper {
            border-radius: 12px; 
            overflow: hidden; 
            background: var(--card-bg);
            border: 1px solid var(--border-color); 
            transition: 0.2s;
        }
        .quill-editor-wrapper:focus-within { 
            border-color: var(--brand-purple); 
            box-shadow: 0 0 0 4px var(--brand-purple-light); 
        }
        
        /* Toolbar */
        .ql-toolbar.ql-snow { 
            border: none !important; 
            border-bottom: 1px solid var(--border-color) !important; 
            background: var(--input-bg); 
        }
        
        /* Container & Editor Area */
        .ql-container.ql-snow { 
            border: none !important; 
            font-size: 14px; 
            min-height: 200px; 
            background: var(--card-bg);
        }

        /* Text Color di dalam editor */
        .ql-editor {
            color: var(--text-primary);
        }

        /* Placeholder Text */
        .ql-editor.ql-blank::before { 
            color: var(--text-muted); 
            font-style: italic; 
        }

        /* ── Dark Mode Specifics for Quill Icons ── */
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-stroke {
            stroke: var(--text-secondary);
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-fill {
            fill: var(--text-secondary);
        }
        [data-theme="dark"] .ql-toolbar.ql-snow button:hover .ql-stroke { stroke: var(--brand-purple); }
        [data-theme="dark"] .ql-toolbar.ql-snow button:hover .ql-fill { fill: var(--brand-purple); }

        /* Picker Dropdown (Header, List) */
        .ql-toolbar.ql-snow .ql-picker-label {
            color: var(--text-secondary);
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-options {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-item {
            color: var(--text-primary);
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-item:hover {
            color: var(--brand-purple);
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-item.selected {
            color: var(--brand-purple);
        }
        [data-theme="dark"] .ql-tooltip {
            background: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        /* ─────────────────────────────────────────────────────
           5. OVERRIDES: MODUL SECTION
           ───────────────────────────────────────────────────── */
        .modul-wrapper { display: flex; flex-direction: column; gap: 16px; }
        
        .modul-row {
            background: var(--input-bg); border: 1px solid var(--border-color);
            border-radius: 12px; padding: 16px; position: relative;
            transition: all 0.2s;
        }
        .modul-row:hover { border-color: var(--brand-purple); }
        
        .modul-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;
        }
        .modul-badge {
            background: var(--brand-purple); color: #fff;
            font-size: 10px; font-weight: 800; text-transform: uppercase;
            padding: 4px 8px; border-radius: 6px; letter-spacing: 0.5px;
        }
        .btn-remove-modul {
            background: none; border: none; color: var(--text-muted);
            cursor: pointer; font-size: 16px; transition: 0.2s;
        }
        .btn-remove-modul:hover { color: var(--danger); }

        .modul-select-wrapper { position: relative; }
        .modul-search-input {
            width: 100%; padding: 10px 14px;
            border-radius: 10px; border: 1px solid var(--border-color);
            background: var(--card-bg); color: var(--text-primary); outline: none;
            font-size: 13px; transition: 0.2s;
        }
        .modul-search-input:focus { border-color: var(--brand-purple); }

        .modul-dropdown {
            position: absolute; top: calc(100% + 8px); left: 0; right: 0;
            background: var(--card-bg); border: 1px solid var(--border-color);
            border-radius: 10px; box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            z-index: 1000; max-height: 250px; overflow-y: auto;
            display: none;
        }
        .modul-dropdown.open { display: block; animation: slideUp 0.2s ease; }
        
        .modul-dropdown-item {
            padding: 12px 14px; cursor: pointer; border-bottom: 1px solid var(--border-color);
            display: flex; flex-direction: column;
        }
        .modul-dropdown-item:hover { background: var(--brand-purple-light); }
        .modul-dropdown-item.selected { background: var(--brand-purple-light); border-left: 3px solid var(--brand-purple); }

        .item-title { font-weight: 600; color: var(--text-primary); font-size: 13px; }
        .item-meta { font-size: 11px; color: var(--text-muted); margin-top: 2px; }

        .modul-chip {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--brand-purple-light); color: var(--brand-purple);
            font-size: 11px; font-weight: 700; padding: 4px 10px;
            border-radius: 20px; margin-top: 8px;
        }

        .btn-add-modul-row {
            width: 100%; padding: 12px; border: 2px dashed var(--border-color);
            background: transparent; color: var(--text-secondary);
            border-radius: 12px; font-weight: 600; font-size: 13px;
            cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-add-modul-row:hover { border-color: var(--brand-purple); color: var(--brand-purple); background: var(--brand-purple-light); }

        /* ─────────────────────────────────────────────────────
           6. EXPLICIT DARK MODE OVERRIDES (MATCH REFERENCE)
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
            box-shadow: 0 0 0 4px var(--brand-purple-light) !important;
        }

        [data-theme="dark"] .form-modern .form-control::placeholder {
            color: #6b7280 !important;
        }

        [data-theme="dark"] .form-modern .form-select option {
            background: #1a1825 !important;
            color: #e5e7eb !important;
        }

        /* ── Form Labels ── */
        [data-theme="dark"] .form-modern .form-label {
            color: #9ca3af !important;
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

        /* ── Form Divider ── */
        [data-theme="dark"] .form-divider {
            color: #6b7280 !important;
        }

        [data-theme="dark"] .form-divider::before,
        [data-theme="dark"] .form-divider::after {
            background: rgba(255,255,255,0.08) !important;
        }

        /* ── Status Radio Cards ── */
        [data-theme="dark"] .status-card-content {
            background: #1a1825 !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .status-option-card input:checked ~ .status-card-content {
            background: rgba(159, 102, 175, 0.15) !important;
            border-color: var(--brand-purple) !important;
        }

        [data-theme="dark"] .status-text {
            color: #e5e7eb !important;
        }

        /* ── Quill Editor ── */
        [data-theme="dark"] .quill-editor-wrapper {
            background: #13111c !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .quill-editor-wrapper:focus-within {
            border-color: var(--brand-purple) !important;
            box-shadow: 0 0 0 4px var(--brand-purple-light) !important;
        }

        [data-theme="dark"] .ql-toolbar.ql-snow {
            background: #1a1825 !important;
            border-bottom-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .ql-container.ql-snow {
            background: #13111c !important;
        }

        [data-theme="dark"] .ql-editor {
            color: #e5e7eb !important;
        }

        [data-theme="dark"] .ql-editor.ql-blank::before {
            color: #6b7280 !important;
        }

        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-options {
            background: #1a1825 !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-item {
            color: #e5e7eb !important;
        }

        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-item:hover {
            color: #c084fc !important;
        }

        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-item.selected {
            color: #c084fc !important;
        }

        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-label {
            color: #9ca3af !important;
        }

        [data-theme="dark"] .ql-tooltip {
            background: #1a1825 !important;
            border-color: rgba(255,255,255,0.08) !important;
            color: #e5e7eb !important;
        }

        /* ── Modul Section ── */
        [data-theme="dark"] .modul-row {
            background: #1a1825 !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        [data-theme="dark"] .modul-row:hover {
            border-color: var(--brand-purple) !important;
            background: rgba(159, 102, 175, 0.05) !important;
        }

        [data-theme="dark"] .modul-search-input {
            background: #13111c !important;
            border-color: rgba(255,255,255,0.08) !important;
            color: #e5e7eb !important;
        }

        [data-theme="dark"] .modul-search-input:focus {
            border-color: var(--brand-purple) !important;
        }

        [data-theme="dark"] .modul-dropdown {
            background: #1a1825 !important;
            border-color: rgba(255,255,255,0.08) !important;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4) !important;
        }

        [data-theme="dark"] .modul-dropdown-item {
            border-bottom-color: rgba(255,255,255,0.06) !important;
        }

        [data-theme="dark"] .modul-dropdown-item:hover {
            background: rgba(159, 102, 175, 0.08) !important;
        }

        [data-theme="dark"] .modul-dropdown-item.selected {
            background: rgba(159, 102, 175, 0.15) !important;
            border-left-color: var(--brand-purple) !important;
        }

        [data-theme="dark"] .item-title {
            color: #e5e7eb !important;
        }

        [data-theme="dark"] .item-meta {
            color: #6b7280 !important;
        }

        [data-theme="dark"] .modul-chip {
            background: rgba(159, 102, 175, 0.15) !important;
            color: #c084fc !important;
        }

        /* ── Add Modul Button ── */
        [data-theme="dark"] .btn-add-modul-row {
            border-color: rgba(255,255,255,0.08) !important;
            color: #9ca3af !important;
        }

        [data-theme="dark"] .btn-add-modul-row:hover {
            border-color: var(--brand-purple) !important;
            color: #c084fc !important;
            background: rgba(159, 102, 175, 0.08) !important;
        }

        /* ── Buttons ── */
        [data-theme="dark"] .btn-brand-muted {
            background: rgba(255,255,255,0.06) !important;
            border: 1px solid rgba(255,255,255,0.08) !important;
            color: #9ca3af !important;
        }

        [data-theme="dark"] .btn-brand-muted:hover {
            background: rgba(255,255,255,0.1) !important;
            color: #e5e7eb !important;
        }

        /* ── Alerts ── */
        [data-theme="dark"] .alert-modern.alert-error {
            background: rgba(214, 48, 49, 0.15) !important;
            border-color: rgba(214, 48, 49, 0.3) !important;
            color: #f87171 !important;
        }

        [data-theme="dark"] .alert-modern.alert-success {
            background: rgba(0, 184, 148, 0.15) !important;
            border-color: rgba(0, 184, 148, 0.3) !important;
            color: #34d399 !important;
        }

        /* ── Small text muted ── */
        [data-theme="dark"] .text-muted {
            color: #6b7280 !important;
        }

        /* ── Thumbnail preview text ── */
        [data-theme="dark"] #thumbnailPreview {
            color: #6b7280 !important;
        }

        /* ── Remove modul button ── */
        [data-theme="dark"] .btn-remove-modul {
            color: #6b7280 !important;
        }

        [data-theme="dark"] .btn-remove-modul:hover {
            color: #f87171 !important;
        }

        /* ── Card body border top ── */
        [data-theme="dark"] .content-card-body {
            border-top-color: rgba(255,255,255,0.08) !important;
        }

        /* ── Action area border ── */
        [data-theme="dark"] .form-action-border {
            border-top-color: rgba(255,255,255,0.08) !important;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        {{-- Includes Sidebar --}}
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-tambah'])

        <div style="flex:1;display:flex;flex-direction:column;min-height:100vh;">
            {{-- Includes Header --}}
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">
                
                {{-- 1. ALERTS CONTAINER (For dynamic JS errors) --}}
                <div id="alertsContainer" style="padding: 32px 32px 0;"></div>

                {{-- 2. PAGE HERO --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Tambah Course Baru</span> 
                    </div>
                    <p class="page-hero-sub">
                        Lengkapi formulir di bawah ini untuk memublikasikan course baru ke platform.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('superadmin.course.list') }}">Manajemen Course</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Tambah Course</span>
                    </div>
                </div>

                {{-- 3. FORM CARD --}}
                <div style="padding: 24px 32px 32px;">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-12">
                            
                            <div class="content-card animate-slide-up delay-1">
                                <div class="content-card-header">
                                    <div class="content-card-title">
                                        <i class="ri-book-mark-line"></i>
                                        Detail Course
                                    </div>
                                </div>

                                <div class="content-card-body">
                                    <form id="courseForm" action="{{ route('superadmin.course.store') }}" method="POST" enctype="multipart/form-data" class="form-modern">
                                        @csrf

                                        {{-- General Info --}}
                                        <div class="form-row-2">
                                            <div class="mb-3">
                                                <label class="form-label">Judul Course</label>
                                                <input type="text" name="judul" class="form-control" placeholder="Contoh: Bootcamp Web Dev" required value="{{ old('judul') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <select name="kategori_id" class="form-select" required>
                                                    <option value="">-- Pilih Kategori --</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Mentor</label>
                                            <select name="mentor_id" class="form-select" required>
                                                <option value="">-- Pilih Mentor --</option>
                                                @foreach ($mentors as $mentor)
                                                    <option value="{{ $mentor->id }}" {{ old('mentor_id') == $mentor->id ? 'selected' : '' }}>{{ $mentor->username }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi Course</label>
                                            <div class="quill-editor-wrapper">
                                                <div id="editor-container"></div>
                                            </div>
                                            <input type="hidden" name="deskripsi" id="deskripsiInput" value="{{ old('deskripsi') }}">
                                        </div>

                                        {{-- Divider --}}
                                        <div class="form-divider"><i class="ri-price-tag-3-line"></i> Harga & Media</div>

                                        <div class="form-row-2">
                                            <div class="mb-3">
                                                <label class="form-label">Thumbnail</label>
                                                <input type="file" name="gambar" class="form-control" id="thumbnail" accept="image/*" required>
                                                <small id="thumbnailPreview" class="text-muted d-block mt-2" style="font-size:11px;">Belum ada file dipilih</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga Jual (IDR)</label>
                                                <input type="text" class="form-control" id="hargaDisplay" placeholder="0">
                                                <input type="hidden" name="harga" id="hargaHidden" value="0">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Kuota Peserta</label>
                                            <select name="kuota" class="form-select" required>
                                                <option value="">-- Pilih Kuota --</option>
                                                <option value="10" {{ old('kuota') == '10' ? 'selected' : '' }}>10 Peserta</option>
                                                <option value="20" {{ old('kuota') == '20' ? 'selected' : '' }}>20 Peserta</option>
                                                <option value="30" {{ old('kuota') == '30' ? 'selected' : '' }}>30 Peserta</option>
                                                <option value="50" {{ old('kuota') == '50' ? 'selected' : '' }}>50 Peserta</option>
                                                <option value="100" {{ old('kuota') == '100' ? 'selected' : '' }}>100 Peserta</option>
                                                <option value="0" {{ old('kuota') == '0' ? 'selected' : '' }}>Unlimited</option>
                                            </select>
                                        </div>

                                        {{-- Divider --}}
                                        <div class="form-divider"><i class="ri-folder-shared-line"></i> Modul Course</div>

                                        <div class="modul-wrapper" id="modulContainer">
                                            {{-- Rows injected by JS --}}
                                        </div>

                                        <button type="button" class="btn-add-modul-row" id="btnTambahModul">
                                            <i class="ri-add-circle-line" style="font-size:16px;"></i> Tambah Baris Modul
                                        </button>
                                        <small class="text-muted d-block mt-2" style="font-size:11px;">
                                            <i class="ri-information-line"></i> Cari dan pilih modul dari database yang tersedia.
                                        </small>

                                        {{-- Divider --}}
                                        <div class="form-divider"><i class="ri-toggle-line"></i> Status Publikasi</div>

                                        <div class="status-options">
                                            <label class="status-option-card">
                                                <input type="radio" name="status" value="publish" {{ old('status', 'publish') === 'publish' ? 'checked' : '' }}>
                                                <div class="status-card-content">
                                                    <i class="ri-global-line"></i>
                                                    <span class="status-text">Publish</span>
                                                </div>
                                            </label>
                                            <label class="status-option-card">
                                                <input type="radio" name="status" value="draft" {{ old('status') === 'draft' ? 'checked' : '' }}>
                                                <div class="status-card-content">
                                                    <i class="ri-draft-line"></i>
                                                    <span class="status-text">Draft</span>
                                                </div>
                                            </label>
                                        </div>

                                        {{-- Action Buttons --}}
                                        <div class="form-action-border" style="display:flex;gap:10px;justify-content:flex-end;margin-top:32px;padding-top:24px;border-top:1px solid var(--border-color);">
                                            <a href="{{ route('superadmin.course.list') }}" class="btn-brand btn-brand-muted">
                                                <i class="ri-arrow-left-line"></i> Batal
                                            </a>
                                            <button type="submit" class="btn-brand btn-brand-primary">
                                                <i class="ri-save-3-line"></i> Simpan Course
                                            </button>
                                        </div>

                                    </form>
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
    
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // ── 1. DATA INITIALIZATION ──
        let ALL_MODULS = [];
        @if(isset($moduls))
            ALL_MODULS = @json($moduls);
        @else
            ALL_MODULS = [
                { id: 1, judul: "Pengenalan HTML", kursus: { judul: "Web Dasar" }, urutan: 1 },
                { id: 2, judul: "Styling dengan CSS", kursus: { judul: "Web Dasar" }, urutan: 2 },
                { id: 3, judul: "JavaScript Dasar", kursus: { judul: "Web Lanjut" }, urutan: 1 }
            ];
        @endif

        // ── 2. QUILL EDITOR ──
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tuliskan deskripsi lengkap course di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'clean']
                ]
            }
        });
        const deskripsiInput = document.getElementById('deskripsiInput');
        if (deskripsiInput.value) quill.root.innerHTML = deskripsiInput.value;

        // ── 3. MODUL LOGIC ──
        let rowCounter = 0;
        const container = document.getElementById('modulContainer');

        function createModulRow() {
            rowCounter++;
            const rowId = 'modulRow_' + rowCounter;
            const inputId = 'modulSearch_' + rowCounter;
            const dropdownId = 'modulDrop_' + rowCounter;
            const hiddenId = 'modulHidden_' + rowCounter;

            const div = document.createElement('div');
            div.className = 'modul-row';
            div.id = rowId;
            div.dataset.selectedId = '';
            
            div.innerHTML = `
                <div class="modul-header">
                    <span class="modul-badge">Modul #${rowCounter}</span>
                    <button type="button" class="btn-remove-modul" onclick="removeModulRow('${rowId}')" title="Hapus">
                        <i class="ri-close-circle-line"></i>
                    </button>
                </div>
                <div class="modul-select-wrapper">
                    <input type="text" class="modul-search-input" id="${inputId}" placeholder="🔍 Cari judul modul..." autocomplete="off">
                    <div class="modul-dropdown" id="${dropdownId}"></div>
                    <input type="hidden" name="modul_ids[]" id="${hiddenId}" value="">
                    <div class="modul-chip-container"></div>
                </div>
            `;
            container.appendChild(div);
            bindSearchInput(inputId);
        }

        function bindSearchInput(inputId) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(input.nextElementSibling.id);
            
            input.addEventListener('focus', () => renderDropdown(inputId, ''));
            input.addEventListener('input', () => renderDropdown(inputId, input.value));
            
            document.addEventListener('click', (e) => {
                if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('open');
                }
            });
        }

        function renderDropdown(inputId, query) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(input.nextElementSibling.id);
            const row = input.closest('.modul-row');
            
            const q = query.toLowerCase();
            const filtered = ALL_MODULS.filter(m => 
                m.judul.toLowerCase().includes(q) || 
                (m.kursus?.judul || '').toLowerCase().includes(q)
            );

            if (!filtered.length) {
                dropdown.innerHTML = '<div style="padding:14px;text-align:center;color:#6b7280;font-size:12px;">Tidak ditemukan</div>';
            } else {
                dropdown.innerHTML = filtered.map(m => `
                    <div class="modul-dropdown-item ${row.dataset.selectedId == m.id ? 'selected' : ''}"
                         onclick="selectModul('${inputId}', ${m.id}, '${escapeHtml(m.judul)}', '${escapeHtml(m.kursus?.judul || '')}', ${m.urutan})">
                        <span class="item-title">${m.judul}</span>
                        <span class="item-meta">${m.kursus?.judul || '-'} • Urutan ${m.urutan}</span>
                    </div>
                `).join('');
            }
            dropdown.classList.add('open');
        }

        function selectModul(inputId, id, judul, kursusJudul, urutan) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(input.nextElementSibling.id);
            const hiddenId = input.nextElementSibling.nextElementSibling.id;
            const row = input.closest('.modul-row');
            const chipContainer = row.querySelector('.modul-chip-container');

            row.dataset.selectedId = id;
            document.getElementById(hiddenId).value = id;
            input.value = judul;

            chipContainer.innerHTML = `
                <div class="modul-chip">
                    <i class="ri-check-line"></i> ${judul}
                    <span style="opacity:0.7;margin-left:4px;">(${kursusJudul})</span>
                </div>
            `;
            dropdown.classList.remove('open');
        }

        function removeModulRow(rowId) {
            const row = document.getElementById(rowId);
            row.style.opacity = '0';
            setTimeout(() => { row.remove(); renumberRows(); }, 200);
        }

        function renumberRows() {
            document.querySelectorAll('.modul-row').forEach((row, i) => {
                row.querySelector('.modul-badge').textContent = 'Modul #' + (i + 1);
            });
        }

        document.getElementById('btnTambahModul').addEventListener('click', createModulRow);
        
        // Init one row
        if(ALL_MODULS.length > 0 || {{ isset($moduls) ? 'true' : 'false' }}) createModulRow();

        // ── 4. UTILS ──
        function escapeHtml(str) { return String(str).replace(/'/g, "\\'").replace(/"/g, '&quot;'); }
        
        function showAlert(message, type = 'error') {
            const container = document.getElementById('alertsContainer');
            const alertDiv = document.createElement('div');
            const iconClass = type === 'error' ? 'ri-error-warning-line' : 'ri-check-double-line';
            const cssClass = type === 'error' ? 'alert-error' : 'alert-success';
            
            alertDiv.className = `alert-modern ${cssClass}`;
            alertDiv.innerHTML = `
                <i class="${iconClass}" style="font-size:18px;margin-top:2px;"></i>
                <div>${message}</div>
            `;
            container.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.style.opacity = '0';
                alertDiv.style.transform = 'translateY(-10px)';
                setTimeout(() => alertDiv.remove(), 300);
            }, 5000);
        }

        // ── 5. FORM HANDLING ──
        
        const hargaDisplay = document.getElementById('hargaDisplay');
        const hargaHidden = document.getElementById('hargaHidden');
        hargaDisplay.addEventListener('input', () => {
            let val = hargaDisplay.value.replace(/[^0-9]/g, '');
            hargaHidden.value = val || '0';
            hargaDisplay.value = val ? 'Rp ' + new Intl.NumberFormat('id-ID').format(val) : '';
        });

        const thumbnailInput = document.getElementById('thumbnail');
        const thumbnailPreview = document.getElementById('thumbnailPreview');
        thumbnailInput.addEventListener('change', function() {
            thumbnailPreview.textContent = this.files.length ? 'File: ' + this.files[0].name : 'Belum ada file dipilih';
        });

        document.getElementById('courseForm').addEventListener('submit', function(e) {
            deskripsiInput.value = quill.root.innerHTML;
            if (quill.getText().trim().length === 0) {
                e.preventDefault();
                showAlert('⚠️ Deskripsi course wajib diisi.', 'error');
                quill.focus();
                return;
            }

            const rows = document.querySelectorAll('.modul-row');
            const selected = [...rows].filter(r => r.dataset.selectedId);
            
            if (rows.length > 0 && selected.length === 0) {
                e.preventDefault();
                showAlert('⚠️ Mohon pilih minimal satu modul atau hapus baris modul yang kosong.', 'error');
                return;
            }

            if (!hargaHidden.value) hargaHidden.value = '0';
        });

        @if($errors->any())
            showAlert('Terjadi kesalahan pada input.', 'error');
        @endif
    </script>
</body>
</html>