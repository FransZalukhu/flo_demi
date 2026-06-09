<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Superadmin - Flodemi</title>
    <meta name="description" content="Login Superadmin Flodemi">
    <link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">

    @vite(['resources/scss/main.scss'])

    <style>
        body {
            background: linear-gradient(135deg, #9F66AF 0%, #7B4A8A 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 20px 0;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #9F66AF 0%, #7B4A8A 100%);
            padding: 40px 30px;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -30%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 1;
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px;
            position: relative;
            z-index: 1;
        }

        .login-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #3d405c;
            margin-bottom: 10px;
        }

        .form-label-icon {
            color: #9F66AF;
            font-size: 16px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9F66AF;
            font-size: 18px;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 50px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-sizing: border-box;
            background-color: #fafafa;
            position: relative;
        }

        .form-control:hover {
            border-color: #c9a5d5;
            background-color: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #9F66AF;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(159, 102, 175, 0.15);
        }

        .form-control:focus + .input-icon,
        .form-control:not(:placeholder-shown) + .input-icon {
            color: #9F66AF;
            transform: translateY(-50%) scale(1.1);
        }

        .form-control::placeholder {
            color: #b0b0b0;
            font-size: 14px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #b0b0b0;
            cursor: pointer;
            font-size: 18px;
            padding: 5px;
            transition: all 0.3s ease;
            z-index: 2;
            border-radius: 5px;
        }

        .password-toggle:hover {
            color: #9F66AF;
            background-color: rgba(159, 102, 175, 0.1);
        }

        .password-toggle:active {
            transform: translateY(-50%) scale(0.9);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #9F66AF 0%, #7B4A8A 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(159, 102, 175, 0.3);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(159, 102, 175, 0.5);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(159, 102, 175, 0.4);
        }

        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert i {
            font-size: 18px;
            margin-top: 1px;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fdecea 0%, #f8d7da 100%);
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert-success {
            background: linear-gradient(135deg, #e8f7ee 0%, #d4edda 100%);
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert ul li {
            margin-bottom: 4px;
        }

        .back-to-home {
            text-align: center;
            margin-top: 25px;
        }

        .back-to-home a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            opacity: 0.9;
            transition: all 0.3s ease;
            padding: 10px 20px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .back-to-home a:hover {
            opacity: 1;
            transform: translateX(-5px);
            background: rgba(255, 255, 255, 0.2);
        }

        .back-to-home a i {
            transition: transform 0.3s ease;
        }

        .back-to-home a:hover i {
            transform: translateX(-5px);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #b0b0b0;
            cursor: pointer;
            font-size: 18px;
            padding: 5px;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: #9F66AF;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, #e0e0e0, transparent);
        }

        .divider span {
            background: #fff;
            padding: 0 20px;
            color: #9F66AF;
            font-size: 13px;
            font-weight: 600;
            position: relative;
            z-index: 1;
            letter-spacing: 1px;
        }

        .info-text {
            text-align: center;
            color: #6c757d;
            font-size: 13px;
            line-height: 1.8;
        }

        .info-text p {
            margin: 5px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .info-text i {
            color: #9F66AF;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1 class="login-title">Admin Login</h1>
                <p class="login-subtitle">Masuk ke Dashboard Admin Flodemi</p>
            </div>

            <div class="login-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                @php
                    $isDeactivated = false;
                    foreach($errors->all() as $error) {
                        if (str_contains($error, 'dinonaktifkan')) {
                            $isDeactivated = true;
                            break;
                        }
                    }
                @endphp
                
                @if($isDeactivated)
                {{-- Custom Alert for Deactivated Account --}}
                <div class="alert" style="background: linear-gradient(135deg, #fff3cd 0%, #ffeeba 100%); border-left: 4px solid #ffc107; color: #856404; padding: 16px; border-radius: 12px; margin-bottom: 20px;">
                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 24px; color: #ffc107; margin-top: 2px;"></i>
                        <div>
                            <strong style="display: block; margin-bottom: 8px; font-size: 15px;">⚠️ Akun Tidak Aktif</strong>
                            @foreach($errors->all() as $error)
                                <p style="margin: 4px 0; font-size: 14px; line-height: 1.5;">{{ $error }}</p>
                            @endforeach
                            <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(133, 100, 4, 0.2);">
                                <small style="display: block; line-height: 1.4;">
                                    <i class="fas fa-info-circle"></i> <strong>Hubungi Superadmin</strong> untuk mengaktifkan kembali akun Anda.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                {{-- Default Error Alert --}}
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @endif

                <form action="{{ route('superadmin.login.post') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email">
                            Email
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email address" required autofocus value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">
                            Password
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()" title="Show/Hide Password">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Masuk ke Dashboard
                    </button>
                </form>

                <div class="info-text">
                    <p><i class="fas fa-shield-alt"></i> Hanya untuk Admin yang terdaftar</p>
                </div>
            </div>
        </div>

        <div class="back-to-home">
            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Halaman Login Utama
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
