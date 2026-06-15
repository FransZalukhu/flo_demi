<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Tambah Course'])

    <!-- External Libraries -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
    <style>
        /* Quill Editor Dark Mode Styling Overrides */
        [data-theme="dark"] .ql-toolbar.ql-snow {
            border-color: rgba(255, 255, 255, 0.08) !important;
            background: #1a1825 !important;
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-stroke {
            stroke: #9ca3af !important;
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-fill {
            fill: #9ca3af !important;
        }
        [data-theme="dark"] .ql-toolbar.ql-snow button:hover .ql-stroke { stroke: #c084fc !important; }
        [data-theme="dark"] .ql-toolbar.ql-snow button:hover .ql-fill { fill: #c084fc !important; }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-label {
            color: #9ca3af !important;
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-options {
            background: #13111c !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        [data-theme="dark"] .ql-toolbar.ql-snow .ql-picker-item {
            color: #e5e7eb !important;
        }
        [data-theme="dark"] .ql-container.ql-snow {
            background: #13111c !important;
            border: none !important;
        }
        [data-theme="dark"] .ql-editor {
            color: #e5e7eb !important;
        }
        [data-theme="dark"] .ql-editor.ql-blank::before {
            color: #6b7280 !important;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        {{-- Includes Sidebar --}}
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-tambah'])

        <div class="flex-1 flex flex-col min-w-0 min-h-screen">
            {{-- Includes Header --}}
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">
                
                {{-- 1. ALERTS CONTAINER (For dynamic JS errors) --}}
                <div id="alertsContainer" class="pt-8 px-8 md:pt-6 md:px-4"></div>

                {{-- 2. PAGE HERO --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Tambah Course Baru</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Lengkapi formulir di bawah ini untuk memublikasikan course baru ke platform.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('superadmin.course.list') }}" class="text-brand-purple hover:underline">Manajemen Course</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Tambah Course</span>
                    </div>
                </div>

                {{-- 3. FORM CARD --}}
                <div class="p-6 md:p-4">
                    <div class="max-w-4xl mx-auto">
                        <div class="content-card">
                            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                                <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                    <i class="ri-book-mark-line text-brand-purple text-lg"></i>
                                    Detail Course
                                </div>
                            </div>

                            <div class="p-8 md:p-5">
                                <form id="courseForm" action="{{ route('superadmin.course.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf

                                    {{-- General Info --}}
                                    <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Judul Course</label>
                                            <input type="text" name="judul" class="form-input-modern" placeholder="Contoh: Bootcamp Web Dev" required value="{{ old('judul') }}">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Kategori</label>
                                            <select name="kategori_id" class="form-input-modern cursor-pointer" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Mentor</label>
                                        <select name="mentor_id" class="form-input-modern cursor-pointer" required>
                                            <option value="">-- Pilih Mentor --</option>
                                            @foreach ($mentors as $mentor)
                                                <option value="{{ $mentor->id }}" {{ old('mentor_id') == $mentor->id ? 'selected' : '' }}>{{ $mentor->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Deskripsi Course</label>
                                        <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden focus-within:border-brand-purple focus-within:ring-4 focus-within:ring-brand-purple/10 transition-all bg-white dark:bg-[#13111c]">
                                            <div id="editor-container" class="min-h-[200px] text-slate-800 dark:text-slate-200"></div>
                                        </div>
                                        <input type="hidden" name="deskripsi" id="deskripsiInput" value="{{ old('deskripsi') }}">
                                    </div>

                                    {{-- Divider --}}
                                    <div class="flex items-center gap-3 my-8 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 before:content-[''] before:flex-1 before:h-[1px] before:bg-slate-100 dark:before:bg-slate-900 after:content-[''] after:flex-1 after:h-[1px] after:bg-slate-100 dark:after:bg-slate-900">
                                        <i class="ri-price-tag-3-line text-brand-purple text-sm"></i> Harga & Media
                                    </div>

                                    <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Thumbnail</label>
                                            <input type="file" name="gambar" class="form-input-modern" id="thumbnail" accept="image/*" required>
                                            <small id="thumbnailPreview" class="block text-[10px] font-semibold text-slate-400 dark:text-slate-500 mt-2">Belum ada file dipilih</small>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Harga Jual (IDR)</label>
                                            <input type="text" class="form-input-modern" id="hargaDisplay" placeholder="0">
                                            <input type="hidden" name="harga" id="hargaHidden" value="0">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Kuota Peserta</label>
                                        <select name="kuota" class="form-input-modern cursor-pointer" required>
                                            <option value="">-- Pilih Kuota --</option>
                                            <option value="10" {{ old('kuota') == '10' ? 'selected' : '' }}>10 Peserta</option>
                                            <option value="20" {{ old('kuota') == '20' ? 'selected' : '' }}>20 Peserta</option>
                                            <option value="30" {{ old('kuota') == '30' ? 'selected' : '' }}>30 Peserta</option>
                                            <option value="50" {{ old('kuota') == '50' ? 'selected' : '' }}>50 Peserta</option>
                                            <option value="100" {{ old('kuota') == '100' ? 'selected' : '' }}>100 Peserta</option>
                                            <option value="0" {{ old('kuota') == '0' ? 'selected' : '' }}>Unlimited</option>
                                        </select>
                                    </div>

                                    {{-- Divider --}}
                                    <div class="flex items-center gap-3 my-8 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 before:content-[''] before:flex-1 before:h-[1px] before:bg-slate-100 dark:before:bg-slate-900 after:content-[''] after:flex-1 after:h-[1px] after:bg-slate-100 dark:after:bg-slate-900">
                                        <i class="ri-folder-shared-line text-brand-purple text-sm"></i> Modul Course
                                    </div>

                                    <div class="flex flex-col gap-4" id="modulContainer">
                                        {{-- Rows injected by JS --}}
                                    </div>

                                    <button type="button" class="w-full py-3 border-2 border-dashed border-slate-200 dark:border-slate-800 hover:border-brand-purple hover:bg-brand-purple/5 text-slate-500 dark:text-slate-400 hover:text-brand-purple rounded-xl font-bold text-xs cursor-pointer transition-all flex items-center justify-center gap-1.5" id="btnTambahModul">
                                        <i class="ri-add-circle-line text-base"></i> Tambah Baris Modul
                                    </button>
                                    <small class="block text-[10px] font-semibold text-slate-400 dark:text-slate-500 mt-2">
                                        <i class="ri-information-line"></i> Cari dan pilih modul dari database yang tersedia.
                                    </small>

                                    {{-- Divider --}}
                                    <div class="flex items-center gap-3 my-8 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 before:content-[''] before:flex-1 before:h-[1px] before:bg-slate-100 dark:before:bg-slate-900 after:content-[''] after:flex-1 after:h-[1px] after:bg-slate-100 dark:after:bg-slate-900">
                                        <i class="ri-toggle-line text-brand-purple text-sm"></i> Status Publikasi
                                    </div>

                                    <div class="flex gap-3">
                                        <label class="flex-1 relative cursor-pointer">
                                            <input type="radio" name="status" value="publish" {{ old('status', 'publish') === 'publish' ? 'checked' : '' }} class="peer absolute opacity-0 w-0 h-0">
                                            <div class="flex items-center p-3.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer transition-all peer-checked:bg-brand-purple/10 peer-checked:border-brand-purple peer-checked:text-brand-purple text-slate-600 dark:text-slate-300">
                                                <i class="ri-global-line mr-2.5 text-slate-400 dark:text-slate-500 text-base"></i>
                                                <span class="text-xs font-bold">Publish</span>
                                            </div>
                                        </label>
                                        <label class="flex-1 relative cursor-pointer">
                                            <input type="radio" name="status" value="draft" {{ old('status') === 'draft' ? 'checked' : '' }} class="peer absolute opacity-0 w-0 h-0">
                                            <div class="flex items-center p-3.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer transition-all peer-checked:bg-brand-purple/10 peer-checked:border-brand-purple peer-checked:text-brand-purple text-slate-600 dark:text-slate-300">
                                                <i class="ri-draft-line mr-2.5 text-slate-400 dark:text-slate-500 text-base"></i>
                                                <span class="text-xs font-bold">Draft</span>
                                            </div>
                                        </label>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-900 md:flex-col">
                                        <a href="{{ route('superadmin.course.list') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-center">
                                            <i class="ri-arrow-left-line"></i> Batal
                                        </a>
                                        <button type="submit" class="btn-brand justify-center">
                                            <i class="ri-save-3-line"></i> Simpan Course
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            @include('layouts.superadmin.partials.footer')
        </div>
    </div>

    @include('layouts.superadmin.partials.scripts')
    
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // ── 1. DATA INITIALIZATION ──
        let ALL_MODULS = [];
        @if(isset($moduls))
            ALL_MODULS = @json($moduls);
        @else
            ALL_MODULS = [
                { id: 1, judul: "Pengenalan HTML", kursus: { judul: "Web Dasar" }, urutan: 1 },
                { id: 2, judul: "Styling dengan CSS", kursus: { judul: "Web Dasar" }, urutan: 2 },
                { id: 3, judul: "JavaScript Dasar", kursus: { judul: "Web Lanjut" }, urutan: 1 }
            ];
        @endif

        // ── 2. QUILL EDITOR ──
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tuliskan deskripsi lengkap course di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'clean']
                ]
            }
        });
        const deskripsiInput = document.getElementById('deskripsiInput');
        if (deskripsiInput.value) quill.root.innerHTML = deskripsiInput.value;

        // ── 3. MODUL LOGIC ──
        let rowCounter = 0;
        const container = document.getElementById('modulContainer');

        function createModulRow() {
            rowCounter++;
            const rowId = 'modulRow_' + rowCounter;
            const inputId = 'modulSearch_' + rowCounter;
            const dropdownId = 'modulDrop_' + rowCounter;
            const hiddenId = 'modulHidden_' + rowCounter;

            const div = document.createElement('div');
            div.className = 'p-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-900 rounded-xl relative transition-all hover:border-brand-purple';
            div.id = rowId;
            div.dataset.selectedId = '';
            
            div.innerHTML = `
                <div class="flex justify-between items-center mb-3">
                    <span class="bg-brand-purple text-white text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">Modul #${rowCounter}</span>
                    <button type="button" class="text-slate-400 hover:text-red-500 transition-colors cursor-pointer" onclick="removeModulRow('${rowId}')" title="Hapus">
                        <i class="ri-close-circle-line text-lg"></i>
                    </button>
                </div>
                <div class="relative">
                    <input type="text" class="form-input-modern" id="${inputId}" placeholder="🔍 Cari judul modul..." autocomplete="off">
                    <div class="absolute top-[calc(100%+8px)] left-0 right-0 bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-xl shadow-xl z-50 max-h-60 overflow-y-auto hidden" id="${dropdownId}"></div>
                    <input type="hidden" name="modul_ids[]" id="${hiddenId}" value="">
                    <div class="modul-chip-container"></div>
                </div>
            `;
            container.appendChild(div);
            bindSearchInput(inputId);
        }

        function bindSearchInput(inputId) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(input.nextElementSibling.id);
            
            input.addEventListener('focus', () => renderDropdown(inputId, ''));
            input.addEventListener('input', () => renderDropdown(inputId, input.value));
            
            document.addEventListener('click', (e) => {
                if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                    dropdown.classList.remove('block');
                }
            });
        }

        function renderDropdown(inputId, query) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(input.nextElementSibling.id);
            const row = input.closest('div').parentElement;
            
            const q = query.toLowerCase();
            const filtered = ALL_MODULS.filter(m => 
                m.judul.toLowerCase().includes(q) || 
                (m.kursus?.judul || '').toLowerCase().includes(q)
            );

            if (!filtered.length) {
                dropdown.innerHTML = '<div class="p-3.5 text-center text-slate-500 text-xs">Tidak ditemukan</div>';
            } else {
                dropdown.innerHTML = filtered.map(m => `
                    <div class="p-3 cursor-pointer border-b border-slate-100 dark:border-slate-900/50 flex flex-col hover:bg-brand-purple/5 ${row.dataset.selectedId == m.id ? 'bg-brand-purple/10 border-l-3 border-l-brand-purple' : ''}"
                         onclick="selectModul('${inputId}', ${m.id}, '${escapeHtml(m.judul)}', '${escapeHtml(m.kursus?.judul || '')}', ${m.urutan})">
                        <span class="font-bold text-slate-800 dark:text-slate-200 text-xs">${m.judul}</span>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">${m.kursus?.judul || '-'} • Urutan ${m.urutan}</span>
                    </div>
                `).join('');
            }
            dropdown.classList.remove('hidden');
            dropdown.classList.add('block');
        }

        function selectModul(inputId, id, judul, kursusJudul, urutan) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(input.nextElementSibling.id);
            const hiddenId = input.nextElementSibling.nextElementSibling.id;
            const row = input.closest('div').parentElement;
            const chipContainer = row.querySelector('.modul-chip-container');

            row.dataset.selectedId = id;
            document.getElementById(hiddenId).value = id;
            input.value = judul;

            chipContainer.innerHTML = `
                <div class="inline-flex items-center gap-1.5 bg-brand-purple/15 text-brand-purple text-[10px] font-bold px-3 py-1 rounded-full mt-2">
                    <i class="ri-check-line"></i> ${judul}
                    <span class="opacity-75 ml-1">(${kursusJudul})</span>
                </div>
            `;
            dropdown.classList.add('hidden');
            dropdown.classList.remove('block');
        }

        function removeModulRow(rowId) {
            const row = document.getElementById(rowId);
            row.style.opacity = '0';
            setTimeout(() => { row.remove(); renumberRows(); }, 200);
        }

        function renumberRows() {
            document.querySelectorAll('#modulContainer > div').forEach((row, i) => {
                row.querySelector('span').textContent = 'Modul #' + (i + 1);
            });
        }

        document.getElementById('btnTambahModul').addEventListener('click', createModulRow);
        
        // Init one row
        if(ALL_MODULS.length > 0 || {{ isset($moduls) ? 'true' : 'false' }}) createModulRow();

        // ── 4. UTILS ──
        function escapeHtml(str) { return String(str).replace(/'/g, "\\'").replace(/"/g, '&quot;'); }
        
        function showAlert(message, type = 'error') {
            const container = document.getElementById('alertsContainer');
            const alertDiv = document.createElement('div');
            const iconClass = type === 'error' ? 'ri-error-warning-line' : 'ri-check-double-line';
            const bgClass = type === 'error' ? 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-500/25' : 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-500/25';
            
            alertDiv.className = `flex items-start gap-3 p-4 rounded-xl text-sm font-semibold mb-5 ${bgClass} transition-all duration-300`;
            alertDiv.innerHTML = `
                <i class="${iconClass} text-lg"></i>
                <div>${message}</div>
            `;
            container.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.style.opacity = '0';
                alertDiv.style.transform = 'translateY(-10px)';
                setTimeout(() => alertDiv.remove(), 300);
            }, 5000);
        }

        // ── 5. FORM HANDLING ──
        
        const hargaDisplay = document.getElementById('hargaDisplay');
        const hargaHidden = document.getElementById('hargaHidden');
        hargaDisplay.addEventListener('input', () => {
            let val = hargaDisplay.value.replace(/[^0-9]/g, '');
            hargaHidden.value = val || '0';
            hargaDisplay.value = val ? 'Rp ' + new Intl.NumberFormat('id-ID').format(val) : '';
        });

        const thumbnailInput = document.getElementById('thumbnail');
        const thumbnailPreview = document.getElementById('thumbnailPreview');
        thumbnailInput.addEventListener('change', function() {
            thumbnailPreview.textContent = this.files.length ? 'File: ' + this.files[0].name : 'Belum ada file dipilih';
        });

        document.getElementById('courseForm').addEventListener('submit', function(e) {
            deskripsiInput.value = quill.root.innerHTML;
            if (quill.getText().trim().length === 0) {
                e.preventDefault();
                showAlert('⚠️ Deskripsi course wajib diisi.', 'error');
                quill.focus();
                return;
            }

            const rows = document.querySelectorAll('#modulContainer > div');
            const selected = [...rows].filter(r => r.dataset.selectedId);
            
            if (rows.length > 0 && selected.length === 0) {
                e.preventDefault();
                showAlert('⚠️ Mohon pilih minimal satu modul atau hapus baris modul yang kosong.', 'error');
                return;
            }

            if (!hargaHidden.value) hargaHidden.value = '0';
        });

        @if($errors->any())
            showAlert('Terjadi kesalahan pada input.', 'error');
        @endif
    </script>
</body>
</html>