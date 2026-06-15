<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Manajemen Kategori — Flodemi'])
</head>

<body class="bg-slate-50 dark:bg-[#0f0e17] font-manrope transition-colors duration-300">
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-kategori'])

        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Manajemen Kategori</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Tambah, edit, dan hapus kategori pengelompokan course.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Kategori</span>
                    </div>
                </div>

                {{-- ══════════ CONTENT ══════════ --}}
                <div class="p-6 md:p-4">

                    {{-- Alerts --}}
                    @if (session('success'))
                        <div class="mb-5 p-4 rounded-xl border border-emerald-200 dark:border-emerald-500/20 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-start gap-3">
                            <i class="ri-check-double-line text-lg flex-shrink-0"></i>
                            <div class="text-xs font-semibold">
                                <strong class="font-bold">Berhasil!</strong> {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-5 p-4 rounded-xl border border-red-200 dark:border-red-500/20 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 flex items-start gap-3">
                            <i class="ri-error-warning-line text-lg flex-shrink-0"></i>
                            <div class="text-xs font-semibold">
                                <strong class="font-bold">Gagal!</strong> {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <div class="content-card">
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between flex-wrap gap-3">
                            <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                <i class="ri-price-tag-3-line text-brand-purple"></i>
                                Daftar Kategori
                            </div>
                            <div class="flex items-center gap-2.5 flex-wrap md:w-full">
                                <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 focus-within:border-brand-purple focus-within:ring-4 focus-within:ring-brand-purple/10 focus-within:bg-white dark:focus-within:bg-[#13111c] transition-all md:flex-1">
                                    <i class="ri-search-line text-slate-400 text-sm"></i>
                                    <input type="text" id="searchKategori" class="border-none bg-transparent outline-none text-xs font-semibold text-slate-800 dark:text-slate-200 w-44 md:w-full placeholder-slate-400" placeholder="Cari kategori...">
                                </div>
                                <button class="btn-brand md:w-full md:justify-center cursor-pointer" onclick="bukaModal('modalTambahKategori')">
                                    <i class="ri-add-line"></i> Tambah Kategori
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th class="w-20">No</th>
                                        <th>Nama Kategori</th>
                                        <th class="w-52">Jumlah Course</th>
                                        <th class="w-44">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="kategoriTable">
                                    @forelse ($categories as $category)
                                        <tr class="hover:bg-slate-50/50 dark:hover:bg-brand-purple/5 transition-colors" data-id="{{ $category->id }}">
                                            <td class="font-bold text-slate-500 dark:text-slate-400 index-cell" data-label="No">{{ $loop->iteration }}</td>
                                            <td data-label="Nama Kategori">
                                                <span class="font-bold text-slate-800 dark:text-slate-100 category-title">{{ $category->nama }}</span>
                                            </td>
                                            <td data-label="Jumlah Course">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-brand-purple-light/40 dark:bg-brand-purple/10 text-brand-purple dark:text-purple-400">
                                                    <i class="ri-book-open-line text-[10px]"></i>
                                                    {{ $category->kursus_count }} Course
                                                </span>
                                            </td>
                                            <td data-label="Aksi">
                                                <div class="flex items-center gap-1.5 flex-nowrap">
                                                    <button class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500/10 transition-colors cursor-pointer"
                                                        data-id="{{ $category->id }}"
                                                        data-nama="{{ $category->nama }}"
                                                        onclick="bukaModalEdit(this)">
                                                        <i class="ri-edit-line"></i> Edit
                                                    </button>
                                                    <button class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-red-500/20 text-red-600 dark:text-red-400 hover:bg-red-500/10 transition-colors cursor-pointer"
                                                        data-id="{{ $category->id }}"
                                                        data-nama="{{ $category->nama }}"
                                                        onclick="bukaModalHapus(this)">
                                                        <i class="ri-delete-bin-line"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="empty-row-placeholder">
                                            <td colspan="4">
                                                <div class="flex flex-col items-center justify-center py-12 text-slate-400 dark:text-slate-500">
                                                    <i class="ri-inbox-line text-4xl opacity-30 mb-2"></i>
                                                    <p class="text-xs font-semibold">Belum ada data kategori</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ MODALS ══════════ --}}

    {{-- Modal Tambah --}}
    <div id="modalTambahKategori" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-md transform transition-all scale-95 opacity-0 m-auto mt-20" id="modalTambahKategoriContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2" id="labelTambah">
                    <i class="ri-price-tag-3-line text-brand-purple text-lg"></i>
                    Tambah Kategori
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" onclick="tutupModal('modalTambahKategori')">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <form action="{{ route('superadmin.course.kategori.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Nama Kategori</label>
                        <input type="text" class="form-input-modern" id="nama" name="nama" required
                            placeholder="Contoh: Web Development" maxlength="255">
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                    <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" onclick="tutupModal('modalTambahKategori')">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-brand-purple text-white shadow-md shadow-brand-purple/15 hover:bg-brand-purple-dark hover:shadow-lg transition-all flex items-center gap-1 cursor-pointer">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="modalEditKategori" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-md transform transition-all scale-95 opacity-0 m-auto mt-20" id="modalEditKategoriContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2" id="labelEdit">
                    <i class="ri-edit-line text-brand-purple text-lg"></i>
                    Edit Kategori
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" onclick="tutupModal('modalEditKategori')">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <form id="formEditKategori" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label for="edit_nama" class="block text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Nama Kategori</label>
                        <input type="text" class="form-input-modern" id="edit_nama" name="nama" required
                            placeholder="Contoh: Web Development" maxlength="255">
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                    <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" onclick="tutupModal('modalEditKategori')">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-brand-purple text-white shadow-md shadow-brand-purple/15 hover:bg-brand-purple-dark hover:shadow-lg transition-all flex items-center gap-1 cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div id="modalHapusKategori" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-md transform transition-all scale-95 opacity-0 m-auto mt-20" id="modalHapusKategoriContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="ri-delete-bin-line text-red-500 text-lg"></i>
                    Hapus Kategori
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" onclick="tutupModal('modalHapusKategori')">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <form id="formHapusKategori" method="POST">
                @csrf
                @method('DELETE')
                <div class="p-6 text-sm text-slate-500 dark:text-slate-400 space-y-3">
                    <p class="text-xs leading-relaxed">
                        Apakah Anda yakin ingin menghapus kategori <strong id="hapus_nama" class="text-slate-800 dark:text-white font-bold"></strong>?
                    </p>
                    <p class="text-red-500 text-xs font-semibold flex items-center gap-1">
                        <i class="ri-error-warning-line"></i> Tindakan ini tidak dapat dibatalkan. Kategori hanya bisa dihapus jika tidak digunakan oleh course apa pun.
                    </p>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                    <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" onclick="tutupModal('modalHapusKategori')">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-red-500 text-white shadow-md shadow-red-500/15 hover:bg-red-600 hover:shadow-lg transition-all flex items-center gap-1 cursor-pointer">
                        Hapus Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
        const routeUpdatePattern = "{{ route('superadmin.course.kategori.update', ':id') }}";
        const routeDeletePattern = "{{ route('superadmin.course.kategori.destroy', ':id') }}";

        // ── Client-side Search Filter ──
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchKategori');
            const tableBody = document.getElementById('kategoriTable');
            const tableRows = tableBody.querySelectorAll('tr:not(.empty-row-placeholder)');
            
            let emptySearchRow = document.createElement('tr');
            emptySearchRow.className = 'empty-search-placeholder';
            emptySearchRow.style.display = 'none';
            emptySearchRow.innerHTML = `
                <td colspan="4">
                    <div class="flex flex-col items-center justify-center py-12 text-slate-400 dark:text-slate-500">
                        <i class="ri-search-2-line text-4xl opacity-30 mb-2"></i>
                        <p class="text-xs font-semibold">Kategori tidak ditemukan</p>
                    </div>
                </td>
            `;
            tableBody.appendChild(emptySearchRow);

            function filterTable() {
                const query = (searchInput?.value || '').toLowerCase().trim();
                let matchCount = 0;

                tableRows.forEach(row => {
                    const name = row.querySelector('.category-title')?.textContent.toLowerCase() || '';
                    const matchSearch = name.includes(query);
                    row.style.display = matchSearch ? '' : 'none';
                    if (matchSearch) matchCount++;
                });

                const originalEmptyPlaceholder = tableBody.querySelector('.empty-row-placeholder');
                
                if (originalEmptyPlaceholder) {
                    originalEmptyPlaceholder.style.display = '';
                    emptySearchRow.style.display = 'none';
                } else {
                    emptySearchRow.style.display = (matchCount === 0 && query !== '') ? '' : 'none';
                }
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterTable);
            }
        });

        // ── Modals Logic Tailwind ──
        function bukaModal(id) {
            const modal = document.getElementById(id);
            const content = document.getElementById(id + 'Content');
            if(!modal) return;
            modal.style.display = 'flex';
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function tutupModal(id) {
            const modal = document.getElementById(id);
            const content = document.getElementById(id + 'Content');
            if(!modal) return;
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }, 200);
        }

        function bukaModalEdit(btn) {
            const id = btn.getAttribute('data-id');
            const nama = btn.getAttribute('data-nama');
            const form = document.getElementById('formEditKategori');
            form.action = routeUpdatePattern.replace(':id', id);
            document.getElementById('edit_nama').value = nama;

            bukaModal('modalEditKategori');
        }

        function bukaModalHapus(btn) {
            const id = btn.getAttribute('data-id');
            const nama = btn.getAttribute('data-nama');
            const form = document.getElementById('formHapusKategori');
            form.action = routeDeletePattern.replace(':id', id);
            document.getElementById('hapus_nama').textContent = nama;

            bukaModal('modalHapusKategori');
        }

        // Close on outside click
        window.addEventListener('click', function(e) {
            if (e.target.id === 'modalTambahKategori') tutupModal('modalTambahKategori');
            if (e.target.id === 'modalEditKategori') tutupModal('modalEditKategori');
            if (e.target.id === 'modalHapusKategori') tutupModal('modalHapusKategori');
        });
    </script>
</body>

</html>
