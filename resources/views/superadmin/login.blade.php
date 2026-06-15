<!doctype html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Superadmin — Flodemi</title>
    <meta name="description" content="Login Superadmin Flodemi">
    <link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">

    {{-- Google Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="h-full bg-gradient-to-br from-brand-purple-dark via-brand-purple to-purple-400 flex flex-col items-center justify-center p-4 font-manrope">

    <div class="w-full max-w-md my-auto">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-white/20 transition-all duration-300">
            {{-- Header --}}
            <div class="bg-gradient-to-br from-brand-purple-dark to-brand-purple px-8 py-10 text-center text-white relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-white/8 rounded-full blur-xl"></div>
                
                <div class="w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/20 backdrop-blur-md">
                    <i class="ri-shield-keyhole-line text-3xl"></i>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tight">Admin Portal</h1>
                <p class="text-xs text-purple-100/80 mt-1">Masuk ke Dashboard Admin Flodemi</p>
            </div>

            {{-- Form Body --}}
            <div class="p-8">
                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 text-xs flex items-start gap-2.5">
                        <i class="ri-error-warning-line text-base mt-0.5"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 text-green-700 text-xs flex items-start gap-2.5">
                        <i class="ri-checkbox-circle-line text-base mt-0.5"></i>
                        <span>{{ session('success') }}</span>
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
                        <div class="mb-6 p-4 rounded-xl bg-amber-50 border-l-4 border-amber-500 text-amber-900 text-xs">
                            <div class="flex items-start gap-2.5">
                                <i class="ri-alert-line text-lg text-amber-500 mt-0.5"></i>
                                <div>
                                    <strong class="block font-bold mb-1 text-sm">Akun Tidak Aktif</strong>
                                    @foreach($errors->all() as $error)
                                        <p class="leading-relaxed">{{ $error }}</p>
                                    @endforeach
                                    <div class="mt-3 pt-3 border-t border-amber-900/10">
                                        <span class="block text-[10px] opacity-80">
                                            <i class="ri-information-line"></i> Hubungi Superadmin untuk aktivasi akun.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 text-xs">
                            <div class="flex items-start gap-2.5">
                                <i class="ri-error-warning-line text-base mt-0.5"></i>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif

                <form action="{{ route('superadmin.login.post') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2" for="email">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="ri-mail-line text-lg"></i>
                            </div>
                            <input type="email" name="email" id="email" 
                                class="block w-full pl-11 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 focus:outline-none focus:bg-white focus:border-brand-purple focus:ring-4 focus:ring-brand-purple/10 transition-all" 
                                placeholder="name@email.com" required autofocus value="{{ old('email') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2" for="password">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="ri-lock-2-line text-lg"></i>
                            </div>
                            <input type="password" name="password" id="password" 
                                class="block w-full pl-11 pr-12 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 focus:outline-none focus:bg-white focus:border-brand-purple focus:ring-4 focus:ring-brand-purple/10 transition-all" 
                                placeholder="••••••••" required>
                            <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-brand-purple transition-colors" onclick="togglePassword()">
                                <i class="ri-eye-line text-lg" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full py-3.5 bg-gradient-to-r from-brand-purple-dark to-brand-purple text-white text-sm font-bold rounded-xl shadow-lg shadow-brand-purple/20 hover:shadow-xl hover:shadow-brand-purple/30 hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2">
                        <i class="ri-login-box-line"></i> Masuk ke Dashboard
                    </button>
                </form>

                <div class="mt-8 text-center border-t border-slate-100 pt-6">
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                        <i class="ri-shield-check-line"></i> Hanya untuk personel terdaftar
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" 
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-xl transition-all hover:-translate-x-1">
                <i class="ri-arrow-left-line"></i> Kembali ke Login Utama
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('ri-eye-line', 'ri-eye-off-line');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('ri-eye-off-line', 'ri-eye-line');
            }
        }
    </script>
</body>

</html>
