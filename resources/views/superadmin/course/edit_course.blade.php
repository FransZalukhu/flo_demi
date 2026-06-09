<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Edit Course'])

    <!-- Quill Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
        /* ── Base ── */
        .form-card-purple {
            border: 2px solid #9F66AF;
            border-radius: 14px;
            box-shadow: 0 4px 10px rgba(159,102,175,0.08);
        }
        .form-card-purple .form-label { font-weight: 600; color: #4b2c57; }
        .form-card-purple .form-control:focus,
        .form-card-purple .form-select:focus {
            border-color: #9F66AF;
            box-shadow: 0 0 0 0.2rem rgba(159,102,175,0.25);
        }
        .btn-purple {
            background-color: #9F66AF !important;
            color: #ffffff !important;
            font-weight: 600;
            border-radius: 6px;
            border: none;
        }
        .btn-purple:hover { background-color: #8b55a0 !important; }

        /* ── Quill Custom Style ── */
        .quill-editor-wrapper {
            border: 1.5px solid #9F66AF;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }
        .ql-toolbar.ql-snow {
            border: none !important;
            border-bottom: 1px solid #f3e9f9 !important;
            background: #fdf8ff;
        }
        .ql-container.ql-snow {
            border: none !important;
            min-height: 250px;
            font-family: inherit;
            font-size: 14px;
        }
        .ql-editor.ql-blank::before {
            color: #aaa;
            font-style: italic;
        }
        /* Focus state */
        .quill-editor-wrapper:focus-within {
            border-color: #9F66AF;
            box-shadow: 0 0 0 0.2rem rgba(159,102,175,0.25);
        }

        .current-thumb {
            max-width: 200px;
            border-radius: 10px;
            border: 2px solid #9F66AF;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="dashboard-main-wrapper">
        @include('layouts.superadmin.partials.header')
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-course', 'activePage' => 'manajemen-course-list'])

        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- Page Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Edit Course</h2>
                            <p class="pageheader-text">Perbarui informasi kursus <strong>{{ $course->judul }}</strong></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard.index') }}" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('superadmin.course.list') }}" class="breadcrumb-link">Manajemen Course</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-xl-8 col-lg-10 col-md-12 mx-auto">
                        <div class="card form-card-purple">
                            <div class="card-body p-4">

                                <form id="courseForm" action="{{ route('superadmin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <!-- Judul -->
                                    <div class="mb-3">
                                        <label class="form-label">Judul Course <span class="text-danger">*</span></label>
                                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Bootcamp UI/UX Design" required value="{{ old('judul', $course->judul) }}">
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <div class="quill-editor-wrapper">
                                            <div id="editor-container"></div>
                                        </div>
                                        <input type="hidden" name="deskripsi" id="deskripsiInput" value="{{ old('deskripsi', $course->deskripsi) }}">
                                    </div>

                                    <div class="row">
                                        <!-- Kategori -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                            <select name="kategori_id" class="form-select" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ old('kategori_id', $course->kategori_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select" required>
                                                <option value="publish" {{ old('status', $course->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                                                <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Harga -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Harga Jual <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" 
                                                       id="hargaDisplay" 
                                                       class="form-control" 
                                                       value="{{ number_format($course->harga, 0, ',', '.') }}"
                                                       placeholder="0 untuk gratis">
                                                <input type="hidden" name="harga" id="hargaHidden" value="{{ (int) $course->harga }}">
                                            </div>
                                        </div>

                                        <!-- Kuota -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Kuota <span class="text-danger">*</span></label>
                                            <input type="number" name="kuota" class="form-control" value="{{ old('kuota', $course->kuota) }}" placeholder="0 untuk Unlimited">
                                        </div>
                                    </div>

                                    <!-- Thumbnail -->
                                    <div class="mb-4">
                                        <label class="form-label">Ganti Thumbnail</label>
                                        <input type="file" name="gambar" class="form-control" id="thumbnail" accept="image/*">
                                        <div class="mt-2">
                                            <small class="text-muted d-block mb-1">Thumbnail saat ini:</small>
                                            @if($course->gambar)
                                                <img src="{{ asset('storage/' . $course->gambar) }}" class="current-thumb" alt="Thumbnail">
                                            @else
                                                <span class="text-muted fst-italic">Tidak ada gambar</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- ACTION -->
                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('superadmin.course.list') }}" class="btn btn-light px-4">Batal</a>
                                        <button type="submit" class="btn btn-purple px-4">
                                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
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