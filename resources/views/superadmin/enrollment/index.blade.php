<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Manajemen Pendaftaran'])
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'dashboard', 'activePage' => 'manajemen-pendaftaran'])

        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Manajemen Pendaftaran</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Verifikasi pembayaran dan kelola akses kursus mentee.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Manajemen Pendaftaran</span>
                    </div>
                </div>

                {{-- ══════════ ENROLLMENT TABLE ══════════ --}}
                <div class="p-6 md:p-4">
                    <div class="content-card">
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between flex-wrap gap-3">
                            <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                <i class="ri-file-list-3-line text-brand-purple"></i>
                                Daftar Transaksi & Pendaftaran
                            </div>
                            <div class="flex items-center gap-2.5 flex-wrap md:w-full">
                                <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 focus-within:border-brand-purple focus-within:ring-4 focus-within:ring-brand-purple/10 focus-within:bg-white dark:focus-within:bg-[#13111c] transition-all">
                                    <i class="ri-search-line text-slate-400 text-sm"></i>
                                    <input type="text" id="searchEnrollment" class="border-none bg-transparent outline-none text-xs font-semibold text-slate-800 dark:text-slate-200 w-44 md:w-full placeholder-slate-400" placeholder="Cari mentee atau kursus...">
                                </div>
                                <select id="filterStatus" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-xs font-bold text-slate-700 dark:text-slate-300 cursor-pointer focus:outline-none focus:border-brand-purple transition-all md:w-full">
                                    <option value="all" {{ request('status') === null ? 'selected' : '' }}>Semua Status</option>
                                    <option value="menunggu_verifikasi" {{ request('status') === 'menunggu_verifikasi' ? 'selected' : '' }}>Butuh Verifikasi</option>
                                    <option value="menunggu_pembayaran" {{ request('status') === 'menunggu_pembayaran' ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <a href="{{ route('superadmin.enrollment.index', ['status' => 'menunggu_verifikasi']) }}" class="btn-brand justify-center md:w-full">
                                    <i class="ri-shield-check-line"></i> Butuh Verifikasi
                                </a>
                                <a href="{{ route('superadmin.enrollment.index') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-center md:w-full flex items-center justify-center gap-1.5">
                                    <i class="ri-list-check"></i> Semua
                                </a>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Mentee</th>
                                        <th>Kursus</th>
                                        <th>Status</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="enrollmentTable">
                                    @forelse($enrollments as $reg)
                                    @php
                                        $actor = $reg->pengguna;
                                        $actorName = $actor->username ?? 'User';
                                        if ($actor && isset($actor->photo) && $actor->photo) {
                                            $avatar = asset('storage/' . $actor->photo);
                                        } else {
                                            $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($actorName) . '&background=9F66AF&color=fff&size=128&font-size=0.4';
                                        }

                                        $statusMap = [
                                            'menunggu_pembayaran' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400',
                                            'menunggu_verifikasi' => 'bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400',
                                            'aktif'               => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                            'ditolak'             => 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400',
                                        ];
                                        $statusLabelMap = [
                                            'menunggu_pembayaran' => 'Belum Bayar',
                                            'menunggu_verifikasi' => 'Verifikasi',
                                            'aktif'               => 'Aktif',
                                            'ditolak'             => 'Ditolak',
                                        ];
                                        $statusClass = $statusMap[$reg->status] ?? '';
                                        $statusLabel = $statusLabelMap[$reg->status] ?? $reg->status;
                                    @endphp
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-brand-purple/5 transition-colors"
                                        data-id="{{ $reg->id }}" data-status="{{ $reg->status }}"
                                        data-name="{{ $actorName }}"
                                        data-course="{{ $reg->kursus->judul ?? '' }}">
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $avatar }}" class="w-9 h-9 rounded-xl object-cover border border-brand-purple/10" alt="{{ $actorName }}">
                                                <div>
                                                    <span class="font-bold text-slate-800 dark:text-slate-100 hover:text-brand-purple transition-colors">{{ $actorName }}</span>
                                                    <div class="text-[11px] text-slate-400 dark:text-slate-500 font-semibold">{{ $reg->pengguna->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="font-bold text-slate-850 dark:text-slate-200 block max-w-[200px] truncate">{{ $reg->kursus->judul }}</span>
                                            <span class="text-[10px] font-bold text-brand-purple block mt-0.5">Rp {{ number_format($reg->kursus->harga, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg text-[10px] font-bold {{ $statusClass }}">
                                                <i class="ri-checkbox-blank-circle-fill text-[6px]"></i>
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($reg->pembayaran && $reg->pembayaran->bukti)
                                                <a href="{{ asset('storage/' . $reg->pembayaran->bukti) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-brand-purple/20 text-brand-purple hover:bg-brand-purple/10 transition-colors">
                                                    <i class="ri-image-line"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-xs text-slate-400 dark:text-slate-500 italic">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($reg->status === 'menunggu_verifikasi')
                                                <div class="flex items-center gap-1.5 flex-nowrap">
                                                    <form action="{{ route('superadmin.enrollment.approve', $reg->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500/10 transition-colors cursor-pointer" title="Setujui Pembayaran">
                                                            <i class="ri-check-line"></i> Setujui
                                                        </button>
                                                    </form>
                                                    <button class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-red-500/20 text-red-600 dark:text-red-400 hover:bg-red-500/10 transition-colors cursor-pointer" title="Tolak Pembayaran"
                                                        data-bs-toggle="modal" data-bs-target="#rejectModal"
                                                        data-id="{{ $reg->id }}"
                                                        data-name="{{ $actorName }}"
                                                        data-course="{{ $reg->kursus->judul }}">
                                                        <i class="ri-close-line"></i> Tolak
                                                    </button>
                                                </div>
                                            @else
                                                <span class="text-xs text-slate-400 dark:text-slate-500 font-bold">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="flex flex-col items-center justify-center py-12 text-slate-400 dark:text-slate-500">
                                                <i class="ri-inbox-line text-4xl opacity-30 mb-2"></i>
                                                <p class="text-xs font-semibold">Tidak ada data pendaftaran.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if(method_exists($enrollments, 'links'))
                        <div class="p-6 border-t border-slate-100 dark:border-slate-900 flex justify-center">
                            {{ $enrollments->links('pagination::tailwind') }}
                        </div>
                        @endif
                    </div>
                </div>

            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ REJECT MODAL ══════════ --}}
    <div id="rejectModal" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-md transform transition-all scale-95 opacity-0 m-auto mt-20" id="rejectModalContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="ri-close-circle-line text-red-500 text-lg"></i>
                    Tolak Pembayaran
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" id="closeRejectModalBtn">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="p-6 text-sm text-slate-500 dark:text-slate-400 space-y-4">
                    <p class="text-xs leading-relaxed" id="rejectModalDesc">
                        Berikan alasan penolakan agar mentee dapat memperbaiki bukti pembayarannya.
                    </p>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Alasan Penolakan</label>
                        <textarea name="catatan" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-800 dark:text-slate-200 text-sm focus:outline-none focus:bg-white dark:focus:bg-[#13111c] focus:border-brand-purple focus:ring-4 focus:ring-brand-purple/10 transition-all min-h-[100px]" placeholder="Contoh: Bukti transfer tidak terbaca atau nominal kurang." required></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                    <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" id="cancelRejectModalBtn">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-red-500 text-white shadow-md shadow-red-500/15 hover:bg-red-600 hover:shadow-lg transition-all flex items-center gap-1 cursor-pointer">
                        <i class="ri-close-circle-line"></i> Konfirmasi Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Search & filter ──
        const searchInput = document.getElementById('searchEnrollment');
        const filterStatus = document.getElementById('filterStatus');
        const tableRows = document.querySelectorAll('#enrollmentTable tr[data-id]');

        function filterTable() {
            const query = (searchInput?.value || '').toLowerCase();
            const status = filterStatus?.value || 'all';

            tableRows.forEach(row => {
                const name = (row.getAttribute('data-name') || '').toLowerCase();
                const course = (row.getAttribute('data-course') || '').toLowerCase();
                const rowStatus = row.getAttribute('data-status') || '';

                const matchSearch = name.includes(query) || course.includes(query);
                const matchStatus = status === 'all' || rowStatus === status;

                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (filterStatus) filterStatus.addEventListener('change', filterTable);

        // ── Reject modal Tailwind ──
        const rejectModal = document.getElementById('rejectModal');
        const rejectModalContent = document.getElementById('rejectModalContent');

        function hideRejectModal() {
            if (!rejectModal) return;
            rejectModalContent.classList.remove('scale-100', 'opacity-100');
            rejectModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                rejectModal.classList.add('hidden');
                rejectModal.style.display = 'none';
            }, 200);
        }

        document.querySelectorAll('[data-bs-target="#rejectModal"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const course = this.getAttribute('data-course');

                const desc = document.getElementById('rejectModalDesc');
                if (desc) {
                    desc.innerHTML = `Tolak pembayaran dari <strong>"${name}"</strong> untuk kursus <strong>"${course}"</strong>. Berikan alasan agar mentee dapat memperbaiki bukti pembayarannya.`;
                }

                const form = document.getElementById('rejectForm');
                form.action = `/superadmin/enrollment/${id}/reject`;

                rejectModal.style.display = 'flex';
                rejectModal.classList.remove('hidden');
                setTimeout(() => {
                    rejectModalContent.classList.remove('scale-95', 'opacity-0');
                    rejectModalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            });
        });

        document.getElementById('closeRejectModalBtn')?.addEventListener('click', hideRejectModal);
        document.getElementById('cancelRejectModalBtn')?.addEventListener('click', hideRejectModal);
        if (rejectModal) {
            rejectModal.addEventListener('click', function(e) {
                if (e.target === rejectModal) hideRejectModal();
            });
        }
    });
    </script>
</body>

</html>