@extends('layouts.mentee.navbar')

@section('title', 'Checkout - ' . $kursus->judul)

@section('content')
<section class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen transition-colors duration-300">
  <div class="container mx-auto px-4 lg:px-8">
    
    {{-- ══════════ HEADER ══════════ --}}
    <div class="text-center mb-10 md:mb-16 mt-4">
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-purple/10 border border-brand-purple/20 text-brand-purple text-[10px] font-bold uppercase tracking-[0.15em] mb-6 shadow-sm">
          <span class="w-1.5 h-1.5 rounded-full bg-brand-purple"></span>
          Konfirmasi Pendaftaran Gratis
      </div>
      <h2 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white tracking-tight mb-4">
        Gabung <span class="text-brand-purple">Kelas Gratis</span>
      </h2>
      <p class="text-base md:text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed px-4">
        Selamat! Kursus <span class="font-bold text-gray-800 dark:text-gray-200">{{ $kursus->judul }}</span> tersedia secara gratis. Silakan konfirmasi untuk memulai belajar.
      </p>
    </div>

    <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-8 items-start">

      <div class="w-full lg:w-7/12 flex flex-col gap-6">
        
        {{-- Card Kontrak Belajar --}}
        <div class="bg-white dark:bg-gray-900 rounded-[32px] p-6 md:p-8 shadow-xl shadow-gray-100/50 dark:shadow-none border border-gray-100 dark:border-gray-800">
          <div class="flex items-center gap-4 mb-2">
            <div class="w-10 h-10 rounded-xl bg-brand-purple-light dark:bg-brand-purple/20 text-brand-purple flex items-center justify-center text-lg shadow-sm">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
                <h3 class="text-lg md:text-xl font-extrabold text-gray-900 dark:text-white">Kontrak Belajar</h3>
                <p class="text-[11px] md:text-sm text-gray-400 dark:text-gray-500 font-medium">Harap baca dan pahami ketentuan berikut</p>
            </div>
          </div>
          
          <div class="mt-6 md:mt-8 space-y-3 md:space-y-4">
            @php
              $rules = [
                'Gabung grup WhatsApp untuk mendapatkan informasi terbaru mengenai jadwal Live Session.',
                'Jadwal Live Session ditentukan sepenuhnya oleh Admin Flodemi.',
                'Tidak ada opsi reschedule untuk sesi Live Session yang terlewat.',
                'Dilarang keras menyebarkan atau membagikan materi untuk kebutuhan komersial.',
                'Selesaikan seluruh materi untuk mendapatkan e-Sertifikat kelulusan.'
              ];
            @endphp
            
            @foreach($rules as $rule)
            <div class="group flex items-start gap-3 md:gap-4 p-4 md:p-5 bg-white dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 border-l-4 border-l-brand-purple rounded-2xl shadow-sm transition-all hover:shadow-md hover:border-gray-200 dark:hover:border-gray-700">
              <div class="mt-0.5 flex items-center justify-center w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-green-500 text-green-500 bg-green-50 dark:bg-green-500/10 shrink-0 group-hover:bg-green-500 group-hover:text-white transition-colors">
                <i class="bi bi-check text-[10px] md:text-sm font-bold"></i>
              </div>
              <p class="text-[12px] md:text-[14px] text-gray-600 dark:text-gray-300 leading-relaxed font-medium">{{ $rule }}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="w-full lg:w-5/12 relative">
        <div class="bg-white dark:bg-gray-900 rounded-[32px] p-6 md:p-8 shadow-2xl shadow-purple-100/50 dark:shadow-none border border-gray-100 dark:border-gray-800 lg:sticky lg:top-28 before:absolute before:top-0 before:left-8 before:right-8 before:h-1 before:bg-gradient-to-r before:from-brand-purple before:to-emerald-400 before:rounded-b-full">
          
          <div class="flex items-center gap-3 mb-6 md:mb-8 pt-2">
            <i class="bi bi-gift text-lg md:text-xl text-brand-purple"></i>
            <h3 class="text-lg md:text-xl font-extrabold text-gray-900 dark:text-white">Info Kelas</h3>
          </div>

          <div class="bank-box text-center py-6 md:py-8 bg-gray-50 dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-800 mb-6 md:mb-8">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-brand-purple/10 dark:bg-brand-purple/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-gift-fill text-3xl md:text-4xl text-brand-purple"></i>
            </div>
            <h5 class="text-lg md:text-xl font-black text-brand-purple mb-2 tracking-tight">Kelas Ini Gratis!</h5>
            <p class="text-[11px] md:text-xs text-gray-500 dark:text-gray-400 px-4 md:px-6 leading-relaxed font-medium">
              Kamu bisa langsung bergabung ke kelas <span class="font-bold text-gray-800 dark:text-gray-200">{{ $kursus->judul }}</span> tanpa biaya apapun.
            </p>
          </div>

          <div class="flex justify-between items-center mb-6 md:mb-8 pb-5 md:pb-6 border-b border-gray-100 dark:border-gray-800 border-dashed">
            <span class="text-xs md:text-sm font-bold text-gray-900 dark:text-white">Total Harga</span>
            <span class="text-xl md:text-2xl font-black text-emerald-500 tracking-tighter">GRATIS</span>
          </div>

          <div class="flex items-start gap-3 mb-8 group">
            <input class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-brand-purple focus:ring-brand-purple cursor-pointer mt-0.5 transition-colors" type="checkbox" id="setuju">
            <label class="text-[11px] md:text-[12px] text-gray-500 dark:text-gray-400 leading-relaxed cursor-pointer" for="setuju">
              Saya telah membaca dan menyetujui <span class="font-bold text-brand-purple">Syarat & Ketentuan</span> belajar di Flodemi.
            </label>
          </div>

          <form action="{{ route('checkout.gratis', $kursus->id) }}" method="POST" id="formGratis">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-3 py-3.5 md:py-4 bg-gray-200 dark:bg-gray-800 text-gray-400 dark:text-gray-500 font-bold rounded-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed active:scale-[0.98] text-xs md:text-sm" 
                    id="btnGabung" 
                    disabled>
              <i class="bi bi-person-check-fill text-base md:text-lg"></i>
              Gabung Kelas Sekarang
            </button>
          </form>

          <div class="mt-8 flex justify-center items-center gap-2 text-gray-400 dark:text-gray-500 text-[9px] md:text-[10px] font-bold uppercase tracking-widest">
              <i class="bi bi-shield-check"></i>
              Akses Langsung & Selamanya
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<script>
  document.getElementById('setuju').addEventListener('change', function () {
    const btn = document.getElementById('btnGabung');
    btn.disabled = !this.checked;
    if(this.checked) {
        btn.classList.add('bg-brand-purple', 'hover:bg-brand-purple-dark', 'text-white', 'shadow-xl', 'shadow-purple-200', 'dark:shadow-none');
        btn.classList.remove('bg-gray-200', 'dark:bg-gray-800', 'text-gray-400', 'dark:text-gray-500');
    } else {
        btn.classList.remove('bg-brand-purple', 'hover:bg-brand-purple-dark', 'text-white', 'shadow-xl', 'shadow-purple-200', 'dark:shadow-none');
        btn.classList.add('bg-gray-200', 'dark:bg-gray-800', 'text-gray-400', 'dark:text-gray-500');
    }
  });
</script>
@endsection
