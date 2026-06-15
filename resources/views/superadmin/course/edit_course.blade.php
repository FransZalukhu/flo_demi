<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Edit Course'])

    <!-- Quill Editor CSS -->
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
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-list'])

        <div class="flex-1 flex flex-col min-w-0 min-h-screen">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">
                
                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Edit Course</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Perbarui informasi kursus <strong>{{ $course->judul }}</strong>
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('superadmin.course.list') }}" class="text-brand-purple hover:underline">Manajemen Course</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Edit Course</span>
                    </div>
                </div>

                {{-- ══════════ FORM CARD ══════════ --}}
                <div class="p-6 md:p-4">
                    <div class="max-w-4xl mx-auto">
                        <div class="content-card">
                            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                                <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                    <i class="ri-edit-box-line text-brand-purple text-lg"></i>
                                    Informasi Kursus
                                </div>
                            </div>

                            <div class="p-8 md:p-5">
                                <form id="courseForm" action="{{ route('superadmin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf
                                    @method('POST')

                                    <!-- Judul -->
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Judul Course <span class="text-red-500">*</span></label>
                                        <input type="text" name="judul" class="form-input-modern" placeholder="Contoh: Bootcamp UI/UX Design" required value="{{ old('judul', $course->judul) }}">
                                    </div>

                                    <!-- Deskripsi -->
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                                        <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden focus-within:border-brand-purple focus-within:ring-4 focus-within:ring-brand-purple/10 transition-all bg-white dark:bg-[#13111c]">
                                            <div id="editor-container" class="min-h-[250px] text-slate-800 dark:text-slate-200"></div>
                                        </div>
                                        <input type="hidden" name="deskripsi" id="deskripsiInput" value="{{ old('deskripsi', $course->deskripsi) }}">
                                    </div>

                                    <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                        <!-- Kategori -->
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Kategori <span class="text-red-500">*</span></label>
                                            <select name="kategori_id" class="form-input-modern cursor-pointer" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ old('kategori_id', $course->kategori_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Status <span class="text-red-500">*</span></label>
                                            <select name="status" class="form-input-modern cursor-pointer" required>
                                                <option value="publish" {{ old('status', $course->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                                                <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-6 md:grid-cols-1 md:gap-4">
                                        <!-- Harga -->
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Harga Jual <span class="text-red-500">*</span></label>
                                            <div class="relative flex items-center">
                                                <span class="absolute left-4 text-xs font-bold text-slate-400 dark:text-slate-500">Rp</span>
                                                <input type="text" id="hargaDisplay" class="form-input-modern pl-10" value="{{ number_format($course->harga, 0, ',', '.') }}" placeholder="0 untuk gratis">
                                                <input type="hidden" name="harga" id="hargaHidden" value="{{ (int) $course->harga }}">
                                            </div>
                                        </div>

                                        <!-- Kuota -->
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Kuota <span class="text-red-500">*</span></label>
                                            <input type="number" name="kuota" class="form-input-modern" value="{{ old('kuota', $course->kuota) }}" placeholder="0 untuk Unlimited">
                                        </div>
                                    </div>

                                    <!-- Thumbnail -->
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Ganti Thumbnail</label>
                                        <input type="file" name="gambar" class="form-input-modern" id="thumbnail" accept="image/*">
                                        <div class="mt-3">
                                            <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Thumbnail saat ini:</span>
                                            @if($course->gambar)
                                                <img src="{{ asset('storage/' . $course->gambar) }}" class="max-w-[200px] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm" alt="Thumbnail">
                                            @else
                                                <span class="text-xs text-slate-400 dark:text-slate-500 italic">Tidak ada gambar</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- ACTION -->
                                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-900 md:flex-col">
                                        <a href="{{ route('superadmin.course.list') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-center">Batal</a>
                                        <button type="submit" class="btn-brand justify-center">
                                            <i class="fas fa-save"></i> Simpan Perubahan
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

    <!-- Quill Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
    // Quill.js
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
    if (deskripsiInput.value) {
        quill.root.innerHTML = deskripsiInput.value;
    }

    const hargaDisplay = document.getElementById('hargaDisplay');
    const hargaHidden  = document.getElementById('hargaHidden');

    if (hargaDisplay && hargaHidden) {
        hargaDisplay.addEventListener('input', function() {
            let val = this.value.replace(/[^0-9]/g, '');
            hargaHidden.value = val || '0';
            this.value = val ? 'Rp ' + new Intl.NumberFormat('id-ID').format(val) : '';
        });

        let initialVal = hargaHidden.value.replace(/[^0-9]/g, '');
        if (initialVal && initialVal !== '0') {
            hargaDisplay.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(initialVal);
        }
    }

    // Validasi Input
    document.getElementById('courseForm').addEventListener('submit', function(e) {
        // Sync Quill content
        const html = quill.root.innerHTML;
        
        if (quill.getText().trim().length === 0) {
            e.preventDefault();
            alert('Deskripsi course wajib diisi.');
            quill.focus();
            return;
        }
        
        deskripsiInput.value = html;
        
        if (hargaHidden && !hargaHidden.value) {
            hargaHidden.value = '0';
        }
    });
    </script>
</body>
</html>