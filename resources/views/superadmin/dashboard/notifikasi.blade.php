<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Notifikasi'])

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

        .content-card-body {
            padding: 24px;
        }

        /* ══════════ NOTIFICATION ITEM ══════════ */
        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            margin-bottom: 16px;
            transition: all 0.3s ease;
            position: relative;
        }

        .notif-item:last-child {
            margin-bottom: 0;
        }

        .notif-item:hover {
            border-color: rgba(159, 102, 175, 0.35);
            box-shadow: 0 4px 20px rgba(159, 102, 175, 0.10);
            transform: translateY(-2px);
        }

        .notif-item.unread {
            border-color: rgba(159, 102, 175, 0.4);
            background: var(--card-bg);
        }

        .notif-item.unread::before {
            content: '';
            position: absolute;
            top: 20px;
            right: 20px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--brand-purple);
        }

        /* Avatar */
        .notif-avatar {
            flex-shrink: 0;
        }

        .notif-avatar img {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid var(--brand-purple-light);
        }

        /* Content */
        .notif-content {
            flex: 1;
            min-width: 0;
        }

        .notif-meta {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 6px;
        }

        .notif-actor {
            font-size: 13px;
            font-weight: 700;
            color: var(--brand-purple);
        }

        .notif-time {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
        }

        .notif-time i { font-size: 12px; }

        .notif-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .notif-message {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* Payment action box */
        .notif-action-box {
            margin-top: 14px;
            padding: 16px;
            border-radius: 12px;
            background: var(--table-header-bg);
            border: 1px solid var(--border-color);
        }

        .notif-action-box-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .badge-payment {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            background: var(--brand-purple-light);
            color: var(--brand-purple);
        }

        .btn-bukti {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 700;
            color: var(--brand-purple);
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-bukti:hover {
            color: var(--brand-purple-dark);
            text-decoration: underline;
        }

        .notif-action-btns {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-approve {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            background: var(--success);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16,185,129,0.25);
            text-decoration: none;
        }

        .btn-approve:hover {
            background: #059669;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(16,185,129,0.35);
        }

        .btn-reject {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid rgba(239,68,68,0.35);
            cursor: pointer;
            transition: all 0.2s;
            background: transparent;
            color: var(--danger);
        }

        .btn-reject:hover {
            background: var(--danger-light);
            border-color: var(--danger);
            transform: translateY(-1px);
        }

        /* ══════════ EMPTY STATE ══════════ */
        .empty-state-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state-illustration {
            margin-bottom: 28px;
            animation: float 3s ease-in-out infinite;
        }

        .empty-state-illustration svg {
            width: 200px;
            height: 200px;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-14px); }
        }

        .empty-state-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 10px;
        }

        .empty-state-message {
            font-size: 14px;
            color: var(--text-secondary);
            max-width: 380px;
            line-height: 1.6;
        }

        /* Bell icon animation */
        .bell-icon-anim {
            animation: bell-ring 2.5s ease-in-out infinite;
            transform-origin: top center;
        }

        @keyframes bell-ring {
            0%, 60%, 100% { transform: rotate(0deg); }
            10%, 30% { transform: rotate(-12deg); }
            20%, 40% { transform: rotate(12deg); }
        }

        /* ══════════ MODAL ══════════ */
        .modal-modern .modal-content {
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0,0,0,0.15);
            background: var(--card-bg);
        }

        [data-theme="dark"] .modal-modern .modal-content {
            box-shadow: 0 25px 80px rgba(0,0,0,0.5);
        }

        .modal-modern .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            background: var(--modal-header-bg, var(--card-bg));
        }

        .modal-modern .modal-title {
            font-weight: 800;
            font-size: 16px;
            color: var(--text-primary);
        }

        .modal-modern .modal-body {
            padding: 24px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .modal-modern .modal-body textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
            background: var(--input-bg, var(--card-bg));
            resize: vertical;
            min-height: 100px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .modal-modern .modal-body textarea:focus {
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 3px rgba(159,102,175,0.10);
        }

        .modal-modern .modal-body textarea::placeholder {
            color: var(--text-muted);
        }

        .modal-modern .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border-color);
        }
        .modal-modern .modal-body label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
        }
    </style>
            margin-bottom: 8px;
        }

        .modal-modern .modal-body p.modal-desc {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 16px;
            line-height: 1.6;
        }

        [data-theme="dark"] .modal-modern .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
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
            .notif-meta { flex-direction: column; gap: 4px; }
            .notif-action-box-top { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'dashboard', 'activePage' => 'dashboard-notification'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Notifikasi</span> 
                    </div>
                    <p class="page-hero-sub">
                        Pantau semua aktivitas terbaru dan permintaan yang membutuhkan tindakan Anda.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Notifikasi</span>
                    </div>
                </div>

                {{-- ══════════ NOTIFICATION CARD ══════════ --}}
                <div style="padding:24px 32px 32px;">
                    <div class="content-card animate-slide-up delay-1">
                        <div class="content-card-header">
                            <div class="content-card-title">
                                <i class="ri-notification-3-line"></i>
                                Daftar Notifikasi
                                @if($notifications->count() > 0)
                                <span style="background:var(--brand-purple);color:#fff;font-size:11px;padding:2px 8px;border-radius:20px;font-weight:700;">
                                    {{ $notifications->count() }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="content-card-body">
                            @forelse ($notifications as $notif)
                                @php
                                    $actor = $notif->pendaftaran ? $notif->pendaftaran->pengguna : null;
                                    $actorName = $actor->username ?? 'User';
                                    if ($actor && $actor->photo) {
                                        $avatar = asset('storage/' . $actor->photo);
                                    } else {
                                        $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($actorName) . '&background=9F66AF&color=fff&size=128&font-size=0.4';
                                    }
                                @endphp

                                <div class="notif-item {{ !$notif->sudah_dibaca ? 'unread' : '' }}">
                                    {{-- Avatar --}}
                                    <div class="notif-avatar">
                                        <img src="{{ $avatar }}" alt="{{ $actorName }}">
                                    </div>

                                    {{-- Content --}}
                                    <div class="notif-content">
                                        <div class="notif-meta">
                                            <div>
                                                <div class="notif-actor">{{ $actorName }}</div>
                                                <div class="notif-title">{{ $notif->judul }}</div>
                                            </div>
                                            <div class="notif-time">
                                                <i class="ri-time-line"></i>
                                                @if($notif->created_at->isToday())
                                                    {{ $notif->created_at->translatedFormat('H.i \W\I\B') }}
                                                @elseif($notif->created_at->isYesterday())
                                                    Kemarin
                                                @else
                                                    {{ $notif->created_at->translatedFormat('d M Y') }}
                                                @endif
                                            </div>
                                        </div>

                                        <p class="notif-message">{{ $notif->pesan }}</p>

                                        {{-- Payment action box --}}
                                        @if($notif->pendaftaran_id && $notif->pendaftaran->status === 'menunggu_verifikasi')
                                            @php $pembayaran = $notif->pendaftaran->pembayaran; @endphp
                                            <div class="notif-action-box">
                                                <div class="notif-action-box-top">
                                                    <span class="badge-payment">
                                                        <i class="ri-bank-card-line" style="font-size:11px;"></i>
                                                        Menunggu Verifikasi
                                                    </span>
                                                    @if($pembayaran && $pembayaran->bukti)
                                                        <a href="{{ asset('storage/' . $pembayaran->bukti) }}" target="_blank" class="btn-bukti">
                                                            <i class="ri-image-line"></i> Lihat Bukti Transfer
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="notif-action-btns">
                                                    <form action="{{ route('superadmin.course.approve', $notif->pendaftaran_id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn-approve">
                                                            <i class="ri-check-line"></i> Setujui
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn-reject" onclick="showRejectModal({{ $notif->pendaftaran_id }})">
                                                        <i class="ri-close-line"></i> Tolak
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            @empty
                                {{-- Empty State --}}
                                <div class="empty-state-container">
                                    <div class="empty-state-illustration">
                                        <svg viewBox="0 0 280 280" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="bellGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#9F66AF;stop-opacity:1" />
                                                    <stop offset="100%" style="stop-color:#7B4A8A;stop-opacity:1" />
                                                </linearGradient>
                                                <linearGradient id="bgGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#F3E8F7;stop-opacity:1" />
                                                    <stop offset="100%" style="stop-color:#E8D5F0;stop-opacity:1" />
                                                </linearGradient>
                                            </defs>
                                            <circle cx="140" cy="140" r="125" fill="url(#bgGradient)" opacity="0.35"/>
                                            <g class="bell-icon-anim">
                                                <path d="M140 60 C100 60, 80 90, 80 130 L80 170 L60 190 L60 200 L220 200 L220 190 L200 170 L200 130 C200 90, 180 60, 140 60 Z"
                                                      fill="url(#bellGradient)" stroke="#8B56A0" stroke-width="2"/>
                                                <ellipse cx="140" cy="60" rx="15" ry="8" fill="url(#bellGradient)" stroke="#8B56A0" stroke-width="2"/>
                                                <circle cx="140" cy="205" r="12" fill="#8B56A0"/>
                                                <path d="M140 52 L140 40" stroke="#8B56A0" stroke-width="4" stroke-linecap="round"/>
                                                <circle cx="140" cy="38" r="5" fill="#8B56A0"/>
                                                <path d="M55 120 Q45 130, 55 140" fill="none" stroke="#9F66AF" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
                                                <path d="M45 110 Q30 130, 45 150" fill="none" stroke="#9F66AF" stroke-width="3" stroke-linecap="round" opacity="0.4"/>
                                                <path d="M225 120 Q235 130, 225 140" fill="none" stroke="#9F66AF" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
                                                <path d="M235 110 Q250 130, 235 150" fill="none" stroke="#9F66AF" stroke-width="3" stroke-linecap="round" opacity="0.4"/>
                                            </g>
                                            <g transform="translate(195, 158)">
                                                <circle cx="0" cy="0" r="20" fill="#10b981" opacity="0.9"/>
                                                <path d="M-8 0 L-3 5 L8 -6" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <h3 class="empty-state-title">Tidak ada notifikasi</h3>
                                    <p class="empty-state-message">
                                        Semua aktivitas sudah terkini. Notifikasi baru akan muncul di sini saat ada perubahan atau permintaan dari mentee.
                                    </p>
                                </div>
                            @endforelse
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
                        <i class="ri-close-circle-line" style="color:var(--danger);margin-right:6px;"></i>
                        Tolak Pembayaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="modal-desc">
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
        function showRejectModal(id) {
            const form = document.getElementById('rejectForm');
            form.action = `/superadmin/course/reject/${id}`;
            const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
            modal.show();
        }
    </script>
</body>

</html>