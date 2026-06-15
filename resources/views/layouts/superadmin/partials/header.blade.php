@php
    $user = Auth::user();
    $name = $user->username ?? 'User';
    $email = $user->email ?? 'user@example.com';
    $role = ucfirst($user->role ?? 'User');
    $avatar = $user->photo 
        ? asset('storage/' . $user->photo) . '?t=' . time() 
        : 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=9F66AF&color=fff&size=128';

    $notifs = \App\Models\Notifikasi::where('user_id', Auth::id())->latest()->limit(5)->get();
    $unread = \App\Models\Notifikasi::where('user_id', Auth::id())->where('sudah_dibaca', false)->count();
@endphp

<header class="header-modern">
    <div class="header-inner">
        <div class="header-left">
            <button class="header-toggle lg:hidden" id="mobileSidebarToggle" title="Menu">
                <i class="ri-menu-line text-lg"></i>
            </button>
            <div class="header-search hidden sm:relative sm:block sm:w-80">
                <i class="ri-search-line absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                <input type="text" placeholder="Cari sesuatu..." class="w-full pl-11 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:bg-white focus:border-brand-purple focus:ring-4 focus:ring-brand-purple/10 dark:bg-slate-900/50 dark:border-slate-800 dark:text-slate-200 dark:focus:bg-[#13111c] transition-all">
            </div>
        </div>

        <div class="header-right flex items-center gap-3">
            <button class="w-10 h-10 rounded-xl border border-slate-100 dark:border-slate-800 flex items-center justify-center cursor-pointer transition-all duration-200 text-slate-500 dark:text-slate-400 hover:bg-brand-purple-light/30 hover:border-brand-purple hover:text-brand-purple" id="themeToggle" title="Tema">
                <i class="ri-sun-line dark:hidden text-lg"></i>
                <i class="ri-moon-line hidden dark:block text-lg"></i>
            </button>

            <div class="relative custom-dropdown">
                <button class="w-10 h-10 dropdown-btn rounded-xl border border-slate-100 dark:border-slate-800 flex items-center justify-center cursor-pointer transition-all duration-200 text-slate-500 dark:text-slate-400 hover:bg-brand-purple-light/30 hover:border-brand-purple hover:text-brand-purple" type="button" title="Notifikasi">
                    <i class="ri-notification-3-line text-lg {{ $unread > 0 ? 'bell-shake' : '' }}" id="bellIcon"></i>
                    <div id="unreadBadgeContainer">
                        @if($unread > 0)
                            <span class="absolute top-1.5 right-1.5 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-[10px] font-bold border-2 border-white dark:border-[#0f0e17]">{{ $unread > 9 ? '9+' : $unread }}</span>
                        @endif
                    </div>
                </button>
                <div class="dropdown-menu hidden absolute right-0 top-full mt-2 min-w-[320px] z-[50] bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-800 shadow-xl rounded-2xl p-4">
                    <div class="notif-header mb-3">
                        <div class="flex justify-between items-center">
                            <h6 class="text-sm font-extrabold text-slate-800 dark:text-white">Notifikasi</h6>
                            <button class="text-[10px] font-extrabold text-brand-purple hover:text-brand-purple-dark uppercase tracking-wider" id="markAllReadBtn" style="display: {{ $unread > 0 ? 'block' : 'none' }}">Tandai Dibaca</button>
                        </div>
                        <div class="mt-3 p-3 bg-slate-50 dark:bg-slate-900/40 rounded-xl flex items-center justify-between push-toggle-card">
                            <div class="flex items-center gap-2.5">
                                <div class="text-brand-purple text-lg"><i class="ri-notification-badge-line"></i></div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-700 dark:text-slate-300 leading-none">Push Notification</div>
                                    <div class="text-[8px] text-slate-400 font-semibold mt-0.5">Notifikasi browser</div>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="pushToggle" class="sr-only peer">
                                <div class="w-8 h-4 bg-slate-200 dark:bg-slate-700 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-brand-purple"></div>
                            </label>
                        </div>
                    </div>

                    <div class="notif-list-container space-y-2 max-h-64 overflow-y-auto pr-1" id="headerNotificationList">
                        @forelse($notifs as $n)
                            <a href="{{ route('notifikasi.read', $n->id) }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors {{ !$n->sudah_dibaca ? 'bg-brand-purple-light/20' : '' }}">
                                <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center text-sm {{ $n->tipe == 'pembayaran' ? 'bg-amber-50 text-amber-600 dark:bg-amber-500/10' : 'bg-brand-purple-light text-brand-purple dark:bg-brand-purple/15' }}">
                                    @if ($n->tipe == 'pembayaran')
                                        <i class="ri-bank-card-line"></i>
                                    @elseif ($n->tipe == 'pengumuman')
                                        <i class="ri-megaphone-line"></i>
                                    @else
                                        <i class="ri-settings-3-line"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-[11px] font-bold text-slate-800 dark:text-white truncate">{{ $n->judul }}</div>
                                    <div class="text-[9px] text-slate-400 dark:text-slate-400 mt-0.5 line-clamp-2 leading-relaxed">{{ $n->pesan }}</div>
                                    <div class="text-[8px] text-slate-400 dark:text-slate-500 mt-1 font-semibold">{{ $n->created_at->diffForHumans() }}</div>
                                </div>
                                @if(!$n->sudah_dibaca)
                                    <div class="w-2 h-2 rounded-full bg-brand-purple mt-2 shrink-0"></div>
                                @endif
                            </a>
                        @empty
                            <div class="text-center py-6">
                                <i class="ri-notification-off-line text-3xl text-slate-300 dark:text-slate-700"></i>
                                <p class="text-slate-400 mt-2 text-xs font-semibold">Belum ada notifikasi</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-3 pt-3 border-t border-slate-100 dark:border-slate-800 text-center">
                        <a href="{{ route('superadmin.dashboard.notifikasi') }}" class="text-[10px] font-bold text-brand-purple hover:underline">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <div class="w-px h-6 bg-slate-100 dark:bg-slate-800"></div>

            <div class="relative custom-dropdown">
                <button class="flex items-center gap-2 p-1.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors dropdown-btn" type="button">
                    <img src="{{ $avatar }}" alt="{{ $name }}" class="w-8 h-8 rounded-lg object-cover border border-slate-200/50">
                </button>
                <div class="dropdown-menu hidden absolute right-0 top-full mt-2 min-w-[240px] z-[50] bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-800 shadow-xl rounded-2xl p-4">
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                        <img src="{{ $avatar }}" alt="{{ $name }}" class="w-10 h-10 rounded-lg object-cover">
                        <div class="min-w-0">
                            <div class="text-xs font-extrabold text-slate-800 dark:text-white truncate">{{ $name }}</div>
                            <div class="text-[9px] text-slate-400 dark:text-slate-500 truncate mt-0.5">{{ $email }}</div>
                            <span class="inline-flex items-center gap-1 mt-1.5 px-2 py-0.5 bg-brand-purple-light dark:bg-brand-purple/10 text-brand-purple text-[9px] font-bold rounded-md">
                                <i class="ri-shield-star-line text-[9px]"></i> {{ $role }}
                            </span>
                        </div>
                    </div>
                    <div class="py-1 mt-2">
                        <a class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs text-slate-600 dark:text-slate-400 font-semibold hover:bg-slate-50 dark:hover:bg-slate-900/40 hover:text-brand-purple transition-all" href="{{ route('superadmin.profile.index') }}">
                            <i class="ri-user-line text-sm text-slate-400"></i> Profil Saya
                        </a>
                        <div class="h-px bg-slate-100 dark:bg-slate-800 my-1"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs text-red-600 font-semibold hover:bg-red-50 dark:hover:bg-red-500/10 transition-all text-left bg-transparent border-0 cursor-pointer">
                                <i class="ri-logout-box-r-line text-sm text-red-400"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Dropdown Logic
    document.addEventListener('click', e => {
        if (!e.target.closest('.custom-dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.add('hidden'));
        }
    });

    document.querySelectorAll('.dropdown-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            const menu = btn.nextElementSibling;
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m !== menu) m.classList.add('hidden');
            });
            menu.classList.toggle('hidden');
        });
    });

    // Prevent closing when clicking inside menu unless it's a link
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.addEventListener('click', e => {
            if (!e.target.closest('a') && !e.target.closest('button[type="submit"]')) {
                e.stopPropagation();
            }
        });
    });

    const html = document.documentElement;
    const themeBtn = document.getElementById('themeToggle');

    const toggleTheme = (isDark) => {
        if (isDark) {
            html.setAttribute('data-theme', 'dark');
            html.classList.add('dark');
            localStorage.setItem('flodemi-theme', 'dark');
        } else {
            html.removeAttribute('data-theme');
            html.classList.remove('dark');
            localStorage.setItem('flodemi-theme', 'light');
        }
    };

    if (themeBtn) {
        themeBtn.addEventListener('click', () => toggleTheme(!html.classList.contains('dark')));
    }

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('flodemi-theme')) toggleTheme(e.matches);
    });

    // Notifications
    const markReadBtn = document.getElementById('markAllReadBtn');
    const notifList = document.getElementById('headerNotificationList');
    const badgeBox = document.getElementById('unreadBadgeContainer');
    const bellIcon = document.getElementById('bellIcon');
    const pushToggle = document.getElementById('pushToggle');
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    let notifVer = 0;

    if ('serviceWorker' in navigator && pushToggle) {
        navigator.serviceWorker.ready.then(reg => {
            reg.pushManager.getSubscription().then(sub => pushToggle.checked = !!sub);
        });

        pushToggle.addEventListener('change', async function() {
            const key = "{{ config('webpush.vapid.public_key') }}";
            if (!key) return;
            
            const push = new PushNotification(key);
            await push.init();
            
            try {
                if (this.checked) {
                    await push.subscribeUser();
                    push.toast('Admin Alert Aktif', 'Notifikasi admin diaktifkan.');
                } else {
                    await push.unsubscribeUser();
                    push.toast('Admin Alert Mati', 'Notifikasi admin dinonaktifkan.', 'info');
                }
            } catch (e) {
                this.checked = !this.checked;
                push.toast('Error', 'Gagal memproses.', 'error');
            }
        });
    }

    const formatTime = (iso) => {
        if (!iso) return 'Baru saja';
        const diff = Math.floor((new Date() - new Date(iso)) / 1000);
        if (diff < 60) return 'Baru saja';
        if (diff < 3600) return Math.floor(diff / 60) + 'm lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + 'j lalu';
        return new Date(iso).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
    };

    const updateUI = () => {
        fetch(`{{ route('notifikasi.latest') }}?v=${notifVer}`)
            .then(r => r.json())
            .then(d => {
                if (!d.success || d.no_change) return;
                if (d.v) notifVer = d.v;

                if (d.unreadCount > 0) {
                    badgeBox.innerHTML = `<span class="absolute top-1.5 right-1.5 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-[10px] font-bold border-2 border-white dark:border-[#0f0e17]">${d.unreadCount > 9 ? '9+' : d.unreadCount}</span>`;
                    bellIcon.classList.add('bell-shake');
                    if (markReadBtn) markReadBtn.style.display = 'block';
                } else {
                    badgeBox.innerHTML = '';
                    bellIcon.classList.remove('bell-shake');
                    if (markReadBtn) markReadBtn.style.display = 'none';
                }

                if (d.notifications.length > 0) {
                    notifList.innerHTML = d.notifications.map(n => {
                        let ic = 'ri-settings-3-line', tc = 'bg-brand-purple-light text-brand-purple dark:bg-brand-purple/15';
                        if (n.tipe === 'pembayaran') { ic = 'ri-bank-card-line'; tc = 'bg-amber-50 text-amber-600 dark:bg-amber-500/10'; }
                        else if (n.tipe === 'pengumuman') { ic = 'ri-megaphone-line'; tc = 'bg-brand-purple-light text-brand-purple dark:bg-brand-purple/15'; }
                        const unread = !n.sudah_dibaca;
                        
                        return `
                        <a href="{{ url('/notifikasi') }}/${n.id}/read" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors ${unread ? 'bg-brand-purple-light/20' : ''}">
                            <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center text-sm ${tc}"><i class="${ic}"></i></div>
                            <div class="flex-1 min-w-0">
                                <div class="text-[11px] font-bold text-slate-800 dark:text-white truncate">${n.judul}</div>
                                <div class="text-[9px] text-slate-400 mt-0.5 line-clamp-2 leading-relaxed">${n.pesan}</div>
                                <div class="text-[8px] text-slate-400 mt-1 font-semibold">${formatTime(n.time_iso)}</div>
                            </div>
                            ${unread ? '<div class="w-2 h-2 rounded-full bg-brand-purple mt-2 shrink-0"></div>' : ''}
                        </a>`;
                    }).join('');
                } else {
                    notifList.innerHTML = `<div class="text-center py-6"><i class="ri-notification-off-line text-3xl text-slate-300 dark:text-slate-700"></i><p class="text-slate-400 mt-2 text-xs font-semibold">Belum ada notifikasi</p></div>`;
                }
            }).catch(console.error);
    };

    if (markReadBtn) {
        markReadBtn.addEventListener('click', e => {
            e.preventDefault(); e.stopPropagation();
            fetch('{{ route("notifikasi.readAll") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': token, 'Content-Type': 'application/json', 'Accept': 'application/json' }
            }).then(r => r.json()).then(d => { if (d.success) { notifVer = 0; updateUI(); } }).catch(console.error);
        });
    }

    setInterval(updateUI, 5000);
});
</script>