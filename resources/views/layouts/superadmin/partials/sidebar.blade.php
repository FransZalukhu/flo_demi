<style>
    /* ── Sidebar Container ── */
    .sidebar-modern {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: var(--sidebar-width);
        background: var(--sidebar-bg);
        z-index: 1040;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-right: 1px solid var(--sidebar-border);
        transition: background 0.35s ease, border-color 0.35s ease,
                    width 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ── Brand — HEIGHT MUST MATCH HEADER (68px) ── */
    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 22px; /* Vertical padding removed — height driven by header */
        height: var(--header-height); /* 68px — same as header */
        border-bottom: 1px solid var(--border-color);
        flex-shrink: 0;
        box-sizing: border-box;
    }

    .sidebar-brand-icon {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, #9F66AF, #c084fc);
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(159,102,175,0.35);
    }

    .sidebar-brand-icon img {
        height: 22px;
        filter: brightness(0) invert(1);
    }

    .sidebar-brand-text {
        white-space: nowrap;
        overflow: hidden;
        transition: opacity 0.2s ease;
    }

    .sidebar-brand-text h5 {
        color: var(--text-primary);
        font-size: 16px;
        font-weight: 800;
        margin: 0;
        line-height: 1.2;
        letter-spacing: -0.3px;
    }

    .sidebar-brand-text span {
        color: var(--text-secondary);
        font-size: 9.5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .collapsed .sidebar-brand-text { opacity: 0; width: 0; }

    /* ── Navigation ── */
    .sidebar-nav {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 16px 14px;
    }

    .sidebar-nav::-webkit-scrollbar { width: 3px; }
    .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
    .sidebar-nav::-webkit-scrollbar-thumb {
        background: rgba(159,102,175,0.15);
        border-radius: 4px;
    }
    .sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: rgba(159,102,175,0.3);
    }

    /* ── Section Label ── */
    .sidebar-section-label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-muted);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.8px;
        padding: 20px 8px 8px;
        white-space: nowrap;
        overflow: hidden;
        transition: color 0.35s ease;
    }

    .sidebar-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--sidebar-border);
        min-width: 0;
        transition: background 0.35s ease;
    }

    .collapsed .sidebar-section-label { font-size: 0; padding: 12px 0; }
    .collapsed .sidebar-section-label::after { display: none; }

    /* ── Menu Item ── */
    .sidebar-item { margin-bottom: 2px; }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 9px 10px;
        border-radius: 10px;
        color: var(--sidebar-text);
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 600;
        white-space: nowrap;
        position: relative;
        cursor: pointer;
        transition: background 0.18s, color 0.18s;
    }

    .sidebar-link:hover {
        background: var(--sidebar-hover);
        color: var(--sidebar-text-active);
    }

    .sidebar-link.active {
        background: var(--sidebar-active);
        color: var(--sidebar-text-active);
    }

    .sidebar-link.active::before {
        content: '';
        position: absolute;
        left: -14px;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 24px;
        background: #9F66AF;
        border-radius: 0 4px 4px 0;
        box-shadow: 0 0 8px rgba(159,102,175,0.4);
    }

    /* Icon box for parent links */
    .sidebar-item > a.sidebar-link > i:first-child {
        width: 33px;
        height: 33px;
        border-radius: 9px;
        background: rgba(159,102,175,0.06);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
        transition: background 0.18s, color 0.18s;
    }

    [data-theme="dark"] .sidebar-item > a.sidebar-link > i:first-child {
        background: rgba(255,255,255,0.04);
    }

    .sidebar-item > a.sidebar-link:hover > i:first-child {
        background: rgba(159,102,175,0.12);
    }

    [data-theme="dark"] .sidebar-item > a.sidebar-link:hover > i:first-child {
        background: rgba(255,255,255,0.07);
    }

    .sidebar-item > a.sidebar-link.active > i:first-child {
        background: rgba(159,102,175,0.2);
    }

    [data-theme="dark"] .sidebar-item > a.sidebar-link.active > i:first-child {
        background: rgba(159,102,175,0.25);
    }

    .sidebar-link .link-text { flex: 1; overflow: hidden; transition: opacity 0.2s ease; }

    .collapsed .sidebar-link .link-text { opacity: 0; width: 0; }
    .collapsed .sidebar-link { justify-content: center; padding: 12px; gap: 0; }
    .collapsed .sidebar-link.active::before { left: 0; }

    /* Chevron */
    .sidebar-link .chevron {
        margin-left: auto;
        font-size: 17px;
        flex-shrink: 0;
        transition: transform 0.22s ease;
        color: var(--text-muted);
        width: auto !important;
        height: auto !important;
        background: none !important;
        border-radius: 0 !important;
    }

    .sidebar-link[aria-expanded="true"] .chevron { transform: rotate(90deg); }
    .collapsed .sidebar-link .chevron { display: none; }

    /* ── Submenu ── */
    .sidebar-submenu {
        margin-top: 6px;
        margin-left: 20px;
        padding-left: 16px;
        border-left: 1.5px solid var(--sidebar-border);
        transition: border-color 0.35s ease;
    }

    [data-theme="dark"] .sidebar-submenu {
        border-left-color: rgba(159,102,175,0.12);
    }

    .sidebar-submenu .sidebar-link {
        padding: 7px 10px;
        font-size: 12.5px;
        font-weight: 500;
        gap: 10px;
        border-radius: 9px;
        margin-bottom: 1px;
    }

    .sidebar-submenu .sidebar-link.active {
        background: var(--brand-purple-light);
        color: var(--brand-purple);
        font-weight: 600;
    }

    .sidebar-submenu .sidebar-link.active::before { display: none; }
    .collapsed .sidebar-submenu { display: none; }

    /* ── Dot indicator ── */
    .sb-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--sidebar-border);
        flex-shrink: 0;
        transition: background 0.15s, transform 0.15s;
    }

    [data-theme="dark"] .sb-dot {
        background: rgba(255,255,255,0.12);
    }

    .sidebar-submenu .sidebar-link:hover .sb-dot {
        background: var(--brand-purple);
        opacity: 0.5;
    }

    .sidebar-submenu .sidebar-link.active .sb-dot {
        background: var(--brand-purple);
        transform: scale(1.4);
    }

    /* ── User Card ── */
    .sidebar-user {
        padding: 16px 18px;
        border-top: 1px solid var(--border-color);
        flex-shrink: 0;
        transition: border-color 0.35s ease;
    }

    .sidebar-user-inner {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        background: var(--brand-purple-50);
        border-radius: 14px;
        border: 1px solid var(--border-color);
        transition: background 0.35s ease, border-color 0.35s ease;
    }

    [data-theme="dark"] .sidebar-user-inner {
        background: rgba(255,255,255,0.03);
        border-color: rgba(255,255,255,0.06);
    }

    .sidebar-user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        border: 2px solid var(--brand-purple);
    }

    .sidebar-user-info { overflow: hidden; white-space: nowrap; flex: 1; transition: opacity 0.2s ease; }

    .sidebar-user-info h6 {
        color: var(--text-primary);
        font-size: 13px;
        font-weight: 700;
        margin: 0;
        line-height: 1.3;
        text-overflow: ellipsis;
        overflow: hidden;
        transition: color 0.35s ease;
    }

    .sidebar-user-info span {
        color: var(--text-secondary);
        font-size: 11px;
        font-weight: 500;
        transition: color 0.35s ease;
    }

    .collapsed .sidebar-user-info { opacity: 0; width: 0; }
    .collapsed .sidebar-user-inner { justify-content: center; padding: 10px; }

    /* ── Mobile Overlay ── */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 1035;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar-overlay.show { display: block; opacity: 1; }

    @media (max-width: 991.98px) {
        .sidebar-modern {
            transform: translateX(-100%);
            width: var(--sidebar-width) !important;
            transition: transform 0.26s cubic-bezier(0.4,0,0.2,1);
        }
        .sidebar-modern.mobile-open { transform: translateX(0); }
    }

    /* ── Layout Adjustments ── */
    .main-wrapper {
        margin-left: var(--sidebar-width);
        transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .main-wrapper.sidebar-collapsed {
        margin-left: var(--sidebar-collapsed-width);
    }

    @media (max-width: 991.98px) {
        .main-wrapper { margin-left: 0 !important; }
    }
</style>

@php
    $user = Auth::user();
    $userName = $user->username ?? 'User';
    $userRole = ucfirst($user->role ?? 'User');
    if ($user->photo) {
        $userAvatar = asset('storage/' . $user->photo) . '?t=' . time();
    } else {
        $userAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=9F66AF&color=fff&size=128&font-size=0.4';
    }
@endphp

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar-modern" id="sidebarModern">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/logo1.png') }}" alt="Flodemi">
        </div>
        <div class="sidebar-brand-text">
            <h5>Flodemi</h5>
            <span>Superadmin</span>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        {{-- ── SECTION: UTAMA ── --}}
        <div class="sidebar-section-label">Utama</div>

        {{-- Dashboard --}}
        <div class="sidebar-item">
            <a class="sidebar-link {{ in_array($activeMenu ?? '', ['dashboard', 'profil']) ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#submenu-dashboard"
               aria-expanded="{{ in_array($activeMenu ?? '', ['dashboard', 'profil']) ? 'true' : 'false' }}"
               aria-controls="submenu-dashboard">
                <i class="ri-dashboard-3-line"></i>
                <span class="link-text">Dashboard</span>
                <i class="ri-arrow-right-s-line chevron"></i>
            </a>
            <div class="collapse {{ in_array($activeMenu ?? '', ['dashboard', 'profil']) ? 'show' : '' }}"
                 id="submenu-dashboard">
                <div class="sidebar-submenu">
                    <a class="sidebar-link {{ ($activePage ?? '') == 'dashboard-home' ? 'active' : '' }}"
                       href="{{ route('superadmin.dashboard.index') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Home</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'dashboard-notification' ? 'active' : '' }}"
                       href="{{ route('superadmin.dashboard.notifikasi') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Notifikasi</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-pendaftaran' ? 'active' : '' }}"
                       href="{{ route('superadmin.enrollment.index') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Pendaftaran</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'profil-saya' ? 'active' : '' }}"
                       href="{{ route('superadmin.profile.index') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Profil Saya</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- ── SECTION: MANAJEMEN ── --}}
        @if(auth()->check() && (auth()->user()->role === 'superadmin' || auth()->user()->hasPermission('kelola_course') || auth()->user()->hasPermission('kelola_mentee')))
        <div class="sidebar-section-label">Manajemen</div>
        @endif

        {{-- Manajemen Admin --}}
        @if(auth()->check() && auth()->user()->role === 'superadmin')
        <div class="sidebar-item">
            <a class="sidebar-link {{ ($activeMenu ?? '') == 'manajemen-admin' ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#submenu-admin"
               aria-expanded="{{ ($activeMenu ?? '') == 'manajemen-admin' ? 'true' : 'false' }}"
               aria-controls="submenu-admin">
                <i class="ri-shield-star-line"></i>
                <span class="link-text">Manajemen Admin</span>
                <i class="ri-arrow-right-s-line chevron"></i>
            </a>
            <div class="collapse {{ ($activeMenu ?? '') == 'manajemen-admin' ? 'show' : '' }}"
                 id="submenu-admin">
                <div class="sidebar-submenu">
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-admin-list' ? 'active' : '' }}"
                       href="{{ route('superadmin.admin.list') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Daftar Admin</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-admin-tambah' ? 'active' : '' }}"
                       href="{{ route('superadmin.admin.add') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Tambah Admin</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

        {{-- Manajemen Course --}}
        @if(auth()->check() && auth()->user()->hasPermission('kelola_course'))
        <div class="sidebar-item">
            <a class="sidebar-link {{ ($activeMenu ?? '') == 'manajemen-course' ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#submenu-course"
               aria-expanded="{{ ($activeMenu ?? '') == 'manajemen-course' ? 'true' : 'false' }}"
               aria-controls="submenu-course">
                <i class="ri-book-open-line"></i>
                <span class="link-text">Manajemen Course</span>
                <i class="ri-arrow-right-s-line chevron"></i>
            </a>
            <div class="collapse {{ ($activeMenu ?? '') == 'manajemen-course' ? 'show' : '' }}"
                 id="submenu-course">
                <div class="sidebar-submenu">
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-course-list' ? 'active' : '' }}"
                       href="{{ route('superadmin.course.list') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Daftar Course</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-course-tambah' ? 'active' : '' }}"
                       href="{{ route('superadmin.course.add') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Tambah Course</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-course-modul' ? 'active' : '' }}"
                       href="{{ route('superadmin.course.modul') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Modul</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-course-kategori' ? 'active' : '' }}"
                       href="{{ route('superadmin.course.kategori.index') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Kategori</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

        {{-- Manajemen Mentee --}}
        @if(auth()->check() && auth()->user()->hasPermission('kelola_mentee'))
        <div class="sidebar-item">
            <a class="sidebar-link {{ ($activeMenu ?? '') == 'manajemen-mentee' ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#submenu-mentee"
               aria-expanded="{{ ($activeMenu ?? '') == 'manajemen-mentee' ? 'true' : 'false' }}"
               aria-controls="submenu-mentee">
                <i class="ri-team-line"></i>
                <span class="link-text">Manajemen Mentee</span>
                <i class="ri-arrow-right-s-line chevron"></i>
            </a>
            <div class="collapse {{ ($activeMenu ?? '') == 'manajemen-mentee' ? 'show' : '' }}"
                 id="submenu-mentee">
                <div class="sidebar-submenu">
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-mentee-list' ? 'active' : '' }}"
                       href="{{ route('superadmin.mentee.list') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Daftar Mentee</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

    </nav>

    {{-- User Card --}}
    <!-- <div class="sidebar-user">
        <div class="sidebar-user-inner">
            <img src="{{ $userAvatar }}" alt="{{ $userName }}" class="sidebar-user-avatar">
            <div class="sidebar-user-info">
                <h6>{{ $userName }}</h6>
                <span>{{ $userRole }}</span>
            </div>
        </div>
    </div> -->

</aside>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar     = document.getElementById('sidebarModern');
    const mainWrapper = document.querySelector('.main-wrapper');
    const overlay     = document.getElementById('sidebarOverlay');

    /* ── Desktop toggle ── */
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            if (window.innerWidth >= 992) {
                sidebar.classList.toggle('collapsed');
                if (mainWrapper) mainWrapper.classList.toggle('sidebar-collapsed');
                if (sidebar.classList.contains('collapsed')) {
                    sidebar.querySelectorAll('.collapse.show').forEach(function (el) {
                        const instance = bootstrap.Collapse.getInstance(el);
                        if (instance) instance.hide();
                    });
                }
            }
        });
    }

    /* ── Mobile toggle ── */
    const mobileToggleBtn = document.getElementById('mobileSidebarToggle');
    if (mobileToggleBtn) {
        mobileToggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('show');
        });
    }

    /* ── Overlay → close sidebar ── */
    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        });
    }

    /* ── Reset on resize ── */
    function handleResize() {
        if (window.innerWidth < 992) {
            sidebar.classList.remove('collapsed');
            if (mainWrapper) mainWrapper.classList.remove('sidebar-collapsed');
        }
    }
    window.addEventListener('resize', handleResize);
    handleResize();
});
</script>