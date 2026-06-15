<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Tambah Admin — Flodemi'])
</head>

<body class="bg-slate-50 dark:bg-[#0f0e17] font-manrope transition-colors duration-300">
    <div class="flex">
        {{-- Sidebar --}}
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-admin', 'activePage' => 'manajemen-admin-tambah'])

        {{-- Main Content --}}
        <div class="main-wrapper w-full flex flex-col min-h-screen" id="mainWrapper">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-6 md:p-8">
                {{-- Page Header --}}
                <div class="mb-8">
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Tambah Admin Baru</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Lengkapi formulir berikut untuk menambahkan admin baru ke dalam sistem.</p>
                    
                    {{-- Breadcrumbs --}}
                    <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 mt-3 uppercase tracking-wider">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="hover:text-brand-purple transition-colors">Dashboard</a>
                        <span class="text-slate-300">/</span>
                        <a href="{{ route('superadmin.admin.list') }}" class="hover:text-brand-purple transition-colors">Manajemen Admin</a>
                        <span class="text-slate-300">/</span>
                        <span class="text-slate-500 dark:text-slate-300">Tambah Admin</span>
                    </nav>
                </div>

                {{-- Form Section --}}
                <div class="w-full max-w-3xl mx-auto">
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
                            <i class="ri-user-add-line text-lg text-brand-purple"></i>
                            <h3 class="text-sm font-extrabold text-slate-800 dark:text-white">Formulir Admin Baru</h3>
                        </div>

                        <div class="p-6 md:p-8">
                            <form action="{{ route('superadmin.admin.store') }}" method="POST" class="space-y-6">
                                @csrf

                                {{-- Informasi Akun --}}
                                <div>
                                    <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-900 text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">
                                        <i class="ri-shield-user-line"></i>
                                        Informasi Akun
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                            <input type="text" name="username" class="form-input-modern"
                                                placeholder="Masukkan nama lengkap..." value="{{ old('username') }}" required>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Email Address</label>
                                                <input type="email" name="email" class="form-input-modern"
                                                    placeholder="contoh@email.com" value="{{ old('email') }}" required>
                                            </div>

                                            <div>
                                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Nomor Handphone</label>
                                                <input type="tel" name="nomor_hp" class="form-input-modern"
                                                    placeholder="08xxxxxxxxxx" value="{{ old('nomor_hp') }}"
                                                    inputmode="numeric" pattern="[0-9]*" maxlength="13"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Password</label>
                                                <input type="password" name="password" class="form-input-modern"
                                                    placeholder="Minimal 8 karakter" required>
                                                <span class="block text-[9px] text-slate-400 mt-1.5 flex items-center gap-1">
                                                    <i class="ri-lock-line"></i> Harus memiliki minimal 8 karakter
                                                </span>
                                            </div>

                                            <div>
                                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Status Akun</label>
                                                <select name="status" class="form-input-modern" required>
                                                    <option value="">Pilih status...</option>
                                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Role & Hak Akses --}}
                                <div class="pt-2">
                                    <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-900 text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">
                                        <i class="ri-key-2-line"></i>
                                        Role & Hak Akses
                                    </div>

                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Role</label>
                                                <select name="role" class="form-input-modern" required>
                                                    <option value="">Pilih role...</option>
                                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">Hak Akses</label>
                                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-4 bg-slate-50/50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800/80 rounded-2xl">
                                                <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-slate-600 dark:text-slate-400 hover:text-brand-purple transition-colors">
                                                    <input class="w-4 h-4 rounded border-slate-300 dark:border-slate-800 text-brand-purple focus:ring-brand-purple/20" type="checkbox"
                                                        name="permissions[]" value="kelola_mentor"
                                                        {{ in_array('kelola_mentor', old('permissions', [])) ? 'checked' : '' }}>
                                                    <span><i class="ri-user-star-line mr-1"></i> Kelola Mentor</span>
                                                </label>

                                                <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-slate-600 dark:text-slate-400 hover:text-brand-purple transition-colors">
                                                    <input class="w-4 h-4 rounded border-slate-300 dark:border-slate-800 text-brand-purple focus:ring-brand-purple/20" type="checkbox"
                                                        name="permissions[]" value="kelola_mentee"
                                                        {{ in_array('kelola_mentee', old('permissions', [])) ? 'checked' : '' }}>
                                                    <span><i class="ri-team-line mr-1"></i> Kelola Mentee</span>
                                                </label>

                                                <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-slate-600 dark:text-slate-400 hover:text-brand-purple transition-colors">
                                                    <input class="w-4 h-4 rounded border-slate-300 dark:border-slate-800 text-brand-purple focus:ring-brand-purple/20" type="checkbox"
                                                        name="permissions[]" value="kelola_course"
                                                        {{ in_array('kelola_course', old('permissions', [])) ? 'checked' : '' }}>
                                                    <span><i class="ri-book-open-line mr-1"></i> Kelola Course</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-3">
                                    <a href="{{ route('superadmin.admin.list') }}" 
                                        class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-bold rounded-xl transition-all flex items-center gap-1.5">
                                        <i class="ri-arrow-left-line"></i> Batal
                                    </a>
                                    <button type="submit" class="btn-brand">
                                        <i class="ri-save-line"></i> Simpan Admin
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
</body>

</html>