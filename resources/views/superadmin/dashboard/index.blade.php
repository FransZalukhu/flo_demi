<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard — Flodemi'])
</head>

<body class="bg-slate-50 dark:bg-[#0f0e17] font-manrope transition-colors duration-300">
    <div class="flex">
        {{-- Sidebar --}}
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'dashboard', 'activePage' => 'dashboard-home'])

        {{-- Main Content --}}
        <div class="main-wrapper w-full flex flex-col min-h-screen" id="mainWrapper">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-6 md:p-8">
                {{-- Page Header --}}
                <div class="mb-8">
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">
                        Hallo, <span class="text-brand-purple">Superadmin</span>!
                    </h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Dashboard terpusat untuk memantau performa sistem, mengelola data inti, serta menganalisis laporan.</p>
                    
                    {{-- Breadcrumbs --}}
                    <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 mt-3 uppercase tracking-wider">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="hover:text-brand-purple transition-colors">Dashboard</a>
                        <span class="text-slate-300">/</span>
                        <span class="text-slate-500 dark:text-slate-300">Superadmin Dashboard</span>
                    </nav>
                </div>

                {{-- Metric Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    {{-- Total Admin --}}
                    <div class="metric-card flex flex-col justify-between">
                        <div class="p-6">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg bg-purple-50 text-brand-purple dark:bg-brand-purple/10 dark:text-brand-purple mb-4">
                                <i class="ri-shield-star-line"></i>
                            </div>
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Admin</span>
                            <div class="flex items-end justify-between">
                                <span class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">{{ $totalAdmin }}</span>
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-md text-[10px] font-bold {{ $adminGrowth >= 0 ? 'bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400' }}">
                                    <i class="ri-arrow-{{ $adminGrowth >= 0 ? 'up' : 'down' }}-line"></i>
                                    {{ abs($adminGrowth) }}%
                                </span>
                            </div>
                        </div>
                        <div class="px-6 py-2.5 h-16 bg-slate-50/30 dark:bg-slate-900/10">
                            <canvas id="sparkline-income" class="w-full h-full"></canvas>
                        </div>
                        <div class="p-4 border-t border-slate-100 dark:border-slate-900 text-center">
                            <a href="{{ route('superadmin.admin.list') }}" class="text-[10px] font-bold text-brand-purple hover:underline inline-flex items-center gap-1">
                                Lihat Detail <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Total Course --}}
                    <div class="metric-card flex flex-col justify-between">
                        <div class="p-6">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400 mb-4">
                                <i class="ri-book-open-line"></i>
                            </div>
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Course</span>
                            <div class="flex items-end justify-between">
                                <span class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">{{ $totalCourse }}</span>
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-md text-[10px] font-bold {{ $courseGrowth >= 0 ? 'bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400' }}">
                                    <i class="ri-arrow-{{ $courseGrowth >= 0 ? 'up' : 'down' }}-line"></i>
                                    {{ abs($courseGrowth) }}%
                                </span>
                            </div>
                        </div>
                        <div class="px-6 py-2.5 h-16 bg-slate-50/30 dark:bg-slate-900/10">
                            <canvas id="sparkline-cash" class="w-full h-full"></canvas>
                        </div>
                        <div class="p-4 border-t border-slate-100 dark:border-slate-900 text-center">
                            <a href="{{ route('superadmin.course.list') }}" class="text-[10px] font-bold text-brand-purple hover:underline inline-flex items-center gap-1">
                                Lihat Detail <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Total Mentee --}}
                    <div class="metric-card flex flex-col justify-between">
                        <div class="p-6">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400 mb-4">
                                <i class="ri-team-line"></i>
                            </div>
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Mentee</span>
                            <div class="flex items-end justify-between">
                                <span class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">{{ $totalMentee }}</span>
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-md text-[10px] font-bold {{ $menteeGrowth >= 0 ? 'bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400' }}">
                                    <i class="ri-arrow-{{ $menteeGrowth >= 0 ? 'up' : 'down' }}-line"></i>
                                    {{ abs($menteeGrowth) }}%
                                </span>
                            </div>
                        </div>
                        <div class="px-6 py-2.5 h-16 bg-slate-50/30 dark:bg-slate-900/10">
                            <canvas id="sparkline-profit" class="w-full h-full"></canvas>
                        </div>
                        <div class="p-4 border-t border-slate-100 dark:border-slate-900 text-center">
                            <a href="{{ route('superadmin.mentee.list') }}" class="text-[10px] font-bold text-brand-purple hover:underline inline-flex items-center gap-1">
                                Lihat Detail <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Admin Table Card --}}
                <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-800 rounded-3xl shadow-xl overflow-hidden">
                    {{-- Toolbar --}}
                    <div class="p-6 border-b border-slate-100 dark:border-slate-900 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <i class="ri-shield-star-line text-lg text-brand-purple"></i>
                            <h3 class="text-sm font-extrabold text-slate-800 dark:text-white">Daftar Admin</h3>
                        </div>
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <div class="relative">
                                <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="text" id="searchAdmin" placeholder="Cari admin..." 
                                    class="w-full sm:w-64 pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-xs placeholder-slate-400 focus:outline-none focus:bg-white focus:border-brand-purple focus:ring-4 focus:ring-brand-purple/10 dark:bg-slate-900/50 dark:border-slate-800 dark:text-slate-200 dark:focus:bg-[#13111c] transition-all">
                            </div>
                            <select id="filterStatus" class="form-input-modern !py-2 !w-full sm:!w-auto text-xs">
                                <option value="all">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                            @if(auth()->user()->role === 'superadmin')
                                <a href="{{ route('superadmin.admin.add') }}" class="btn-brand justify-center">
                                    <i class="ri-add-line"></i> Tambah Admin
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="table-modern w-full">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    @if(auth()->user()->role === 'superadmin')
                                        <th class="text-right">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="adminTable">
                                @forelse($admins as $admin)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/10 transition-colors" data-id="{{ $admin->id }}" data-status="{{ $admin->status ?? 'aktif' }}">
                                        <td>
                                            <div class="flex items-center gap-3 px-6 py-4">
                                                @if($admin->photo)
                                                    <img src="{{ asset('storage/' . $admin->photo) }}" class="w-8 h-8 rounded-lg object-cover" alt="{{ $admin->username }}">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->username) }}&background=9F66AF&color=fff&size=128&font-size=0.4" class="w-8 h-8 rounded-lg object-cover" alt="{{ $admin->username }}">
                                                @endif
                                                <a href="{{ route('superadmin.admin.show', $admin->id) }}" class="admin-name text-xs font-bold text-slate-800 dark:text-white hover:text-brand-purple transition-colors">{{ $admin->username }}</a>
                                            </div>
                                        </td>
                                        <td class="email-cell px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400">{{ $admin->email }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-wide bg-brand-purple-light dark:bg-brand-purple/10 text-brand-purple">
                                                <i class="ri-shield-star-line text-[9px]"></i> {{ ucfirst($admin->role) }}
                                            </span>
                                        </td>
                                        <td class="status-cell px-6 py-4">
                                            <span class="badge-status {{ ($admin->status ?? 'aktif') === 'aktif' ? 'aktif' : 'ditolak' }}">
                                                <i class="ri-checkbox-blank-circle-fill text-[6px] mr-1"></i>
                                                {{ ($admin->status ?? 'aktif') === 'aktif' ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        @if(auth()->user()->role === 'superadmin')
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('superadmin.admin.edit', $admin->id) }}" class="px-3 py-1.5 bg-slate-100 hover:bg-brand-purple-light hover:text-brand-purple dark:bg-slate-850 dark:hover:bg-brand-purple/10 text-slate-600 dark:text-slate-400 text-[10px] font-bold rounded-lg transition-colors flex items-center gap-1" title="Edit Admin">
                                                        <i class="ri-edit-line"></i> Edit
                                                    </a>

                                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-red-50 dark:bg-slate-850 dark:hover:bg-red-500/10 hover:text-red-500 text-slate-600 dark:text-slate-400 text-[10px] font-bold rounded-lg transition-colors flex items-center gap-1 toggle-status"
                                                        data-bs-toggle="modal" data-bs-target="#statusModal"
                                                        data-id="{{ $admin->id }}"
                                                        data-name="{{ $admin->username }}"
                                                        data-action="{{ ($admin->status ?? 'aktif') === 'aktif' ? 'nonaktif' : 'aktif' }}"
                                                        title="{{ ($admin->status ?? 'aktif') === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                        <i class="ri-{{ ($admin->status ?? 'aktif') === 'aktif' ? 'user-unfollow' : 'user-follow' }}-line"></i>
                                                        <span>{{ ($admin->status ?? 'aktif') === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}</span>
                                                    </button>

                                                    <a href="{{ route('superadmin.dashboard.admin.resetPasswordPage', $admin->id) }}" class="px-3 py-1.5 bg-slate-100 hover:bg-brand-purple-light hover:text-brand-purple dark:bg-slate-850 dark:hover:bg-brand-purple/10 text-slate-600 dark:text-slate-400 text-[10px] font-bold rounded-lg transition-colors flex items-center gap-1" title="Reset Password">
                                                        <i class="ri-key-line"></i> Reset
                                                    </a>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->role === 'superadmin' ? 5 : 4 }}" class="py-10 text-center text-slate-400 dark:text-slate-600">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <i class="ri-inbox-line text-3xl"></i>
                                                <p class="text-xs font-semibold">Belum ada data admin</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($admins->hasPages())
                        <div class="p-6 border-t border-slate-100 dark:border-slate-900 flex justify-between items-center text-xs">
                            {{ $admins->links() }}
                        </div>
                    @endif
                </div>
            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- Status Toggle Modal (Tailwind Native) --}}
    <div id="statusModal" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-800 rounded-3xl shadow-2xl overflow-hidden p-6 w-[90%] max-w-md transform transition-all scale-95 opacity-0 m-auto mt-20" id="statusModalContent">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-900">
                <h5 class="text-sm font-extrabold text-slate-800 dark:text-white flex items-center gap-2" id="modalTitle">
                    <i class="ri-user-settings-line text-brand-purple text-lg"></i>
                    Ubah Status Admin
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" id="closeModalBtn">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <div class="py-5">
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed" id="modalMessage"></p>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-900">
                <button type="button" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition-colors" id="cancelModalBtn">Batal</button>
                <button type="button" class="px-5 py-2.5 text-white text-xs font-bold rounded-xl shadow-lg transition-colors" id="confirmAction">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    @php
        $adminChartDataJson = json_encode($adminChartData ?? []);
        $courseChartDataJson = json_encode($courseChartData ?? []);
        $menteeChartDataJson = json_encode($menteeChartData ?? []);
        $adminGrowthValue = $adminGrowth ?? 0;
        $courseGrowthValue = $courseGrowth ?? 0;
        $menteeGrowthValue = $menteeGrowth ?? 0;
    @endphp

    <script>
        window.dashboardChartData = {
            admin: {{ $adminChartDataJson }},
            mentor: {{ $courseChartDataJson }},
            mentee: {{ $menteeChartDataJson }}
        };
        window.adminGrowth = {{ $adminGrowthValue }};
        window.mentorGrowth = {{ $courseGrowthValue }};
        window.menteeGrowth = {{ $menteeGrowthValue }};
    </script>

    @vite(['resources/js/superadmin/pages/dashboard.js'])

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchAdmin');
        const filterStatus = document.getElementById('filterStatus');
        const tableRows = document.querySelectorAll('#adminTable tr[data-id]');

        function filterTable() {
            const query = (searchInput?.value || '').toLowerCase();
            const status = filterStatus?.value || 'all';

            tableRows.forEach(row => {
                const name = row.querySelector('.admin-name')?.textContent.toLowerCase() || '';
                const email = row.querySelector('.email-cell')?.textContent.toLowerCase() || '';
                const rowStatus = row.getAttribute('data-status') || 'aktif';

                const matchSearch = name.includes(query) || email.includes(query);
                const matchStatus = status === 'all' || rowStatus === status;

                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (filterStatus) filterStatus.addEventListener('change', filterTable);

        // Status modal native implementation
        const statusModal = document.getElementById('statusModal');
        const statusModalContent = document.getElementById('statusModalContent');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        function openStatusModal(id, name, action) {
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const confirmBtn = document.getElementById('confirmAction');

            if (action === 'nonaktif') {
                modalTitle.innerHTML = '<i class="ri-user-unfollow-line text-red-500 text-lg"></i> Nonaktifkan Admin';
                modalMessage.innerHTML = `Apakah Anda yakin ingin menonaktifkan admin <strong>"${name}"</strong>?`;
                confirmBtn.className = 'px-5 py-2.5 bg-red-500 hover:bg-red-650 text-white text-xs font-bold rounded-xl shadow-lg shadow-red-500/20 transition-colors';
                confirmBtn.innerHTML = '<i class="ri-user-unfollow-line mr-1 text-base"></i> Ya, Nonaktifkan';
            } else {
                modalTitle.innerHTML = '<i class="ri-user-follow-line text-emerald-500 text-lg"></i> Aktifkan Admin';
                modalMessage.innerHTML = `Apakah Anda yakin ingin mengaktifkan kembali admin <strong>"${name}"</strong>?`;
                confirmBtn.className = 'px-5 py-2.5 bg-emerald-500 hover:bg-emerald-650 text-white text-xs font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-colors';
                confirmBtn.innerHTML = '<i class="ri-user-follow-line mr-1 text-base"></i> Ya, Aktifkan';
            }

            confirmBtn.onclick = function() {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('/superadmin/admin') }}/${id}/status`;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')}">
                    <input type="hidden" name="status" value="${action}">
                    <input type="hidden" name="_method" value="PATCH">
                `;
                document.body.appendChild(form);
                form.submit();
            };

            statusModal.style.display = 'flex';
            statusModal.classList.remove('hidden');
            setTimeout(() => {
                statusModalContent.classList.remove('scale-95', 'opacity-0');
                statusModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeStatusModalFunc() {
            statusModalContent.classList.remove('scale-100', 'opacity-100');
            statusModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                statusModal.classList.add('hidden');
                statusModal.style.display = 'none';
            }, 200);
        }

        if (closeModalBtn) closeModalBtn.addEventListener('click', closeStatusModalFunc);
        if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeStatusModalFunc);
        if (statusModal) {
            statusModal.addEventListener('click', function(e) {
                if (e.target === statusModal) closeStatusModalFunc();
            });
        }

        document.querySelectorAll('[data-bs-target="#statusModal"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                openStatusModal(
                    this.getAttribute('data-id'),
                    this.getAttribute('data-name'),
                    this.getAttribute('data-action')
                );
            });
        });
    });
    </script>
</body>

</html>