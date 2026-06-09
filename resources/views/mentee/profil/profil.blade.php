@extends('layouts.mentee.navbar')

@section('title', 'Profil Saya - Flodemi')

@section('content')
<section class="min-h-[calc(100vh-80px)] bg-gray-50/50 dark:bg-gray-950 py-12 transition-colors duration-300">
    <div class="container mx-auto px-4 lg:px-8">
        
        <div class="max-w-xl mx-auto">
            {{-- Toast Notifications --}}
            @if(session('success'))
            <div id="toast" class="mb-6 flex items-center gap-3 px-6 py-4 rounded-2xl bg-green-50 dark:bg-green-900/30 border border-green-100 dark:border-green-800 text-green-700 dark:text-green-400 shadow-sm transition-all animate-slide-in">
                <i class="ri-checkbox-circle-line text-xl"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white dark:bg-gray-900 rounded-[40px] shadow-xl shadow-gray-200/50 dark:shadow-black/40 border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-8 md:p-12">
                    <form action="{{ route('mentee.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- PHOTO UPLOAD --}}
                        <div class="relative group w-32 h-32 mx-auto mb-10">
                            <input type="file" name="photo" id="photoInput" accept="image/*" class="hidden">
                            <label for="photoInput" class="cursor-pointer block w-full h-full rounded-full border-4 border-white dark:border-gray-800 shadow-xl shadow-purple-100 dark:shadow-black/40 overflow-hidden relative z-10">
                                @if($user->photo)
                                    <img id="previewPhoto" src="{{ asset('storage/' . $user->photo) }}" class="w-full h-full object-cover">
                                @else
                                    <div id="avatarPlaceholder" class="w-full h-full bg-gradient-to-br from-brand-purple to-brand-purple-dark flex items-center justify-center text-white text-3xl font-bold">
                                        {{ strtoupper(substr($user->username, 0, 2)) }}
                                    </div>
                                    <img id="previewPhoto" src="" class="hidden w-full h-full object-cover">
                                @endif

                                {{-- Overlay on Hover --}}
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white text-[10px] font-bold uppercase tracking-wider">
                                    <i class="ri-camera-line text-xl mb-1"></i>
                                    Ubah Foto
                                </div>
                            </label>
                            
                            {{-- Pulse decoration --}}
                            <div class="absolute inset-0 bg-brand-purple-light dark:bg-brand-purple/10 rounded-full -z-0 animate-ping opacity-20 group-hover:animate-none"></div>
                        </div>

                        <div class="text-center mb-10">
                            <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">Pengaturan Profil</h2>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Perbarui informasi dasar akun kamu</p>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 ml-1">Username</label>
                                <div class="relative">
                                    <i class="ri-user-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-600"></i>
                                    <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                                           class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-transparent dark:border-gray-700 focus:border-brand-purple dark:focus:border-brand-purple focus:bg-white dark:focus:bg-gray-900 focus:ring-4 focus:ring-brand-purple/10 rounded-2xl transition-all outline-none font-medium text-gray-700 dark:text-gray-200"
                                           placeholder="Masukkan nama pengguna." required>
                                </div>
                                @error('username') <p class="text-xs text-red-500 mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 ml-1">Email</label>
                                <div class="relative">
                                    <i class="ri-mail-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-600"></i>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                           class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-transparent dark:border-gray-700 focus:border-brand-purple dark:focus:border-brand-purple focus:bg-white dark:focus:bg-gray-900 focus:ring-4 focus:ring-brand-purple/10 rounded-2xl transition-all outline-none font-medium text-gray-700 dark:text-gray-200"
                                           placeholder="Masukkan alamat email." required>
                                </div>
                                @error('email') <p class="text-xs text-red-500 mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 ml-1">Nomor Handphone (Opsional)</label>
                                <div class="relative">
                                    <i class="ri-phone-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-600"></i>
                                    <input type="tel" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" 
                                           class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-transparent dark:border-gray-700 focus:border-brand-purple dark:focus:border-brand-purple focus:bg-white dark:focus:bg-gray-900 focus:ring-4 focus:ring-brand-purple/10 rounded-2xl transition-all outline-none font-medium text-gray-700 dark:text-gray-200"
                                           placeholder="Masukkan nomor handphone">
                                </div>
                                @error('nomor_hp') <p class="text-xs text-red-500 mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div class="pt-4 border-t border-gray-50 dark:border-gray-800 mt-2">
                                <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 ml-1">Kata Sandi Baru (Opsional)</label>
                                <div class="relative">
                                    <i class="ri-lock-password-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-600"></i>
                                    <input type="password" name="password" 
                                           class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-transparent dark:border-gray-700 focus:border-brand-purple dark:focus:border-brand-purple focus:bg-white dark:focus:bg-gray-900 focus:ring-4 focus:ring-brand-purple/10 rounded-2xl transition-all outline-none font-medium text-gray-700 dark:text-gray-200"
                                           placeholder="Kosongkan jika tidak ingin mengubah.">
                                </div>
                                @error('password') <p class="text-xs text-red-500 mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                                <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-2 ml-1 leading-relaxed">Pastikan kata sandi minimal 8 karakter dengan kombinasi huruf dan angka.</p>
                            </div>
                        </div>

                        <div class="mt-12 flex items-center gap-4">
                            <a href="{{ route('mentee.dashboard') }}" 
                               class="flex-1 text-center py-4 text-gray-400 dark:text-gray-500 font-bold hover:text-gray-600 dark:hover:text-gray-300 transition-colors uppercase tracking-widest text-xs">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="flex-[2] py-4 bg-brand-purple hover:bg-brand-purple-dark text-white font-bold rounded-2xl transition-all shadow-purple-gradient hover:scale-[1.02] active:scale-95 uppercase tracking-widest text-xs">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    /* Custom Purple Gradient Shadow */
    .shadow-purple-gradient {
        box-shadow: 0 10px 25px -3px rgba(159, 102, 175, 0.3), 0 4px 12px -2px rgba(159, 102, 175, 0.2);
    }
    
    .dark .shadow-purple-gradient {
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.5), 0 4px 12px -2px rgba(159, 102, 175, 0.15);
    }

    @keyframes slide-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-in { animation: slide-in 0.3s ease-out forwards; }
