<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Profil Saya'])

    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'profil', 'activePage' => 'profil-saya'])

        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.superadmin.partials.header')

            <main class="flex-1 p-0">

                {{-- ══════════ PAGE HEADER ══════════ --}}
                <div class="pt-8 px-8 pb-0 md:pt-6 md:px-4 transition-all duration-300">
                    <div class="text-2xl md:text-xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">
                        <span class="bg-gradient-to-r from-brand-purple to-purple-400 bg-clip-text text-transparent">Profil Saya</span> 
                    </div>
                    <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium mb-5">
                        Kelola informasi akun dan foto profil Anda di sini.
                    </p>
                    <div class="flex items-center gap-2 text-[11px] font-semibold">
                        <a href="{{ route('superadmin.dashboard.index') }}" class="text-brand-purple hover:underline">Dashboard</a>
                        <span class="text-slate-400 dark:text-slate-600"><i class="ri-arrow-right-s-line"></i></span>
                        <span class="text-slate-400 dark:text-slate-600">Profil Saya</span>
                    </div>
                </div>

                {{-- ══════════ ALERTS ══════════ --}}
                <div class="pt-6 px-8 md:px-4">
                    @if(session('success'))
                    <div class="flex items-start gap-3 p-4 rounded-xl text-sm font-semibold mb-5 bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-500/25">
                        <i class="ri-checkbox-circle-line text-lg"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="flex items-start gap-3 p-4 rounded-xl text-sm font-semibold mb-5 bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-500/25">
                        <i class="ri-error-warning-line text-lg"></i>
                        <div>
                            <ul class="list-disc pl-4 space-y-1">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- ══════════ PROFILE CARD ══════════ --}}
                <div class="p-6 md:p-4">
                    <div class="content-card max-w-2xl mx-auto">
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-900 flex items-center justify-between">
                            <div class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                                <i class="ri-user-settings-line text-brand-purple"></i>
                                Informasi Akun
                            </div>
                        </div>

                        <div class="p-8 md:p-5">

                            {{-- Photo Section --}}
                            <div class="flex flex-col items-center mb-8 pb-7 border-b border-slate-100 dark:border-slate-900">
                                @php
                                    $photoUrl = $user->photo
                                        ? asset('storage/' . $user->photo) . '?t=' . time()
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&background=9F66AF&color=fff&size=240';
                                @endphp
                                <div class="relative inline-block cursor-pointer group" onclick="document.getElementById('photo-upload').click();">
                                    <img src="{{ $photoUrl }}"
                                         alt="Profile Photo"
                                         class="w-28 h-28 rounded-full object-cover border-3 border-brand-purple transition-all duration-300 block"
                                         id="profile-preview">
                                    <div class="absolute inset-0 rounded-full bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="ri-camera-line text-3xl text-white"></i>
                                    </div>
                                </div>
                                <p class="mt-3 text-xs font-bold text-slate-400 dark:text-slate-500">Klik foto untuk mengubah</p>
                            </div>

                            {{-- Form --}}
                            <form action="{{ route('superadmin.profile.update') }}"
                                  method="POST"
                                  enctype="multipart/form-data"
                                  id="profile-form"
                                  class="space-y-5">
                                @csrf

                                <input type="file"
                                       id="photo-upload"
                                       name="photo"
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewPhoto(this)">

                                <div>
                                    <label class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">
                                        <i class="ri-user-line text-brand-purple text-xs"></i> Nama
                                    </label>
                                    <input type="text"
                                           name="username"
                                           class="form-input-modern"
                                           placeholder="Masukkan nama..."
                                           value="{{ old('username', $user->username) }}"
                                           required>
                                </div>

                                <div>
                                    <label class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">
                                        <i class="ri-mail-line text-brand-purple text-xs"></i> Email
                                    </label>
                                    <input type="email"
                                           name="email"
                                           class="form-input-modern"
                                           placeholder="Masukkan email..."
                                           value="{{ old('email', $user->email) }}"
                                           required>
                                </div>

                                <div>
                                    <label class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">
                                        <i class="ri-smartphone-line text-brand-purple text-xs"></i> Nomor Handphone
                                    </label>
                                    <input type="tel"
                                           name="nomor_hp"
                                           class="form-input-modern"
                                           placeholder="Masukkan nomor handphone..."
                                           value="{{ old('nomor_hp', $user->nomor_hp) }}"
                                           inputmode="numeric" pattern="[0-9]*" maxlength="13"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>

                                <div>
                                    <label class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">
                                        <i class="ri-lock-line text-brand-purple text-xs"></i> Password Baru
                                    </label>
                                    <input type="password"
                                           name="new_password"
                                           class="form-input-modern"
                                           placeholder="Masukkan password baru...">
                                    <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 mt-1.5">Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.</p>
                                </div>

                                <div>
                                    <label class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">
                                        <i class="ri-shield-check-line text-brand-purple text-xs"></i> Konfirmasi Password Baru
                                    </label>
                                    <input type="password"
                                           name="new_password_confirmation"
                                           class="form-input-modern"
                                           placeholder="Ulangi password baru...">
                                </div>

                                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-900 flex-wrap md:flex-col">
                                    <a href="{{ route('superadmin.dashboard.index') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-center">
                                        <i class="ri-arrow-left-line"></i> Batal
                                    </a>
                                    <button type="submit" class="btn-brand justify-center">
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
    <div class="fixed inset-0 z-50 bg-black/75 hidden items-center justify-center p-4 transition-all duration-300" id="cropModal">
        <div class="bg-white dark:bg-[#13111c] border border-slate-100 dark:border-slate-900 rounded-2xl p-7 max-w-3xl w-full max-h-[90vh] overflow-y-auto relative">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="ri-crop-line text-brand-purple"></i> Edit Foto Profil
                </h3>
                <button class="bg-none border-none text-2xl text-slate-400 hover:text-slate-600 cursor-pointer p-1" id="cropModalClose">&times;</button>
            </div>

            <div class="max-h-[420px] overflow-hidden mb-5 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-100 dark:border-slate-800">
                <img id="cropImage" src="" alt="Image to crop" class="max-w-full block">
            </div>

            <div class="mb-5 text-center">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Preview</p>
                <div class="w-[130px] h-[130px] overflow-hidden mx-auto rounded-full border-3 border-brand-purple" id="cropPreview"></div>
            </div>

            <div class="flex gap-2 justify-center flex-wrap mb-5">
                <button class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:border-brand-purple hover:text-brand-purple transition-all cursor-pointer" id="rotateLeft">
                    <i class="ri-anticlockwise-line"></i> Putar Kiri
                </button>
                <button class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:border-brand-purple hover:text-brand-purple transition-all cursor-pointer" id="rotateRight">
                    <i class="ri-clockwise-line"></i> Putar Kanan
                </button>
                <button class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:border-brand-purple hover:text-brand-purple transition-all cursor-pointer" id="flipHorizontal">
                    <i class="ri-flip-horizontal-line"></i> Flip H
                </button>
                <button class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:border-brand-purple hover:text-brand-purple transition-all cursor-pointer" id="flipVertical">
                    <i class="ri-flip-vertical-line"></i> Flip V
                </button>
                <button class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:border-brand-purple hover:text-brand-purple transition-all cursor-pointer" id="resetCrop">
                    <i class="ri-refresh-line"></i> Reset
                </button>
            </div>

            <div class="flex gap-3 justify-end pt-4 border-t border-slate-100 dark:border-slate-900 md:flex-col">
                <button class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer" id="cancelCrop">Batal</button>
                <button class="btn-brand justify-center cursor-pointer" id="applyCrop">
                    <i class="ri-check-line"></i> Gunakan Foto
                </button>
            </div>
        </div>
    </div>

    <canvas id="croppedCanvas" class="hidden"></canvas>

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
                    const m = document.getElementById('cropModal');
                    m.classList.remove('hidden');
                    m.classList.add('flex');
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
            const m = document.getElementById('cropModal');
            m.classList.add('hidden');
            m.classList.remove('flex');
            if (cropper) { cropper.destroy(); cropper = null; }
        }

        document.getElementById('cropModal').addEventListener('click', function(e) {
            if (e.target === this) closeCropModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('cropModal').classList.contains('hidden')) {
                closeCropModal();
            }
        });
    </script>
</body>

</html>