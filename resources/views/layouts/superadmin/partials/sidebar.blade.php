@php
    $user = Auth::user();
    $name = $user->username ?? 'User';
    $role = ucfirst($user->role ?? 'User');
    $avatar = $user->photo 
        ? asset('storage/' . $user->photo) . '?t=' . time() 
        : 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=9F66AF&color=fff&size=128';
@endphp

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar-modern" id="sidebarModern">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/logo1.png') }}" alt="Flodemi">
        </div>
        <div class="sidebar-brand-text">
            <h5>Flodemi</h5>
            <span>Superadmin</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Utama</div>

        <div class="sidebar-item">
            <a class="sidebar-link has-submenu {{ in_array($activeMenu ?? '', ['dashboard', 'profil']) ? 'active' : '' }}"
               href="javascript:void(0)" data-target="submenu-dashboard">
                <i class="ri-dashboard-3-line text-lg"></i>
                <span class="link-text">Dashboard</span>
                <i class="ri-arrow-right-s-line chevron transition-transform duration-200 {{ in_array($activeMenu ?? '', ['dashboard', 'profil']) ? 'rotate-90' : '' }}"></i>
            </a>
            <div class="sidebar-submenu-container {{ in_array($activeMenu ?? '', ['dashboard', 'profil']) ? 'block' : 'hidden' }}" id="submenu-dashboard">
                <div class="sidebar-submenu">
                    <a class="sidebar-link {{ ($activePage ?? '') == 'dashboard-home' ? 'active' : '' }}" href="{{ route('superadmin.dashboard.index') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Home</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'dashboard-notification' ? 'active' : '' }}" href="{{ route('superadmin.dashboard.notifikasi') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Notifikasi</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-pendaftaran' ? 'active' : '' }}" href="{{ route('superadmin.enrollment.index') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Pendaftaran</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'profil-saya' ? 'active' : '' }}" href="{{ route('superadmin.profile.index') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Profil Saya</span>
                    </a>
                </div>
            </div>
        </div>

        @if(auth()->check() && (auth()->user()->role === 'superadmin' || auth()->user()->hasPermission('kelola_course') || auth()->user()->hasPermission('kelola_mentee')))
        <div class="sidebar-section-label">Manajemen</div>
        @endif

        @if(auth()->check() && auth()->user()->role === 'superadmin')
        <div class="sidebar-item">
            <a class="sidebar-link has-submenu {{ ($activeMenu ?? '') == 'manajemen-admin' ? 'active' : '' }}"
               href="javascript:void(0)" data-target="submenu-admin">
                <i class="ri-shield-star-line text-lg"></i>
                <span class="link-text">Manajemen Admin</span>
                <i class="ri-arrow-right-s-line chevron transition-transform duration-200 {{ ($activeMenu ?? '') == 'manajemen-admin' ? 'rotate-90' : '' }}"></i>
            </a>
            <div class="sidebar-submenu-container {{ ($activeMenu ?? '') == 'manajemen-admin' ? 'block' : 'hidden' }}" id="submenu-admin">
                <div class="sidebar-submenu">
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-admin-list' ? 'active' : '' }}" href="{{ route('superadmin.admin.list') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Daftar Admin</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-admin-tambah' ? 'active' : '' }}" href="{{ route('superadmin.admin.add') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Tambah Admin</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->hasPermission('kelola_course'))
        <div class="sidebar-item">
            <a class="sidebar-link has-submenu {{ ($activeMenu ?? '') == 'manajemen-course' ? 'active' : '' }}"
               href="javascript:void(0)" data-target="submenu-course">
                <i class="ri-book-open-line text-lg"></i>
                <span class="link-text">Manajemen Course</span>
                <i class="ri-arrow-right-s-line chevron transition-transform duration-200 {{ ($activeMenu ?? '') == 'manajemen-course' ? 'rotate-90' : '' }}"></i>
            </a>
            <div class="sidebar-submenu-container {{ ($activeMenu ?? '') == 'manajemen-course' ? 'block' : 'hidden' }}" id="submenu-course">
                <div class="sidebar-submenu">
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-course-list' ? 'active' : '' }}" href="{{ route('superadmin.course.list') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Daftar Course</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-course-tambah' ? 'active' : '' }}" href="{{ route('superadmin.course.add') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Tambah Course</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-course-modul' ? 'active' : '' }}" href="{{ route('superadmin.course.modul') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Modul</span>
                    </a>
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-course-kategori' ? 'active' : '' }}" href="{{ route('superadmin.course.kategori.index') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Kategori</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->hasPermission('kelola_mentee'))
        <div class="sidebar-item">
            <a class="sidebar-link has-submenu {{ ($activeMenu ?? '') == 'manajemen-mentee' ? 'active' : '' }}"
               href="javascript:void(0)" data-target="submenu-mentee">
                <i class="ri-team-line text-lg"></i>
                <span class="link-text">Manajemen Mentee</span>
                <i class="ri-arrow-right-s-line chevron transition-transform duration-200 {{ ($activeMenu ?? '') == 'manajemen-mentee' ? 'rotate-90' : '' }}"></i>
            </a>
            <div class="sidebar-submenu-container {{ ($activeMenu ?? '') == 'manajemen-mentee' ? 'block' : 'hidden' }}" id="submenu-mentee">
                <div class="sidebar-submenu">
                    <a class="sidebar-link {{ ($activePage ?? '') == 'manajemen-mentee-list' ? 'active' : '' }}" href="{{ route('superadmin.mentee.list') }}">
                        <span class="sb-dot"></span>
                        <span class="link-text">Daftar Mentee</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

    </nav>
</aside>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebarModern');
    const mainWrap = document.querySelector('.main-wrapper');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const mobileBtn = document.getElementById('mobileSidebarToggle');

    // Custom Submenu Toggle
    document.querySelectorAll('.has-submenu').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const target = document.getElementById(targetId);
            const chevron = this.querySelector('.chevron');
            
            if(target.classList.contains('hidden')) {
                target.classList.remove('hidden');
                target.classList.add('block');
                if (chevron) chevron.classList.add('rotate-90');
            } else {
                target.classList.add('hidden');
                target.classList.remove('block');
                if (chevron) chevron.classList.remove('rotate-90');
            }
        });
    });

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth >= 992) {
                sidebar.classList.toggle('collapsed');
                if (mainWrap) mainWrap.classList.toggle('sidebar-collapsed');
                
                // Hide all submenus when collapsed
                if (sidebar.classList.contains('collapsed')) {
                    document.querySelectorAll('.sidebar-submenu-container').forEach(el => {
                        el.classList.add('hidden');
                        el.classList.remove('block');
                    });
                    document.querySelectorAll('.has-submenu .chevron').forEach(icon => icon.classList.remove('rotate-90'));
                }
            }
        });
    }

    if (mobileBtn) {
        mobileBtn.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('show');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        });
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth < 992) {
            sidebar.classList.remove('collapsed');
            if (mainWrap) mainWrap.classList.remove('sidebar-collapsed');
        }
    });
});
</script>