</style>

{{-- FOOTER --}}
<!-- <footer class="bg-brand-purple pt-12 pb-6 text-white border-t border-white/10">
  <div class="container mx-auto px-4 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
      <div>
        <h6 class="font-bold text-sm mb-4">Tentang Kami</h6>
        <p class="text-[13px] opacity-80 leading-relaxed">
          PT. Flashsoft Indonesia<br>
          Jl. Naga Sakti, Kecamatan Tampan,<br>
          Pekanbaru, Riau, Indonesia
        </p>
      </div>
      <div class="text-left md:text-center">
        <h6 class="font-bold text-sm mb-4">Sosial Media</h6>
        <div class="flex justify-start md:justify-center gap-5 mt-2">
          <img src="{{ asset('assets/Instagram logo.png') }}" class="w-8 h-8 object-contain hover:scale-110 transition-transform">
          <img src="{{ asset('assets/Telegram logo.png') }}" class="w-8 h-8 object-contain hover:scale-110 transition-transform">
        </div>
      </div>
      <div class="text-left md:text-end">
        <h6 class="font-bold text-sm mb-4">Kontak</h6>
        <p class="flex items-center justify-start md:justify-end gap-2 text-[13px] opacity-80">
          <img src="{{ asset('assets/Whatsapp logo.png') }}" class="w-5 h-5 object-contain">
          +62 853-6838-4829
        </p>
      </div>
    </div>
    <hr class="border-white/20 my-10">
    <p class="text-center text-xs opacity-60">
      © Copyright 2026 || Flashsoft Indonesia
    </p>
  </div>
</footer> -->

<script>
    const inputPhoto = document.getElementById("photoInput");
    const previewPhoto = document.getElementById("previewPhoto");
    const placeholder = document.getElementById("avatarPlaceholder");

    if (inputPhoto) {
        inputPhoto.addEventListener("change", function () {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                previewPhoto.src = e.target.result;
                previewPhoto.classList.remove("hidden");
                if(placeholder) placeholder.classList.add("hidden");
            };
            reader.readAsDataURL(file);
        });
    }

    // Auto-hide toast
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-[-20px]');
            setTimeout(() => toast.remove(), 500);
        }, 3500);
    }
</script>
@endsection
