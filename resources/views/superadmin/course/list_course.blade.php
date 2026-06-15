<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - List Course'])
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-list'])

        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Manajemen Course</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Kelola daftar kursus, pantau kuota, dan atur modul pembelajaran.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Daftar Course</span>
                    </div>
                </div>

                {{-- ══════════ COURSE TABLE ══════════ --}}
                <div class="p-6 md:p-4">
                    <div class="content-card">
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between flex-wrap gap-3">
                            <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                <i class="ri-book-open-line text-brand-purple"></i>
                                Daftar Course
                            </div>
                            <div class="flex items-center gap-2.5 flex-wrap md:w-full">
                                <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 focus-within:border-brand-purple focus-within:ring-4 focus-within:ring-brand-purple/10 focus-within:bg-white dark:focus-within:bg-[#13111c] transition-all">
                                    <i class="ri-search-line text-slate-400 text-sm"></i>
                                    <input type="text" id="searchCourse" class="border-none bg-transparent outline-none text-xs font-semibold text-slate-800 dark:text-slate-200 w-44 md:w-full placeholder-slate-400" placeholder="Cari course...">
                                </div>
                                <select id="filterCategory" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-xs font-bold text-slate-700 dark:text-slate-300 cursor-pointer focus:outline-none focus:border-brand-purple transition-all md:w-full">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ strtolower($category->nama) }}">{{ $category->nama }}</option>
                                    @endforeach
                                </select>
                                <select id="filterStatus" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-xs font-bold text-slate-700 dark:text-slate-300 cursor-pointer focus:outline-none focus:border-brand-purple transition-all md:w-full">
                                    <option value="">Semua Status</option>
                                    <option value="publish">Publish</option>
                                    <option value="draft">Draft</option>
                                </select>
                                <a href="{{ route('superadmin.course.add') }}" class="btn-brand md:w-full md:justify-center">
                                    <i class="ri-add-line"></i> Tambah Course
                                </a>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Judul Course</th>
                                        <th>Kategori</th>
                                        <th>Mentor</th>
                                        <th>Status</th>
                                        <th>Kuota</th>
                                        <th>Total Mentee</th>
                                        <th>Ketersediaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="courseTable">
                                    @forelse ($courses as $course)
                                        @php
                                            $totalMentee = $course->pendaftaran->count();
                                            $kuotaText   = $course->kuota ? $course->kuota : 'Unlimited';
                                            $kuotaVal    = $course->kuota ? $course->kuota : 'unlimited';
                                        @endphp
                                        <tr class="hover:bg-slate-50/50 dark:hover:bg-brand-purple/5 transition-colors"
                                            data-status="{{ strtolower($course->status) }}"
                                            data-category="{{ strtolower($course->kategori->nama ?? '') }}"
                                            data-title="{{ strtolower($course->judul) }}"
                                            data-mentor="{{ strtolower($course->mentor->username ?? '') }}">
                                            <td>
                                                <span class="font-bold text-slate-800 dark:text-slate-100 block max-w-[250px] truncate">{{ $course->judul }}</span>
                                            </td>
                                            <td>
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400">
                                                    <i class="ri-folder-line text-[10px]"></i>
                                                    {{ $course->kategori->nama ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-slate-500 dark:text-slate-400 font-semibold">{{ $course->mentor->username ?? '-' }}</span>
                                            </td>
                                            <td>
                                                @if(strtolower($course->status) === 'publish')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                                    <i class="ri-checkbox-blank-circle-fill text-[6px]"></i>
                                                    Publish
                                                </span>
                                                @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400">
                                                    <i class="ri-checkbox-blank-circle-fill text-[6px]"></i>
                                                    Draft
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="font-bold text-slate-700 dark:text-slate-300">{{ $kuotaText }}</span>
                                            </td>
                                            <td>
                                                <span class="font-bold text-brand-purple dark:text-purple-400">{{ $totalMentee }}</span>
                                            </td>
                                            <td class="quota-status" data-quota="{{ $kuotaVal }}" data-mentee="{{ $totalMentee }}">
                                                {{-- Rendered by JS --}}
                                            </td>
                                            <td>
                                                <div class="flex items-center gap-1.5 flex-nowrap">
                                                    <a href="{{ route('superadmin.course.edit', $course->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500/10 transition-colors" title="Edit Course">
                                                        <i class="ri-edit-line"></i> Edit
                                                    </a>

                                                    @if(strtolower($course->status) === 'draft')
                                                    <button class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-red-500/20 text-red-600 dark:text-red-400 hover:bg-red-500/10 transition-colors cursor-pointer" title="Hapus Course"
                                                        data-bs-toggle="modal" data-bs-target="#deleteCourseModal"
                                                        data-id="{{ $course->id }}"
                                                        data-judul="{{ $course->judul }}">
                                                        <i class="ri-delete-bin-line"></i> Hapus
                                                    </button>
                                                    @endif

                                                    <a href="{{ route('superadmin.course.modul', ['id' => $course->id]) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-brand-purple/20 text-brand-purple hover:bg-brand-purple/10 transition-colors" title="Cek Modul">
                                                        <i class="ri-folder-3-line"></i> Modul
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">
                                                <div class="flex flex-col items-center justify-center py-12 text-slate-400 dark:text-slate-500">
                                                    <i class="ri-inbox-line text-4xl opacity-30 mb-2"></i>
                                                    <p class="text-xs font-semibold">Belum ada data course</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if(isset($courses) && method_exists($courses, 'links'))
                        <div class="p-6 border-t border-slate-100 dark:border-slate-900 flex justify-center">
                            {{ $courses->links('pagination::tailwind') }}
                        </div>
                        @endif
                    </div>
                </div>

            </main>

            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    {{-- ══════════ DELETE COURSE MODAL ══════════ --}}
    <div id="deleteCourseModal" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity" style="display: none;">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl overflow-hidden shadow-2xl w-[90%] max-w-md transform transition-all scale-95 opacity-0 m-auto mt-20" id="deleteCourseModalContent">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                <h5 class="font-extrabold text-base text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="ri-delete-bin-line text-red-500"></i>
                    Hapus Course
                </h5>
                <button type="button" class="text-slate-400 hover:text-slate-500" id="closeDeleteModalBtn">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <div class="p-6 text-sm text-slate-500 dark:text-slate-400">
                <p class="text-xs leading-relaxed" id="deleteModalMessage">
                    Apakah Anda yakin ingin menghapus course ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-900 flex justify-end gap-2.5">
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" id="cancelDeleteModalBtn">Batal</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-red-500 text-white shadow-md shadow-red-500/15 hover:bg-red-600 hover:shadow-lg transition-all flex items-center gap-1 cursor-pointer" id="confirmDeleteCourse">
                    <i class="ri-delete-bin-line"></i> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Search & filter ──
        const searchInput = document.getElementById('searchCourse');
        const filterStatus = document.getElementById('filterStatus');
        const filterCategory = document.getElementById('filterCategory');
        const tableRows = document.querySelectorAll('#courseTable tr[data-status]');

        function filterTable() {
            const query = (searchInput?.value || '').toLowerCase();
            const status = filterStatus?.value || '';
            const category = filterCategory?.value || '';

            tableRows.forEach(row => {
                const title = (row.getAttribute('data-title') || '').toLowerCase();
                const mentor = (row.getAttribute('data-mentor') || '').toLowerCase();
                const rowStatus = row.getAttribute('data-status') || '';
                const rowCategory = row.getAttribute('data-category') || '';

                const matchSearch = title.includes(query) || mentor.includes(query);
                const matchStatus = !status || rowStatus === status;
                const matchCategory = !category || rowCategory === category;

                row.style.display = (matchSearch && matchStatus && matchCategory) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (filterStatus) filterStatus.addEventListener('change', filterTable);
        if (filterCategory) filterCategory.addEventListener('change', filterTable);

        // ── Quota Badge Rendering ──
        function renderQuotaStatus() {
            document.querySelectorAll('.quota-status').forEach(cell => {
                const quota = cell.dataset.quota;
                const mentee = parseInt(cell.dataset.mentee);

                if (quota === 'unlimited' || mentee < parseInt(quota)) {
                    cell.innerHTML = `
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                            <i class="ri-checkbox-blank-circle-fill text-[6px]"></i>
                            Tersedia
                        </span>`;
                } else {
                    cell.innerHTML = `
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400">
                            <i class="ri-checkbox-blank-circle-fill text-[6px]"></i>
                            Penuh
                        </span>`;
                }
            });
        }
        renderQuotaStatus();

        // ── Delete Modal Tailwind ──
        let selectedCourseRow = null;
        const deleteModalEl = document.getElementById('deleteCourseModal');
        const deleteModalContent = document.getElementById('deleteCourseModalContent');
        const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
        const cancelDeleteModalBtn = document.getElementById('cancelDeleteModalBtn');

        function closeDeleteModal() {
            if (!deleteModalEl) return;
            deleteModalContent.classList.remove('scale-100', 'opacity-100');
            deleteModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                deleteModalEl.classList.add('hidden');
                deleteModalEl.style.display = 'none';
                selectedCourseRow = null;
            }, 200);
        }

        function openDeleteModal(button, row) {
            if (row.dataset.status !== 'draft') {
                alert('Course harus berstatus Draft terlebih dahulu sebelum dihapus.');
                return;
            }

            selectedCourseRow = row;
            const courseName = button.getAttribute('data-judul') || 'Course ini';
            const msg = document.getElementById('deleteModalMessage');

            if (msg) {
                msg.innerHTML = `Apakah Anda yakin ingin menghapus course <strong>"${courseName}"</strong>? Tindakan ini tidak dapat dibatalkan.`;
            }

            deleteModalEl.style.display = 'flex';
            deleteModalEl.classList.remove('hidden');
            setTimeout(() => {
                deleteModalContent.classList.remove('scale-95', 'opacity-0');
                deleteModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        document.querySelectorAll('[data-bs-target="#deleteCourseModal"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                openDeleteModal(this, this.closest('tr'));
            });
        });

        if (closeDeleteModalBtn) closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
        if (cancelDeleteModalBtn) cancelDeleteModalBtn.addEventListener('click', closeDeleteModal);
        if (deleteModalEl) {
            deleteModalEl.addEventListener('click', function(e) {
                if (e.target === deleteModalEl) closeDeleteModal();
            });

            document.getElementById('confirmDeleteCourse')?.addEventListener('click', function() {
                if (!selectedCourseRow) return;

                const deleteBtn = selectedCourseRow.querySelector('.action-btn.delete') || selectedCourseRow.querySelector('[data-bs-target="#deleteCourseModal"]');
                const courseId = deleteBtn?.getAttribute('data-id');

                // If you have an actual delete endpoint, uncomment below:
                // fetch(`/superadmin/course/${courseId}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': ... } })

                selectedCourseRow.remove();
                closeDeleteModal();
            });
        }
    });
    </script>
</body>

</html>