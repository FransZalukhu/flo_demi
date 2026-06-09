@php
    $user = Auth::user();
    $userName = $user->username ?? 'User';
    $userEmail = $user->email ?? 'user@example.com';
    $userRole = ucfirst($user->role ?? 'User');
    $userStatus = $user->status ?? 'nonaktif';

    if ($user->photo) {
        $userAvatar = asset('storage/' . $user->photo) . '?t=' . time();
    } else {
        $userAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=9F66AF&color=fff&size=128&font-size=0.4';
    }

    $headerNotifications = \App\Models\Notifikasi::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    $unreadCount = \App\Models\Notifikasi::where('user_id', Auth::id())
        ->where('sudah_dibaca', false)
        ->count();
@endphp

<style>
    .header-modern {
        position: sticky;
        top: 0;
        z-index: 1020;
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border-bottom: 1px solid var(--border-color);
        height: var(--header-height);
        transition: background 0.35s ease, border-color 0.35s ease;
    }

    [data-theme="dark"] .header-modern {
        background: rgba(15,14,23,0.85);
    }

    .header-modern .header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        padding: 0 28px;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-toggle {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        color: var(--text-secondary);
        font-size: 18px;
        flex-shrink: 0;
    }

    .header-toggle:hover {
        background: var(--brand-purple-light);
        border-color: var(--brand-purple);
        color: var(--brand-purple);
    }

    .header-search {
        position: relative;
        width: 320px;
    }

    .header-search input {
        width: 100%;
        padding: 9px 16px 9px 40px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background: var(--input-bg);
        font-size: 13px;
        font-weight: 500;
        color: var(--text-primary);
        transition: all 0.2s;
    }

    .header-search input:focus {
        outline: none;
        border-color: var(--brand-purple);
        box-shadow: 0 0 0 3px rgba(159,102,175,0.12);
        background: var(--input-focus-bg);
    }

    .header-search input::placeholder { color: var(--text-muted); }

    .header-search i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 15px;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-left: auto; /* Push right section to the end */
    }

    .header-icon-btn {
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
        transition: all 0.2s;
        position: relative;
    }

    .header-icon-btn:hover {
        background: var(--brand-purple-light);
        color: var(--brand-purple);
    }

    @keyframes pulse-badge {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }

    .notif-badge {
        position: absolute;
        top: 6px;
        right: 6px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        background: var(--danger);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--card-bg);
        animation: pulse-badge 2s ease-in-out infinite;
    }

    @keyframes bell-ring {
        0%, 100% { transform: rotate(0deg); }
        10%, 30% { transform: rotate(-8deg); }
        20%, 40% { transform: rotate(8deg); }
        50% { transform: rotate(0deg); }
    }

    .bell-shake { animation: bell-ring 2.5s ease-in-out infinite; }

    /* ── Notification Dropdown ── */
    .notif-dropdown {
        width: 380px !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 24px !important;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1) !important;
        padding: 0 !important;
        overflow: hidden;
        background: var(--dropdown-bg) !important;
    }

    [data-theme="dark"] .notif-dropdown {
        box-shadow: 0 20px 50px rgba(0,0,0,0.5) !important;
    }

    .notif-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-color-light);
    }

    .push-toggle-card {
        padding: 12px 16px;
        background: var(--brand-purple-50);
        border-radius: 16px;
        border: 1px solid var(--border-color-light);
        margin-top: 12px;
    }

    .push-switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 18px;
    }

    .push-switch input { opacity: 0; width: 0; height: 0; }

    .push-slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .push-slider:before {
        position: absolute;
        content: "";
        height: 14px; width: 14px;
        left: 2px; bottom: 2px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .push-slider { background-color: var(--brand-purple); }
    input:checked + .push-slider:before { transform: translateX(16px); }

    .notif-list-container {
        max-height: 400px;
        overflow-y: auto;
    }

    .notif-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color-light);
        transition: all 0.2s;
        text-decoration: none !important;
    }

    .notif-item:hover {
        background: var(--brand-purple-50);
    }

    .notif-icon-box {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }

    .notif-icon-box.type-pembayaran { background: #fff8eb; color: #f59e0b; }
    .notif-icon-box.type-pengumuman { background: #eff6ff; color: #3b82f6; }
    .notif-icon-box.type-default { background: var(--brand-purple-light); color: var(--brand-purple); }

    .notif-content { flex: 1; min-width: 0; }

    .notif-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 2px;
    }

    .notif-item:not(.unread) .notif-title { font-weight: 600; color: var(--text-secondary); }

    .notif-text {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .notif-meta {
        margin-top: 6px;
        font-size: 10px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .notif-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--brand-purple);
        margin-top: 6px;
    }

    .notif-footer {
        padding: 12px;
        text-align: center;
        border-top: 1px solid var(--border-color-light);
    }

    .notif-view-all {
        display: block;
        padding: 10px;
        border-radius: 12px;
        background: var(--brand-purple-light);
        color: var(--brand-purple);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.2s;
    }

    .notif-view-all:hover {
        background: var(--brand-purple);
        color: #fff;
    }

    /* ── User Dropdown ── */
    .user-dropdown {
        width: 260px !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 16px !important;
        box-shadow: var(--dropdown-shadow) !important;
        padding: 0 !important;
        overflow: hidden;
        background: var(--dropdown-bg) !important;
    }

    .user-dropdown-header {
        padding: 20px;
        background: linear-gradient(135deg, var(--brand-purple-50), var(--brand-purple-light));
    }

    [data-theme="dark"] .user-dropdown-header {
        background: linear-gradient(135deg, rgba(159,102,175,0.12), rgba(159,102,175,0.06));
    }

    .user-dropdown-avatar {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        object-fit: cover;
        border: 3px solid var(--card-bg);
        box-shadow: 0 4px 12px rgba(159,102,175,0.2);
    }

    .user-dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 20px;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-primary);
        transition: background 0.15s;
        text-decoration: none;
    }

    .user-dropdown-item:hover {
        background: var(--brand-purple-50);
        color: var(--brand-purple);
    }

    .user-dropdown-item i { font-size: 17px; color: var(--text-muted); }
    .user-dropdown-item:hover i { color: var(--brand-purple); }

    .user-dropdown-item.danger { color: var(--danger); }
    .user-dropdown-item.danger i { color: var(--danger); }
    .user-dropdown-item.danger:hover { background: var(--danger-light); }

    .header-avatar-img {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid var(--brand-purple-light);
    }

    .header-divider {
        width: 1px;
        height: 28px;
        background: var(--border-color);
        margin: 0 6px;
        transition: background 0.35s ease;
    }

    @media (max-width: 767.98px) {
        .header-search { display: none; }
        .header-modern .header-inner { padding: 0 16px; }
    }

    @media (min-width: 992px) {
        .header-left { 
            padding-left: 0; /* No extra padding needed since no burger menu */
        }
    }
