<!-- <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ $pageTitle ?? 'Admin Dashboard' }} - Flodemi</title>
<meta name="description" content="Dashboard Superadmin Flodemi">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">

@vite(['resources/scss/main.scss']) -->
<!-- <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ $pageTitle ?? 'Admin Dashboard' }} - Flodemi</title>
<meta name="description" content="Dashboard Superadmin Flodemi">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">

@vite(['resources/scss/main.scss']) -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ $pageTitle ?? 'Admin Dashboard' }} — Flodemi</title>
<meta name="description" content="Dashboard Superadmin Flodemi">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">

{{-- Google Fonts: Manrope --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

{{-- Remix Icon --}}
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

@vite(['resources/scss/main.scss', 'resources/js/push-notification.js'])

<style>
    /* ══════════════════════════════════════
       LIGHT MODE (Default)
       ══════════════════════════════════════ */
    :root {
        --brand-purple: #9F66AF;
        --brand-purple-dark: #7C4D8E;
        --brand-purple-light: #F3E8F7;
        --brand-purple-50: #faf5fc;

        /* ── Sidebar: DYNAMIC (Changes with Theme) ── */
        --sidebar-bg: #ffffff;             /* Putih di Light Mode */
        --sidebar-border: #e8e5f0;         /* Border terang */
        --sidebar-hover: #f3e8f7;           /* Hover ungu muda */
        --sidebar-active: #9F66AF;         /* Solid Purple saat aktif (Light Mode) */
        --sidebar-text: #4b5563;           /* Teks Abu Gelap */
        --sidebar-text-active: #ffffff;    /* Teks Putih saat aktif */
        
        --sidebar-width: 270px;
        --sidebar-collapsed-width: 78px;

        /* ... variabel lainnya tetap sama ... */
        --header-height: 68px;
        --body-bg: #f4f2f7;
        --card-bg: #ffffff;
        --text-primary: #1a1a2e;
        --text-secondary: #6b7280;
        --text-muted: #9ca3af;
        --border-color: #e8e5f0;
        --border-color-light: rgba(0,0,0,0.04);
        
        --success: #10b981;
        --success-light: #ecfdf5;
        --danger: #ef4444;
        --danger-light: #fef2f2;
        --warning: #f59e0b;
        --warning-light: #fffbeb;
        --info: #3b82f6;
        --info-light: #eff6ff;

        --input-bg: #faf5fc;
        --input-focus-bg: #ffffff;
        --table-header-bg: #faf5fc;
        --table-hover-bg: #faf5fc;
        --dropdown-bg: #ffffff;
        --dropdown-shadow: 0 20px 60px rgba(0,0,0,0.12);
        --modal-header-bg: #faf5fc;
        --scrollbar-thumb: rgba(159,102,175,0.25);
        --scrollbar-thumb-hover: rgba(159,102,175,0.45);
        --shadow-card: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-card-hover: 0 12px 40px rgba(159,102,175,0.10);

        --icon-admin-bg-from: #eff6ff;
        --icon-admin-bg-to: #dbeafe;
        --icon-admin-color: #3b82f6;
        --icon-course-bg-from: #fff7ed;
        --icon-course-bg-to: #fed7aa;
        --icon-course-color: #f59e0b;
        --icon-mentee-bg-from: #ecfdf5;
        --icon-mentee-bg-to: #a7f3d0;
        --icon-mentee-color: #10b981;

        --footer-bg: #ffffff;
        --footer-copy-color: #9ca3af;
        --footer-link-color: #9ca3af;
    }

    /* ══════════════════════════════════════
       DARK MODE
       ══════════════════════════════════════ */
    [data-theme="dark"] {
        --brand-purple: #b07cc0;
        --brand-purple-dark: #9F66AF;
        --brand-purple-light: rgba(159,102,175,0.15);
        --brand-purple-50: rgba(159,102,175,0.08);

        /* ── Sidebar: Gelap di Dark Mode ── */
        --sidebar-bg: #0c0b14;
        --sidebar-border: rgba(159,102,175,0.08);
        --sidebar-hover: rgba(159,102,175,0.12);
        --sidebar-active: rgba(159,102,175,0.18); /* Transparan di Dark Mode */
        --sidebar-text: #8b8a9e;
        --sidebar-text-active: #ffffff;

        /* ── variabel lainnya tetap sama ... ── */
        --body-bg: #0f0e17;
        --card-bg: #1a1926;
        --text-primary: #f0eef5;
        --text-secondary: #9b97ae;
        --text-muted: #6b6780;
        --border-color: #2a283a;
        --border-color-light: rgba(255,255,255,0.04);

        --success: #34d399;
        --success-light: rgba(16,185,129,0.12);
        --danger: #f87171;
        --danger-light: rgba(239,68,68,0.12);
        --warning: #fbbf24;
        --warning-light: rgba(245,158,11,0.12);
        --info: #60a5fa;
        --info-light: rgba(59,130,246,0.12);

        --input-bg: rgba(159,102,175,0.06);
        --input-focus-bg: #1a1926;
        --table-header-bg: rgba(159,102,175,0.08);
        --table-hover-bg: rgba(159,102,175,0.06);
        --dropdown-bg: #1a1926;
        --dropdown-shadow: 0 20px 60px rgba(0,0,0,0.45);
        --modal-header-bg: rgba(159,102,175,0.08);
        --scrollbar-thumb: rgba(159,102,175,0.3);
        --scrollbar-thumb-hover: rgba(159,102,175,0.5);
        --shadow-card: 0 1px 3px rgba(0,0,0,0.2);
        --shadow-card-hover: 0 12px 40px rgba(159,102,175,0.15);

        --icon-admin-bg-from: rgba(59,130,246,0.15);
        --icon-admin-bg-to: rgba(59,130,246,0.08);
        --icon-admin-color: #60a5fa;
        --icon-course-bg-from: rgba(245,158,11,0.15);
        --icon-course-bg-to: rgba(245,158,11,0.08);
        --icon-course-color: #fbbf24;
        --icon-mentee-bg-from: rgba(16,185,129,0.15);
        --icon-mentee-bg-to: rgba(16,185,129,0.08);
        --icon-mentee-color: #34d399;

        --footer-bg: #1a1926;
        --footer-copy-color: #6b6780;
        --footer-link-color: #6b6780;
    }
    
    /* ... bagian font-family, body, scrollbar tetap sama ... */
    * { font-family: 'Manrope', sans-serif; }
    body { background: var(--body-bg); color: var(--text-primary); overflow-x: hidden; transition: background 0.35s ease, color 0.35s ease; }
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--scrollbar-thumb); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--scrollbar-thumb-hover); }

    /* ══════════════════════════════════════
       DARK MODE TOGGLE BUTTON
       (Bagian ini yang hilang sebelumnya)
       ══════════════════════════════════════ */
    .theme-toggle {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: var(--text-secondary);
        font-size: 19px;
        cursor: pointer;
        transition: background 0.25s ease, color 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .theme-toggle:hover {
        background: var(--brand-purple-light);
        color: var(--brand-purple);
    }

    .theme-toggle .icon-sun,
    .theme-toggle .icon-moon {
        position: absolute;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
    }

    .theme-toggle .icon-sun {
        transform: rotate(0deg) scale(1);
        opacity: 1;
    }

    .theme-toggle .icon-moon {
        transform: rotate(-90deg) scale(0);
        opacity: 0;
    }

    [data-theme="dark"] .theme-toggle .icon-sun {
        transform: rotate(90deg) scale(0);
        opacity: 0;
    }

    [data-theme="dark"] .theme-toggle .icon-moon {
        transform: rotate(0deg) scale(1);
        opacity: 1;
    }

    /* ══════════════════════════════════════
       GLOBAL TRANSITIONS (Updated)
       Sidebar variables now allowed for color transitions
       ══════════════════════════════════════ */
    .metric-card, .content-card, .header-modern, .footer-modern, .search-input-modern, .filter-select-modern, .modal-modern .modal-content, .modal-modern .modal-header, .modal-modern .modal-body, .table-modern thead th, .table-modern tbody td, .badge-status, .badge-role, .action-btn, .btn-brand {
        transition: background 0.35s ease, color 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease;
    }

    /* 
       ── Sidebar Transitions ──
       We now allow color transitions, but keep width transforms fast 
    */
    .sidebar-modern {
        /* Mengizinkan transisi background dan border saat ganti tema */
        transition: background 0.35s ease, border-color 0.35s ease, 
                    width 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-link {
        /* Transisi warna teks dan background diizinkan */
        transition: background 0.25s ease, color 0.25s ease, transform 0.15s ease;
    }
    
    .sidebar-brand-text h5, 
    .sidebar-brand-text span, 
    .sidebar-user-info h6, 
    .sidebar-user-info span {
        transition: color 0.35s ease;
    }
</style>

{{-- Prevent flash of wrong theme --}}
<script>
    (function() {
        const stored = localStorage.getItem('flodemi-theme');
        if (stored === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else if (stored === 'light') {
            document.documentElement.removeAttribute('data-theme');
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    })();
</script>