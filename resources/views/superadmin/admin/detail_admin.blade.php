<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Detail Admin — Flodemi'])
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
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Detail Admin</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Informasi lengkap mengenai data Admin.</p>
                    
                    {{-- Breadcrumbs --}}
                    <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 mt-3 uppercase tracking-wider">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="hover:text-brand-purple transition-colors">Dashboard</a>
                        <span class="text-slate-300">/</span>
                        <a href="{{ route('superadmin.admin.list') }}" class="hover:text-brand-purple transition-colors">Manajemen Admin</a>
                        <span class="text-slate-300">/</span>
                        <span class="text-slate-500 dark:text-slate-300">Detail</span>
                    </nav>
                </div>

                {{-- Detail Card --}}
                <div class="w-full max-w-xl mx-auto">
                    <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-800 rounded-3xl shadow-xl overflow-hidden p-6 md:p-8">
                        {{-- Avatar & Name Section --}}
                        <div class="flex flex-col items-center text-center pb-6 border-b border-slate-100 dark:border-slate-900">
                            @if($admin->photo)
                                <img src="{{ asset('storage/' . $admin->photo) }}" class="w-28 h-28 rounded-full object-cover border-4 border-brand-purple/20 p-1" alt="{{ $admin->username }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->username) }}&background=9F66AF&color=fff&size=120"
                                    class="w-28 h-28 rounded-full object-cover border-4 border-brand-purple/20 p-1" alt="{{ $admin->username }}">
                            @endif
                            <h3 class="text-lg font-extrabold text-slate-800 dark:text-white mt-4">{{ $admin->username }}</h3>
                            <span class="text-xs font-semibold text-slate-400 mt-0.5">{{ ucfirst($admin->role) }}</span>
                        </div>

                        {{-- Details Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5 mt-6">
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Email Address</span>
                                <span class="block text-sm font-semibold text-slate-700 dark:text-slate-200 truncate">{{ $admin->email }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nomor Handphone</span>
                                <span class="block text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $admin->nomor_hp ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Role</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wide bg-brand-purple-light dark:bg-brand-purple/10 text-brand-purple">
                                    {{ $admin->role }}
                                </span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Status Akun</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wide {{ $admin->status === 'aktif' ? 'bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400' }}">
                                    {{ $admin->status === 'aktif' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                            <div class="sm:col-span-2">
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Hak Akses</span>
                                <div class="flex flex-wrap gap-1.5 mt-1">
                                    @php
                                        $permissions = $admin->getPermissionsArray();
                                    @endphp
                                    @forelse($permissions as $permission)
                                        @php
                                            $badgeClass = match($permission) {
                                                'kelola_mentor' => 'bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400',
                                                'kelola_mentee' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400',
                                                'kelola_course' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400',
                                                default => 'bg-slate-50 text-slate-600 dark:bg-slate-800 dark:text-slate-300'
                                            };
                                            $label = match($permission) {
                                                'kelola_mentor' => 'Kelola Mentor',
                                                'kelola_mentee' => 'Kelola Mentee',
                                                'kelola_course' => 'Kelola Course',
                                                default => $permission
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $badgeClass }}">
                                            {{ $label }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-slate-400">-</span>
                                    @endforelse
                                </div>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Bergabung Pada</span>
                                <span class="block text-xs font-semibold text-slate-500 dark:text-slate-300">{{ $admin->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Terakhir Diperbarui</span>
                                <span class="block text-xs font-semibold text-slate-500 dark:text-slate-300">{{ $admin->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-3">
                            <a href="{{ route('superadmin.admin.list') }}" 
                                class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-bold rounded-xl transition-all">
                                Kembali
                            </a>
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