<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Reset Password Admin — Flodemi'])
</head>

<body class="bg-slate-50 dark:bg-[#0f0e17] font-manrope transition-colors duration-300">
    <div class="flex">
        {{-- Sidebar --}}
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-admin', 'activePage' => 'manajemen-admin-list'])

        {{-- Main Content --}}
        <div class="main-wrapper w-full flex flex-col min-h-screen" id="mainWrapper">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-6 md:p-8">
                {{-- Page Header --}}
                <div class="mb-8">
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Reset Password Admin</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Reset kata sandi untuk admin <strong>{{ $admin->username }}</strong>.</p>
                    
                    {{-- Breadcrumbs --}}
                    <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 mt-3 uppercase tracking-wider">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="hover:text-brand-purple transition-colors">Dashboard</a>
                        <span class="text-slate-300">/</span>
                        <a href="{{ route('superadmin.admin.list') }}" class="hover:text-brand-purple transition-colors">Manajemen Admin</a>
                        <span class="text-slate-300">/</span>
                        <span class="text-slate-500 dark:text-slate-300">Reset Password</span>
                    </nav>
                </div>

                {{-- Form Section --}}
                <div class="w-full max-w-xl mx-auto">
                    {{-- Alert Error --}}
                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 text-xs flex items-start gap-2.5 animate-pulse-soft">
                            <i class="ri-error-warning-line text-lg mt-0.5"></i>
                            <div>
                                <strong class="font-bold">Terjadi kesalahan!</strong>
                                <ul class="list-disc list-inside mt-1 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- Alert Success --}}
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 text-green-700 text-xs flex items-start gap-2.5">
                            <i class="ri-checkbox-circle-line text-lg mt-0.5"></i>
                            <div>
                                <strong class="font-bold">Berhasil!</strong> {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-800 rounded-3xl shadow-xl overflow-hidden">
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center gap-2">
                            <i class="ri-lock-password-line text-lg text-brand-purple"></i>
                            <h3 class="text-sm font-extrabold text-slate-800 dark:text-white">Formulir Reset Password</h3>
                        </div>

                        <div class="p-6 md:p-8 text-center">
                            <div class="w-16 h-16 rounded-full bg-brand-purple-light dark:bg-brand-purple/10 flex items-center justify-center mx-auto mb-6">
                                <i class="ri-lock-line text-3xl text-brand-purple"></i>
                            </div>

                            <form action="{{ route('superadmin.dashboard.admin.resetPasswordSave', $admin->id) }}" method="POST" class="space-y-5 text-left">
                                @csrf

                                <div>
                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="new_password" class="form-input-modern pr-12"
                                            placeholder="Masukkan password baru..." minlength="8" required>
                                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-brand-purple transition-colors" onclick="togglePassword(this)">
                                            <i class="ri-eye-line text-lg"></i>
                                        </button>
                                    </div>
                                    <span class="block text-[9px] text-slate-400 mt-1.5 flex items-center gap-1">
                                        <i class="ri-information-line"></i> Minimal 8 karakter
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="new_password_confirmation" class="form-input-modern pr-12"
                                            placeholder="Ulangi password baru..." minlength="8" required>
                                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-brand-purple transition-colors" onclick="togglePassword(this)">
                                            <i class="ri-eye-line text-lg"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-3">
                                    <a href="{{ route('superadmin.admin.list') }}" 
                                        class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-bold rounded-xl transition-all flex items-center gap-1.5">
                                        <i class="ri-arrow-left-line"></i> Batal
                                    </a>
                                    <button type="submit" class="btn-brand">
                                        <i class="ri-save-line"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
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
                icon.className = 'ri-eye-off-line text-lg';
            } else {
                input.type = 'password';
                icon.className = 'ri-eye-line text-lg';
            }
        }
    </script>
</body>

</html>