</style>

<header class="header-modern">
    <div class="header-inner">
        {{-- Left Section --}}
        <div class="header-left">
            {{-- Mobile sidebar toggle (ONLY shows on < 992px) --}}
            <button class="header-toggle d-lg-none" id="mobileSidebarToggle" title="Open Menu">
                <i class="ri-menu-line"></i>
            </button>
            
            {{-- Search (hidden on mobile via CSS) --}}
            <div class="header-search">
                <i class="ri-search-line"></i>
                <input type="text" placeholder="Cari sesuatu...">
            </div>
        </div>

        {{-- Right Section --}}
        <div class="header-right">
            {{-- Dark Mode Toggle --}}
            <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode">
                <i class="ri-sun-line icon-sun"></i>
                <i class="ri-moon-line icon-moon"></i>
            </button>

            {{-- Notifications --}}
            <div class="dropdown">
                <button class="header-icon-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi">
                    <i class="ri-notification-3-line {{ $unreadCount > 0 ? 'bell-shake' : '' }}" id="bellIcon"></i>
                    <div id="unreadBadgeContainer">
                        @if($unreadCount > 0)
                        <span class="notif-badge">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                        @endif
                    </div>
                </button>
                <div class="dropdown-menu dropdown-menu-end notif-dropdown">
                    <div class="notif-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0" style="font-weight:800;font-size:15px;color:var(--text-primary);">Notifikasi</h6>
                            <button class="btn btn-sm p-0 border-0" id="markAllReadBtn" style="color:var(--brand-purple);font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:0.5px;">Tandai Dibaca</button>
                        </div>
                        
                        {{-- Push Toggle Card --}}
                        <div class="push-toggle-card d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div style="color:var(--brand-purple);font-size:18px;"><i class="ri-notification-badge-line"></i></div>
                                <div>
                                    <div style="font-size:11px;font-weight:800;color:var(--text-primary);line-height:1;">Push Notification</div>
                                    <div style="font-size:9px;color:var(--text-muted);font-weight:600;">Aktifkan notifikasi browser</div>
                                </div>
                            </div>
                            <label class="push-switch mb-0">
                                <input type="checkbox" id="pushToggle">
                                <span class="push-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="notif-list-container" id="headerNotificationList">
                        @forelse($headerNotifications as $notif)
                        <a href="{{ route('notifikasi.read', $notif->id) }}" class="notif-item {{ !$notif->sudah_dibaca ? 'unread' : '' }}">
                            <div class="notif-icon-box type-{{ $notif->tipe ?? 'default' }}">
                                @if ($notif->tipe == 'pembayaran')
                                    <i class="ri-bank-card-line"></i>
                                @elseif ($notif->tipe == 'pengumuman')
                                    <i class="ri-megaphone-line"></i>
                                @else
                                    <i class="ri-settings-3-line"></i>
                                @endif
                            </div>
                            <div class="notif-content">
                                <div class="notif-title">{{ $notif->judul }}</div>
                                <div class="notif-text">{{ $notif->pesan }}</div>
                                <div class="notif-meta">{{ $notif->created_at->diffForHumans() }}</div>
                            </div>
                            @if(!$notif->sudah_dibaca)
                            <div class="notif-dot"></div>
                            @endif
                        </a>
                        @empty
                        <div class="text-center py-5">
                            <i class="ri-notification-off-line" style="font-size:40px;color:var(--text-muted);opacity:0.3;"></i>
                            <p style="color:var(--text-muted);margin-top:12px;font-size:13px;font-weight:600;">Belum ada notifikasi</p>
                        </div>
                        @endforelse
                    </div>
                    
                    <div class="notif-footer">
                        <a href="{{ route('superadmin.dashboard.notifikasi') }}" class="notif-view-all">Lihat Semua</a>
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="header-divider"></div>

            {{-- User Profile --}}
            <div class="dropdown">
                <button class="header-icon-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:auto;padding:4px;border-radius:12px;">
                    <img src="{{ $userAvatar }}" alt="{{ $userName }}" class="header-avatar-img">
                </button>
                <div class="dropdown-menu dropdown-menu-end user-dropdown">
                    <div class="user-dropdown-header d-flex align-items-center gap-3">
                        <img src="{{ $userAvatar }}" alt="{{ $userName }}" class="user-dropdown-avatar">
                        <div>
                            <div style="font-weight:800;font-size:14px;color:var(--text-primary);">{{ $userName }}</div>
                            <div style="font-size:11px;color:var(--text-muted);">{{ $userEmail }}</div>
                            <span class="badge mt-1" style="background:var(--brand-purple-light);color:var(--brand-purple);font-size:10px;font-weight:700;border-radius:6px;padding:3px 8px;">
                                <i class="ri-shield-star-line" style="font-size:10px;"></i> {{ $userRole }}
                            </span>
                        </div>
                    </div>
                    <div style="padding:6px 0;">
                        <a class="user-dropdown-item" href="{{ route('superadmin.profile.index') }}">
                            <i class="ri-user-line"></i> Profil Saya
                        </a>
                        <div style="height:1px;background:var(--border-color);margin:4px 0;"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="user-dropdown-item danger w-100 border-0 bg-transparent" style="cursor:pointer;text-align:left;">
                                <i class="ri-logout-box-r-line"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ── Theme Toggle ──
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;

    function setTheme(dark) {
        if (dark) {
            html.setAttribute('data-theme', 'dark');
            localStorage.setItem('flodemi-theme', 'dark');
        } else {
            html.removeAttribute('data-theme');
            localStorage.setItem('flodemi-theme', 'light');
        }
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const isDark = html.getAttribute('data-theme') === 'dark';
            setTheme(!isDark);
        });
    }

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
        if (!localStorage.getItem('flodemi-theme')) {
            setTheme(e.matches);
        }
    });

    // ── Notifications ──
    const markAllReadBtn = document.getElementById('markAllReadBtn');
    const headerNotifList = document.getElementById('headerNotificationList');
    const unreadBadgeContainer = document.getElementById('unreadBadgeContainer');
    const bellIcon = document.getElementById('bellIcon');
    const pushToggle = document.getElementById('pushToggle');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Push Toggle Logic
    if ('serviceWorker' in navigator && pushToggle) {
        navigator.serviceWorker.ready.then(reg => {
            reg.pushManager.getSubscription().then(sub => {
                pushToggle.checked = !!sub;
            });
        });

        pushToggle.addEventListener('change', async function() {
            const vapidKey = "{{ config('webpush.vapid.public_key') }}";
            if (!vapidKey) return;
            
            const push = new PushNotification(vapidKey);
            await push.init();
            
            try {
                if (this.checked) {
                    await push.subscribeUser();
                    push.toast('Admin Alert Aktif', 'Notifikasi admin berhasil diaktifkan.');
                } else {
                    await push.unsubscribeUser();
                    push.toast('Admin Alert Mati', 'Notifikasi admin telah dinonaktifkan.', 'info');
                }
            } catch (e) {
                this.checked = !this.checked;
                push.toast('Error', 'Gagal memproses permintaan.', 'error');
            }
        });

        // Prevent dropdown from closing when clicking the toggle card
        const pushCard = document.querySelector('.push-toggle-card');
        if (pushCard) {
            pushCard.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    }

    function formatTime(isoString) {
        if (!isoString) return 'Baru saja';
        const date = new Date(isoString);
        const now = new Date();
        const diff = Math.floor((now - date) / 1000);
        if (diff < 60) return 'Baru saja';
        if (diff < 3600) return Math.floor(diff / 60) + 'm lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + 'j lalu';
        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
    }

    let currentNotifVersion = 0;

    function updateNotificationsUI() {
        fetch(`{{ route("notifikasi.latest") }}?v=${currentNotifVersion}`)
            .then(r => r.json())
            .then(data => {
                if (!data.success) return;
                if (data.v) currentNotifVersion = data.v;
                if (data.no_change) return;

                const count = data.unreadCount;

                if (count > 0) {
                    unreadBadgeContainer.innerHTML = `<span class="notif-badge">${count > 9 ? '9+' : count}</span>`;
                    bellIcon.classList.add('bell-shake');
                    if (markAllReadBtn) markAllReadBtn.style.display = 'block';
                } else {
                    unreadBadgeContainer.innerHTML = '';
                    bellIcon.classList.remove('bell-shake');
                    if (markAllReadBtn) markAllReadBtn.style.display = 'none';
                }

                if (data.notifications.length > 0) {
                    let html = '';
                    data.notifications.forEach(n => {
                        let iconClass = 'ri-settings-3-line';
                        let typeClass = 'type-default';
                        if (n.tipe === 'pembayaran') { iconClass = 'ri-bank-card-line'; typeClass = 'type-pembayaran'; }
                        else if (n.tipe === 'pengumuman') { iconClass = 'ri-megaphone-line'; typeClass = 'type-pengumuman'; }

                        const unread = !n.sudah_dibaca;
                        const dot = unread ? '<div class="notif-dot"></div>' : '';
                        const readUrl = `{{ url('/notifikasi') }}/${n.id}/read`;

                        html += `
                        <a href="${readUrl}" class="notif-item ${unread ? 'unread' : ''}">
                            <div class="notif-icon-box ${typeClass}"><i class="${iconClass}"></i></div>
                            <div class="notif-content">
                                <div class="notif-title">${n.judul}</div>
                                <div class="notif-text">${n.pesan}</div>
                                <div class="notif-meta">${formatTime(n.time_iso)}</div>
                            </div>
                            ${dot}
                        </a>`;
                    });
                    headerNotifList.innerHTML = html;
                } else {
                    headerNotifList.innerHTML = `
                    <div class="text-center py-5">
                        <i class="ri-notification-off-line" style="font-size:40px;color:var(--text-muted);opacity:0.3;"></i>
                        <p style="color:var(--text-muted);margin-top:12px;font-size:13px;font-weight:600;">Belum ada notifikasi</p>
                    </div>`;
                }
            })
            .catch(e => console.error('Error fetching notifications:', e));
    }

    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            fetch('{{ route("notifikasi.readAll") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => { if (data.success) { currentNotifVersion = 0; updateNotificationsUI(); } })
            .catch(e => console.error('Error marking as read:', e));
        });
    }

    setInterval(updateNotificationsUI, 5000);
});
</script>