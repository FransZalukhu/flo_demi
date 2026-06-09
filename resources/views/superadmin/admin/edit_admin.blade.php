<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Edit Admin'])

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

        .form-modern .form-control,
        .form-modern .form-select {
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

        .form-modern .form-control:focus,
        .form-modern .form-select:focus {
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 3px rgba(159, 102, 175, 0.10);
            background: var(--input-focus-bg);
        }

        .form-modern .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-modern .form-select {
            cursor: pointer;
        }

        [data-theme="dark"] .form-modern .form-select option {
            background: #1a1926;
            color: #f0eef5;
        }

        .form-modern .form-select option:checked {
            background-color: var(--brand-purple) !important;
            color: #ffffff !important;
        }

        .form-modern .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background: var(--input-bg);
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .form-modern .form-check:hover {
            border-color: rgba(159, 102, 175, 0.4);
            background: var(--brand-purple-light);
        }

        .form-modern .form-check-input {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 2px solid var(--border-color);
            background-color: var(--input-bg);
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            margin-top: 0;
        }

        .form-modern .form-check-input:checked {
            background-color: var(--brand-purple);
            border-color: var(--brand-purple);
        }

        .form-modern .form-check-input:focus {
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 3px rgba(159, 102, 175, 0.10);
        }

        .form-modern .form-check-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.35s ease;
        }

        .form-modern .form-check-label i {
            font-size: 16px;
            color: var(--brand-purple);
        }

        .form-modern .form-check:has(.form-check-input:checked) {
            border-color: rgba(159, 102, 175, 0.4);
            background: var(--brand-purple-light);
        }

        .permission-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 8px;
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

        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 767.98px) {
            .form-row-2 {
                grid-template-columns: 1fr;
            }
        }

        .form-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .form-divider::before,
        .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        .form-divider i {
            font-size: 14px;
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

            .permission-group {
                grid-template-columns: 1fr;
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
                        <span>Edit Data Admin</span>
                    </div>
                    <p class="page-hero-sub">
                        Perbarui data Admin pada formulir di bawah ini.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('superadmin.admin.list') }}">Manajemen Admin</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Edit Admin</span>
                    </div>
                </div>

                <div style="padding:24px 32px 32px;">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-9 col-md-10">

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
                                        <i class="ri-user-settings-line"></i>
                                        Formulir Edit Admin
                                    </div>
                                </div>

                                <div class="content-card-body">
                                    <form action="{{ route('superadmin.admin.update', $admin->id) }}" method="POST" class="form-modern">
                                        @csrf

                                        <div class="form-divider">
                                            <i class="ri-shield-user-line"></i>
                                            Informasi Akun
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="username" class="form-control"
                                                placeholder="Masukkan nama lengkap..." value="{{ old('username', $admin->username) }}" required>
                                        </div>

                                        <div class="form-row-2">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="contoh@email.com" value="{{ old('email', $admin->email) }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Nomor Handphone</label>
                                                <input type="tel" name="nomor_hp" class="form-control"
                                                    placeholder="08xxxxxxxxxx" value="{{ old('nomor_hp', $admin->nomor_hp) }}"
                                                    inputmode="numeric" pattern="[0-9]*" maxlength="13"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            </div>
                                        </div>

                                        <div class="form-row-2">
                                            <div class="mb-3">
                                                <label class="form-label">Role</label>
                                                <select name="role" class="form-select" required>
                                                    <option value="">Pilih role...</option>
                                                    <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="superadmin" {{ old('role', $admin->role) == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="">Pilih status...</option>
                                                    <option value="aktif" {{ old('status', $admin->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="nonaktif" {{ old('status', $admin->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-divider">
                                            <i class="ri-key-2-line"></i>
                                            Hak Akses
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Hak Akses Manajemen</label>
                                            @php
                                                $userPermissions = $admin->getPermissionsArray();
                                            @endphp
                                            <div class="permission-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="permissions[]" value="kelola_mentor"
                                                        id="permission_mentor"
                                                        {{ in_array('kelola_mentor', old('permissions', $userPermissions)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission_mentor">
                                                        <i class="ri-user-star-line"></i>
                                                        Kelola Mentor
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="permissions[]" value="kelola_mentee"
                                                        id="permission_mentee"
                                                        {{ in_array('kelola_mentee', old('permissions', $userPermissions)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission_mentee">
                                                        <i class="ri-team-line"></i>
                                                        Kelola Mentee
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="permissions[]" value="kelola_course"
                                                        id="permission_course"
                                                        {{ in_array('kelola_course', old('permissions', $userPermissions)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission_course">
                                                        <i class="ri-book-open-line"></i>
                                                        Kelola Course
                                                    </label>
                                                </div>
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