<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Reset Password Admin ' . $admin->username])

    <style>
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

        .breadcrumb-modern a:hover {
            text-decoration: underline;
        }

        .breadcrumb-modern .separator {
            color: var(--text-muted);
        }

        .breadcrumb-modern .current {
            color: var(--text-muted);
        }

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

        .content-card-title i {
            color: var(--brand-purple);
        }

        .content-card-body {
            padding: 28px;
        }

        .form-modern .form-group {
            margin-bottom: 20px;
        }

        .form-modern .form-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            display: block;
            margin-bottom: 8px;
            transition: color 0.35s ease;
        }

        .form-modern .form-control {
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
            background: var(--input-bg);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.35s ease, color 0.35s ease;
        }

        .form-modern .form-control:focus {
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 3px rgba(159, 102, 175, 0.10);
            background: var(--input-focus-bg);
        }

        .form-modern .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-modern .form-text {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
            transition: color 0.35s ease;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 42px;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: var(--brand-purple);
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
            box-shadow: 0 4px 14px rgba(159, 102, 175, 0.25);
        }

        .btn-brand-primary:hover {
            background: var(--brand-purple-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(159, 102, 175, 0.35);
        }

        .btn-brand-muted {
            background: var(--border-color);
            color: var(--text-secondary);
        }

        .btn-brand-muted:hover {
            background: var(--text-muted);
            color: #fff;
        }

        .alert-modern {
            padding: 14px 20px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: background 0.35s ease, border-color 0.35s ease, color 0.35s ease;
        }

        .alert-modern i {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-modern.alert-error {
            background: var(--danger-light);
            border-color: rgba(239, 68, 68, 0.25);
            color: var(--danger);
        }

        [data-theme="dark"] .alert-modern.alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(248, 113, 113, 0.2);
        }

        .alert-modern.alert-success {
            background: var(--success-light);
            border-color: rgba(16, 185, 129, 0.25);
            color: var(--success);
        }

        [data-theme="dark"] .alert-modern.alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(52, 211, 153, 0.2);
        }

        .alert-modern ul {
            margin: 4px 0 0 0;
            padding-left: 18px;
            font-size: 12px;
        }

        .alert-modern ul li {
            margin-bottom: 2px;
        }

        .icon-section {
            text-align: center;
            margin-bottom: 24px;
        }

        .icon-wrapper {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--brand-purple-light);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.35s ease;
        }

        .icon-wrapper i {
            font-size: 28px;
            color: var(--brand-purple);
        }

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

        @media (max-width: 767.98px) {
            .page-hero {
                padding: 20px 16px 0;
            }

            .page-hero-greeting {
                font-size: 20px;
            }

            .content-card-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-admin', 'activePage' => 'manajemen-admin-list'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">

                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Reset Password Admin</span>
                    </div>
                    <p class="page-hero-sub">
                        Reset kata sandi untuk admin <strong>{{ $admin->username }}</strong>.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('superadmin.admin.list') }}">Manajemen Admin</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Reset Password</span>
                    </div>
                </div>

                <div style="padding:24px 32px 32px;">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-10">

                            @if($errors->any())
                            <div class="alert-modern alert-error animate-slide-up" style="margin-bottom:20px;">
                                <i class="ri-error-warning-line"></i>
                                <div>
                                    <strong>Terjadi kesalahan!</strong>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            @if(session('success'))
                            <div class="alert-modern alert-success animate-slide-up" style="margin-bottom:20px;">
                                <i class="ri-check-double-line"></i>
                                <div>
                                    <strong>Berhasil!</strong> {{ session('success') }}
                                </div>
                            </div>
                            @endif

                            <div class="content-card animate-slide-up delay-1">
                                <div class="content-card-header">
                                    <div class="content-card-title">
                                        <i class="ri-lock-password-line"></i>
                                        Formulir Reset Password
                                    </div>
                                </div>

                                <div class="content-card-body">
                                    <div class="icon-section">
                                        <div class="icon-wrapper">
                                            <i class="ri-lock-line"></i>
                                        </div>
                                    </div>

                                    <form action="{{ route('superadmin.dashboard.admin.resetPasswordSave', $admin->id) }}" method="POST" class="form-modern">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label class="form-label">Password Baru</label>
                                            <div class="password-wrapper">
                                                <input type="password" name="new_password" class="form-control w-100"
                                                    placeholder="Masukkan password baru..." minlength="8" required>
                                                <button type="button" class="password-toggle" onclick="togglePassword(this)">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </div>
                                            <div class="form-text">
                                                <i class="ri-information-line"></i> Minimal 8 karakter
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label">Konfirmasi Password Baru</label>
                                            <div class="password-wrapper">
                                                <input type="password" name="new_password_confirmation" class="form-control w-100"
                                                    placeholder="Ulangi password baru..." minlength="8" required>
                                                <button type="button" class="password-toggle" onclick="togglePassword(this)">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:28px;padding-top:20px;border-top:1px solid var(--border-color);">
                                            <a href="{{ route('superadmin.admin.list') }}" class="btn-brand btn-brand-muted">
                                                <i class="ri-arrow-left-line"></i> Batal
                                            </a>
                                            <button type="submit" class="btn-brand btn-brand-primary">
                                                <i class="ri-save-line"></i> Simpan Perubahan
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

    <script>
        function togglePassword(btn) {
            const input = btn.previousElementSibling;
            const icon = btn.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'ri-eye-off-line';
            } else {
                input.type = 'password';
                icon.className = 'ri-eye-line';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.alert-modern').forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-8px)';
                    setTimeout(() => alert.remove(), 400);
                }, 5000);
            });
        });
    </script>
</body>

</html>
