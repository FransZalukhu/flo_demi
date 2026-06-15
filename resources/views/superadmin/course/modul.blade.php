<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Modul Course'])
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-modul'])

        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Manajemen Modul</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Tambah, edit, dan kelola modul pembelajaran pada setiap kursus.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('superadmin.course.list') }}" class="text-brand-purple hover:underline">Manajemen Course</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Modul</span>
                    </div>
                </div>

                {{-- ══════════ CONTENT ══════════ --}}
                <div class="p-6 md:p-4">

                    {{-- Alerts --}}
                    @if (session('success'))
                    <div class="alert-modern flex items-start gap-3 p-4 rounded-xl text-sm font-semibold mb-5 bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-500/25">
                        <i class="ri-check-double-line text-lg"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert-modern flex items-start gap-3 p-4 rounded-xl text-sm font-semibold mb-5 bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-500/25">
                        <i class="ri-error-warning-line text-lg"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    @endif

                    <div class="content-card">
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between flex-wrap gap-3">
                            <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                <i class="ri-folder-3-line text-brand-purple"></i>
                                Daftar Modul
                            </div>
                            <div class="flex items-center gap-2.5 flex-wrap md:w-full">
                                <form method="GET" action="{{ route('superadmin.course.modul') }}" class="flex items-center gap-2.5 flex-wrap md:w-full">
                                    <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 focus-within:border-brand-purple focus-within:ring-4 focus-within:ring-brand-purple/10 focus-within:bg-white dark:focus-within:bg-[#13111c] transition-all">
                                        <i class="ri-search-line text-slate-400 text-sm"></i>
                                        <input type="text" name="search" class="border-none bg-transparent outline-none text-xs font-semibold text-slate-800 dark:text-slate-200 w-44 md:w-full placeholder-slate-400" placeholder="Cari modul..." value="{{ request('search') }}">
                                    </div>
                                    <select name="kursus_id" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-xs font-bold text-slate-700 dark:text-slate-300 cursor-pointer focus:outline-none focus:border-brand-purple transition-all md:w-full" onchange="this.form.submit()">
                                        <option value="">Semua Kursus</option>
                                        @foreach ($kursusAll as $k)
                                            <option value="{{ $k->id }}" {{ request('kursus_id') == $k->id ? 'selected' : '' }}>
                                                {{ $k->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (request('search') || request('kursus_id'))
                                    <a href="{{ route('superadmin.course.modul') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors flex items-center gap-1 md:w-full md:justify-center">
                                        <i class="ri-refresh-line"></i> Reset
                                    </a>
                                    @endif
                                </form>
                                <button class="btn-brand md:w-full md:justify-center cursor-pointer" onclick="bukaModalTambah()">
                                    <i class="ri-add-line"></i> Tambah Modul
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kursus</th>
                                        <th>Judul Modul</th>
                                        <th>Urutan</th>
                                        <th>File PDF</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($moduls as $index => $modul)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-brand-purple/5 transition-colors">
                                        <td class="font-bold text-slate-400 dark:text-slate-500">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400">
                                                <i class="ri-book-open-line text-[10px]"></i>
                                                {{ $modul->kursus->judul ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="font-bold text-slate-850 dark:text-slate-200">{{ $modul->judul }}</span>
                                        </td>
                                        <td>
                                            <span class="font-bold text-brand-purple dark:text-purple-400">{{ $modul->urutan }}</span>
                                        </td>
                                        <td>
                                            @if ($modul->file)
                                                <a href="{{ asset('storage/' . $modul->file) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-brand-purple/20 text-brand-purple hover:bg-brand-purple/10 transition-colors">
                                                    <i class="ri-file-pdf-2-line"></i> Lihat PDF
                                                </a>
                                            @else
                                                <span class="text-xs text-slate-400 dark:text-slate-500 italic">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-1.5 flex-nowrap">
                                                <button class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500/10 transition-colors cursor-pointer" onclick="bukaModalEdit(
                                                    {{ $modul->id }},
                                                    {{ $modul->kursus_id }},
                                                    '{{ addslashes($modul->judul) }}',
                                                    {{ $modul->urutan }}
                                                )">
                                                    <i class="ri-edit-line"></i> Edit
                                                </button>
                                                <button class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-red-500/20 text-red-600 dark:text-red-400 hover:bg-red-500/10 transition-colors cursor-pointer" onclick="bukaModalHapus({{ $modul->id }}, '{{ addslashes($modul->judul) }}')">
                                                    <i class="ri-delete-bin-line"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="flex flex-col items-center justify-center py-12 text-slate-400 dark:text-slate-500">
                                                <i class="ri-inbox-line text-4xl opacity-30 mb-2"></i>
                                                <p class="text-xs font-semibold">Tidak ada data modul ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if(method_exists($moduls, 'links'))
                        <div class="p-6 border-t border-slate-100 dark:border-slate-900 flex justify-center">
                            {{ $moduls->links('pagination::tailwind') }}
                        </div>
                        @endif
                    </div>

                </div>

            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ MODAL TAMBAH MODUL ══════════ --}}
    <div id="modalTambahModul" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-lg transform transition-all scale-95 opacity-0 m-auto mt-10" id="modalTambahModulContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2" id="labelTambah">
                    <i class="ri-add-circle-line text-brand-purple text-lg"></i>
                    Tambah Modul
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" onclick="tutupModal('modalTambahModul')">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <form action="{{ route('superadmin.course.modul.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="p-6 text-sm text-slate-500 dark:text-slate-400 space-y-4 max-h-[60vh] overflow-y-auto">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Kursus <span class="text-red-500">*</span></label>
                        <select name="kursus_id" class="form-input-modern cursor-pointer" required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach ($kursusAll as $k)
                                <option value="{{ $k->id }}" {{ old('kursus_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Judul Modul <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" class="form-input-modern" placeholder="Contoh: Pengenalan UI/UX" value="{{ old('judul') }}" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Urutan <span class="text-red-500">*</span></label>
                        <input type="number" name="urutan" class="form-input-modern" min="1" placeholder="1" value="{{ old('urutan') }}" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">File PDF <span class="text-red-500">*</span></label>
                        <input type="file" name="file" class="form-input-modern" accept=".pdf" required>
                        <div class="text-[10px] text-slate-400 dark:text-slate-500 mt-1.5">Format: PDF. Maksimal 20MB.</div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                    <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" onclick="tutupModal('modalTambahModul')">Batal</button>
                    <button type="submit" class="btn-brand justify-center cursor-pointer">
                        <i class="ri-save-line"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══════════ MODAL EDIT MODUL ══════════ --}}
    <div id="modalEditModul" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-lg transform transition-all scale-95 opacity-0 m-auto mt-10" id="modalEditModulContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2" id="labelEdit">
                    <i class="ri-edit-line text-emerald-550 text-lg"></i>
                    Edit Modul
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" onclick="tutupModal('modalEditModul')">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 text-sm text-slate-500 dark:text-slate-400 space-y-4 max-h-[60vh] overflow-y-auto">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Kursus <span class="text-red-500">*</span></label>
                        <select name="kursus_id" id="edit_kursus_id" class="form-input-modern cursor-pointer" required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach ($kursusAll as $k)
                                <option value="{{ $k->id }}">{{ $k->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Judul Modul <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="edit_judul" class="form-input-modern" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Urutan <span class="text-red-500">*</span></label>
                        <input type="number" name="urutan" id="edit_urutan" class="form-input-modern" min="1" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Ganti File PDF</label>
                        <input type="file" name="file" class="form-input-modern" accept=".pdf">
                        <div class="text-[10px] text-slate-400 dark:text-slate-500 mt-1.5">Kosongkan jika tidak ingin mengganti file. Format: PDF. Maksimal 20MB.</div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                    <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" onclick="tutupModal('modalEditModul')">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-emerald-500 text-white shadow-md shadow-emerald-500/15 hover:bg-emerald-600 hover:shadow-lg transition-all flex items-center gap-1 cursor-pointer">
                        <i class="ri-save-line"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══════════ MODAL HAPUS MODUL ══════════ --}}
    <div id="modalHapusModul" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-md transform transition-all scale-95 opacity-0 m-auto mt-20" id="modalHapusModulContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="ri-delete-bin-line text-red-500 text-lg"></i>
                    Hapus Modul
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" onclick="tutupModal('modalHapusModul')">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <form id="formHapus" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="p-6 text-sm text-slate-500 dark:text-slate-400 space-y-4">
                    <p class="text-xs leading-relaxed">Apakah Anda yakin ingin menghapus modul:</p>
                    <p class="font-extrabold text-sm text-slate-800 dark:text-white" id="namaModulHapus"></p>
                    <p class="text-[10px] text-red-500 flex items-center gap-1.5">
                        <i class="ri-error-warning-line"></i> File PDF yang terkait juga akan ikut dihapus.
                    </p>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                    <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" onclick="tutupModal('modalHapusModul')">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-red-500 text-white shadow-md shadow-red-500/15 hover:bg-red-600 hover:shadow-lg transition-all flex items-center gap-1 cursor-pointer">
                        <i class="ri-delete-bin-line"></i> Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
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

        function bukaModalTambah() {
            bukaModal('modalTambahModul');
        }

        function bukaModalEdit(id, kursusId, judul, urutan) {
            document.getElementById('formEdit').action = '/superadmin/course/modul/' + id + '/update';
            document.getElementById('edit_kursus_id').value = kursusId;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_urutan').value = urutan;
            bukaModal('modalEditModul');
        }

        // Add support for addslashes/escape for JS
        function bukaModalHapus(id, judul) {
            document.getElementById('formHapus').action = '/superadmin/course/modul/' + id + '/hapus';
            document.getElementById('namaModulHapus').textContent = '"' + judul + '"';
            bukaModal('modalHapusModul');
        }

        // Close on outside click
        window.addEventListener('click', function(e) {
            if (e.target.id === 'modalTambahModul') tutupModal('modalTambahModul');
            if (e.target.id === 'modalEditModul') tutupModal('modalEditModul');
            if (e.target.id === 'modalHapusModul') tutupModal('modalHapusModul');
        });

        // Auto-hide alerts
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