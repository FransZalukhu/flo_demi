<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Profil Saya'])

    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

    <style>
        /* ══════════ PAGE HERO ══════════ */
        .page-hero {
            padding: 32px 32px 0;
        }

        .page-hero-greeting {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .page-hero-greeting span {
            background: linear-gradient(135deg, var(--brand-purple), #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-hero-sub {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 20px;
        }

        .breadcrumb-modern {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .breadcrumb-modern a {
            color: var(--brand-purple);
            text-decoration: none;
        }

        .breadcrumb-modern a:hover { text-decoration: underline; }

        .breadcrumb-modern .separator { color: var(--text-muted); }

        .breadcrumb-modern .current { color: var(--text-muted); }

        /* ══════════ ALERTS ══════════ */
        .alert-modern {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            animation: slideUp 0.4s ease-out forwards;
        }

        .alert-modern i {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-modern.success {
            background: var(--success-light);
            color: var(--success);
            border: 1px solid rgba(16,185,129,0.25);
        }

        .alert-modern.danger {
            background: var(--danger-light);
            color: var(--danger);
            border: 1px solid rgba(239,68,68,0.25);
        }

        .alert-modern ul {
            margin: 4px 0 0 0;
            padding-left: 16px;
        }

        .alert-modern ul li {
            margin-bottom: 3px;
        }

        /* ══════════ CONTENT CARD ══════════ */
        .content-card {
            background: var(--card-bg);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            max-width: 720px;
            margin: 0 auto;
        }

        .content-card-header {
            padding: 20px 28px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .content-card-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .content-card-title i { color: var(--brand-purple); }

        .content-card-body {
            padding: 28px;
        }

        /* ══════════ PHOTO SECTION ══════════ */
        .photo-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 32px;
            padding-bottom: 28px;
            border-bottom: 1px solid var(--border-color);
        }

        .photo-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .profile-photo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--brand-purple);
            transition: all 0.3s ease;
            display: block;
        }

        .photo-overlay {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.50);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .photo-wrapper:hover .photo-overlay {
            opacity: 1;
        }

        .photo-overlay i {
            font-size: 26px;
            color: #fff;
        }

        .photo-hint {
            margin-top: 12px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
        }

        /* ══════════ FORM ══════════ */
        .form-group-modern {
            margin-bottom: 20px;
        }

        .form-label-modern {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .form-label-modern i {
            color: var(--brand-purple);
            font-size: 14px;
        }

        .form-control-modern {
            width: 100%;
            padding: 11px 16px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
            background: var(--input-bg, var(--card-bg));
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.35s;
            box-sizing: border-box;
        }

        .form-control-modern:hover {
            border-color: rgba(159,102,175,0.4);
        }

        .form-control-modern:focus {
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 3px rgba(159,102,175,0.12);
            background: var(--input-focus-bg, var(--card-bg));
        }

        .form-control-modern::placeholder {
            color: var(--text-muted);
            font-weight: 400;
        }

        [data-theme="dark"] .form-control-modern {
            background: var(--input-bg);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .form-hint {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* ══════════ ACTION BUTTONS ══════════ */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
        }

        .btn-brand {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 22px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-brand-muted {
            background: var(--border-color);
            color: var(--text-secondary);
        }

        .btn-brand-muted:hover {
            background: var(--text-muted);
            color: #fff;
        }

        .btn-brand-primary {
            background: var(--brand-purple);
            color: #fff;
            box-shadow: 0 4px 14px rgba(159,102,175,0.25);
        }

        .btn-brand-primary:hover {
            background: var(--brand-purple-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(159,102,175,0.35);
        }

        .btn-brand-primary:active {
            transform: translateY(0);
        }

        /* ══════════ CROP MODAL ══════════ */
        .crop-modal-overlay {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            align-items: center;
            justify-content: center;
        }

        .crop-modal-overlay.show {
            display: flex;
        }

        .crop-modal-box {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 28px;
            max-width: 860px;
            width: 92%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: slideUp 0.3s ease-out;
        }

        .crop-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .crop-modal-header h3 {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .crop-modal-header h3 i { color: var(--brand-purple); }

        .crop-close-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-muted);
            cursor: pointer;
            line-height: 1;
            padding: 4px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .crop-close-btn:hover {
            background: var(--border-color);
            color: var(--text-primary);
        }

        .crop-container {
            max-height: 420px;
            overflow: hidden;
            margin-bottom: 20px;
            background: var(--table-header-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .crop-container img {
            max-width: 100%;
            display: block;
        }

        .crop-preview-section {
            margin-bottom: 20px;
            text-align: center;
        }

        .crop-preview-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .crop-preview {
            width: 130px;
            height: 130px;
            overflow: hidden;
            margin: 0 auto;
            border-radius: 50%;
            border: 3px solid var(--brand-purple);
        }

        .crop-controls {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .crop-ctrl-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
        }

        .crop-ctrl-btn:hover {
            border-color: var(--brand-purple);
            color: var(--brand-purple);
            background: var(--brand-purple-light);
        }

        .crop-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        /* ══════════ ANIMATIONS ══════════ */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-slide-up { animation: slideUp 0.5s ease-out forwards; }
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }

        /* ══════════ RESPONSIVE ══════════ */
        @media (max-width: 767.98px) {
            .page-hero { padding: 20px 16px 0; }
            .page-hero-greeting { font-size: 20px; }
            .content-card-body { padding: 20px; }
            .action-buttons { flex-direction: column; }
            .btn-brand { justify-content: center; }
            .crop-actions { flex-direction: column; }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'profil', 'activePage' => 'profil-saya'])

        <div style="flex:1;display:flex;flex-direction:column;">
            @include('layouts.superadmin.partials.header')

            <main style="flex:1;padding:0;">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="page-hero animate-slide-up">
                    <div class="page-hero-greeting">
                        <span>Profil Saya</span> 
                    </div>
                    <p class="page-hero-sub">
                        Kelola informasi akun dan foto profil Anda di sini.
                    </p>
                    <div class="breadcrumb-modern">
                        <a href="{{ route('superadmin.dashboard.index') }}">Dashboard</a>
                        <span class="separator"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="current">Profil Saya</span>
                    </div>
                </div>

                {{-- ══════════ ALERTS ══════════ --}}
                <div style="padding:20px 32px 0;">
                    @if(session('success'))
                    <div class="alert-modern success">
                        <i class="ri-checkbox-circle-line"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert-modern danger">
                        <i class="ri-error-warning-line"></i>
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- ══════════ PROFILE CARD ══════════ --}}
                <div style="padding:20px 32px 32px;">
                    <div class="content-card animate-slide-up delay-1">
                        <div class="content-card-header">
                            <div class="content-card-title">
                                <i class="ri-user-settings-line"></i>
                                Informasi Akun
                            </div>
                        </div>

                        <div class="content-card-body">

                            {{-- Photo Section --}}
                            <div class="photo-section">
                                @php
                                    $photoUrl = $user->photo
                                        ? asset('storage/' . $user->photo) . '?t=' . time()
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&background=9F66AF&color=fff&size=240';
                                @endphp
                                <div class="photo-wrapper" onclick="document.getElementById('photo-upload').click();">
                                    <img src="{{ $photoUrl }}"
                                         alt="Profile Photo"
                                         class="profile-photo"
                                         id="profile-preview">
                                    <div class="photo-overlay">
                                        <i class="ri-camera-line"></i>
                                    </div>
                                </div>
                                <p class="photo-hint">Klik foto untuk mengubah</p>
                            </div>

                            {{-- Form --}}
                            <form action="{{ route('superadmin.profile.update') }}"
                                  method="POST"
                                  enctype="multipart/form-data"
                                  id="profile-form">
                                @csrf

                                <input type="file"
                                       id="photo-upload"
                                       name="photo"
                                       accept="image/*"
                                       style="display:none;"
                                       onchange="previewPhoto(this)">

                                <div class="form-group-modern">
                                    <label class="form-label-modern">
                                        <i class="ri-user-line"></i> Nama
                                    </label>
                                    <input type="text"
                                           name="username"
                                           class="form-control-modern"
                                           placeholder="Masukkan nama..."
                                           value="{{ old('username', $user->username) }}"
                                           required>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">
                                        <i class="ri-mail-line"></i> Email
                                    </label>
                                    <input type="email"
                                           name="email"
                                           class="form-control-modern"
                                           placeholder="Masukkan email..."
                                           value="{{ old('email', $user->email) }}"
                                           required>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">
                                        <i class="ri-smartphone-line"></i> Nomor Handphone
                                    </label>
                                    <input type="tel"
                                           name="nomor_hp"
                                           class="form-control-modern"
                                           placeholder="Masukkan nomor handphone..."
                                           value="{{ old('nomor_hp', $user->nomor_hp) }}"
                                           inputmode="numeric" pattern="[0-9]*" maxlength="13"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">
                                        <i class="ri-lock-line"></i> Password Baru
                                    </label>
                                    <input type="password"
                                           name="new_password"
                                           class="form-control-modern"
                                           placeholder="Masukkan password baru...">
                                    <p class="form-hint">Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.</p>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">
                                        <i class="ri-shield-check-line"></i> Konfirmasi Password Baru
                                    </label>
                                    <input type="password"
                                           name="new_password_confirmation"
                                           class="form-control-modern"
                                           placeholder="Ulangi password baru...">
                                </div>

                                <div class="action-buttons">
                                    <a href="{{ route('superadmin.dashboard.index') }}" class="btn-brand btn-brand-muted">
                                        <i class="ri-arrow-left-line"></i> Batal
                                    </a>
                                    <button type="submit" class="btn-brand btn-brand-primary">
                                        <i class="ri-save-line"></i> Simpan Perubahan
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

    {{-- ══════════ CROP MODAL ══════════ --}}
    <div class="crop-modal-overlay" id="cropModal">
        <div class="crop-modal-box">
            <div class="crop-modal-header">
                <h3><i class="ri-crop-line"></i> Edit Foto Profil</h3>
                <button class="crop-close-btn" id="cropModalClose">&times;</button>
            </div>

            <div class="crop-container">
                <img id="cropImage" src="" alt="Image to crop">
            </div>

            <div class="crop-preview-section">
                <p class="crop-preview-label">Preview</p>
                <div class="crop-preview" id="cropPreview"></div>
            </div>

            <div class="crop-controls">
                <button class="crop-ctrl-btn" id="rotateLeft">
                    <i class="ri-anticlockwise-line"></i> Putar Kiri
                </button>
                <button class="crop-ctrl-btn" id="rotateRight">
                    <i class="ri-clockwise-line"></i> Putar Kanan
                </button>
                <button class="crop-ctrl-btn" id="flipHorizontal">
                    <i class="ri-flip-horizontal-line"></i> Flip H
                </button>
                <button class="crop-ctrl-btn" id="flipVertical">
                    <i class="ri-flip-vertical-line"></i> Flip V
                </button>
                <button class="crop-ctrl-btn" id="resetCrop">
                    <i class="ri-refresh-line"></i> Reset
                </button>
            </div>

            <div class="crop-actions">
                <button class="btn-brand btn-brand-muted" id="cancelCrop">Batal</button>
                <button class="btn-brand btn-brand-primary" id="applyCrop">
                    <i class="ri-check-line"></i> Gunakan Foto
                </button>
            </div>
        </div>
    </div>

    <canvas id="croppedCanvas" style="display:none;"></canvas>

    @include('layouts.superadmin.partials.scripts')

    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>

    <script>
        let cropper = null;
        let originalImageData = null;

        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    originalImageData = e.target.result;
                    const cropImage = document.getElementById('cropImage');
                    cropImage.src = e.target.result;
                    if (cropper) { cropper.destroy(); }
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 0.8,
                        restore: false,
                        guides: true,
                        center: true,
                        highlight: false,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                        preview: '#cropPreview',
                        ready: function() {
                            const p = document.getElementById('cropPreview');
                            p.style.width = '130px';
                            p.style.height = '130px';
                            p.style.overflow = 'hidden';
                            p.style.borderRadius = '50%';
                        }
                    });
                    document.getElementById('cropModal').classList.add('show');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('cropModalClose').addEventListener('click', closeCropModal);
        document.getElementById('cancelCrop').addEventListener('click', function() {
            closeCropModal();
            document.getElementById('photo-upload').value = '';
            const preview = document.getElementById('profile-preview');
            @if($user->photo)
                preview.src = '{{ asset('storage/' . $user->photo) . '?t=' . time() }}';
            @else
                preview.src = 'https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=9F66AF&color=fff&size=240';
            @endif
        });

        document.getElementById('applyCrop').addEventListener('click', function() {
            if (!cropper) return;
            const canvas = cropper.getCroppedCanvas({
                width: 300, height: 300,
                minWidth: 256, minHeight: 256,
                maxWidth: 1024, maxHeight: 1024,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });
            canvas.toBlob(function(blob) {
                const file = new File([blob], 'profile-photo.jpg', { type: 'image/jpeg' });
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('photo-upload').files = dt.files;
                document.getElementById('profile-preview').src = canvas.toDataURL('image/jpeg', 0.9);
                closeCropModal();
            }, 'image/jpeg', 0.9);
        });

        document.getElementById('rotateLeft').addEventListener('click', function() { if (cropper) cropper.rotate(-90); });
        document.getElementById('rotateRight').addEventListener('click', function() { if (cropper) cropper.rotate(90); });

        let flipH = 1;
        document.getElementById('flipHorizontal').addEventListener('click', function() {
            if (cropper) { flipH *= -1; cropper.scaleX(flipH); }
        });

        let flipV = 1;
        document.getElementById('flipVertical').addEventListener('click', function() {
            if (cropper) { flipV *= -1; cropper.scaleY(flipV); }
        });

        document.getElementById('resetCrop').addEventListener('click', function() {
            if (cropper) { cropper.reset(); flipH = 1; flipV = 1; }
        });

        function closeCropModal() {
            document.getElementById('cropModal').classList.remove('show');
            if (cropper) { cropper.destroy(); cropper = null; }
        }

        document.getElementById('cropModal').addEventListener('click', function(e) {
            if (e.target === this) closeCropModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('cropModal').classList.contains('show')) {
                closeCropModal();
            }
        });
    </script>
</body>

</html>