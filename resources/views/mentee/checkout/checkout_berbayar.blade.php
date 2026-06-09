@extends('layouts.mentee.navbar')

@section('title', 'Checkout - ' . $kursus->judul)

@section('content')
<section class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen transition-colors duration-300">
  <div class="container mx-auto px-4 lg:px-8">
    
    {{-- ══════════ HEADER ══════════ --}}
    <div class="text-center mb-10 md:mb-16 mt-4">
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-purple/10 border border-brand-purple/20 text-brand-purple text-[10px] font-bold uppercase tracking-[0.15em] mb-6 shadow-sm">
          <span class="w-1.5 h-1.5 rounded-full bg-brand-purple"></span>
          Selesaikan Pendaftaran Anda
      </div>
      <h2 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white tracking-tight mb-4">
        Konfirmasi & <span class="text-brand-purple">Pembayaran</span>
      </h2>
      <p class="text-base md:text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed px-4">
        Tinggal selangkah lagi! Selesaikan proses checkout untuk mendapatkan akses penuh ke kursus <span class="font-bold text-gray-800 dark:text-gray-200">{{ $kursus->judul }}</span>.
      </p>
    </div>

    <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-8 items-start">

      {{-- ══════════ KIRI: KONTRAK BELAJAR ══════════ --}}
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
                'Gabung grup WhatsApp eksklusif untuk mendapatkan informasi terbaru mengenai jadwal Live Session.',
                'Jadwal Live Session ditentukan sepenuhnya oleh Admin Flodemi.',
                'Tidak ada opsi reschedule untuk sesi Live Session yang terlewat oleh mentee.',
                'Dilarang keras menyebarkan atau membagikan materi untuk kebutuhan komersial.',
                'Berhak mengunduh e-Sertifikat kelulusan setelah menyelesaikan seluruh materi.'
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

        {{-- Card Bantuan --}}
        <div class="bg-gray-900 dark:bg-brand-purple/20 rounded-[24px] p-5 md:p-6 shadow-xl flex items-center justify-between group cursor-pointer transition-transform hover:-translate-y-1 hover:shadow-2xl border border-transparent dark:border-brand-purple/30">
            <div class="flex items-center gap-4">
                <div class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-white/10 text-white flex items-center justify-center text-base md:text-lg backdrop-blur-sm">
                    <i class="bi bi-question-circle"></i>
                </div>
                <div>
                    <h4 class="text-white font-bold text-xs md:text-sm">Butuh Bantuan?</h4>
                    <p class="text-gray-400 dark:text-gray-300 text-[10px] md:text-xs mt-0.5">Baca FAQ kami terkait pembayaran</p>
                </div>
            </div>
            <i class="bi bi-chevron-right text-gray-500 group-hover:text-white transition-colors text-xs"></i>
        </div>

      </div>

      {{-- ══════════ KANAN: RINGKASAN PESANAN ══════════ --}}
      <div class="w-full lg:w-5/12 relative">
        <div class="bg-white dark:bg-gray-900 rounded-[32px] p-6 md:p-8 shadow-2xl shadow-purple-100/50 dark:shadow-none border border-gray-100 dark:border-gray-800 lg:sticky lg:top-28 before:absolute before:top-0 before:left-8 before:right-8 before:h-1 before:bg-gradient-to-r before:from-brand-purple before:to-blue-400 before:rounded-b-full">
          
          <div class="flex items-center gap-3 mb-6 md:mb-8 pt-2">
            <i class="bi bi-cart3 text-lg md:text-xl text-gray-400 dark:text-gray-500"></i>
            <h3 class="text-lg md:text-xl font-extrabold text-gray-900 dark:text-white">Ringkasan Pesanan</h3>
          </div>

          {{-- Course Preview --}}
          <div class="flex gap-4 p-3 md:p-4 rounded-2xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 mb-6 md:mb-8">
              <div class="w-16 h-16 md:w-20 md:h-20 rounded-xl overflow-hidden shrink-0 shadow-sm border border-gray-200 dark:border-gray-700">
                  <img src="{{ $kursus->gambar ? asset('storage/' . $kursus->gambar) : asset('assets/course.png') }}" class="w-full h-full object-cover">
              </div>
              <div class="flex-1 flex flex-col justify-center">
                  <h4 class="text-xs md:text-sm font-bold text-gray-900 dark:text-white line-clamp-2 leading-snug mb-1.5 md:mb-2 group-hover:text-brand-purple transition-colors">{{ $kursus->judul }}</h4>
                  <div class="flex items-center gap-3 text-[9px] md:text-[10px] font-bold text-gray-500 dark:text-gray-400">
                      <span class="flex items-center gap-1 text-amber-500"><i class="bi bi-star-fill"></i> 4.9</span>
                      <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                      <span><i class="bi bi-people-fill mr-1"></i> 1.2k Mentee</span>
                  </div>
              </div>
          </div>

          {{-- Metode Pembayaran --}}
          <div class="mb-6 md:mb-8">
            <h6 class="text-[9px] md:text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.15em] mb-4">Metode Pembayaran</h6>
            <div class="border border-gray-200 dark:border-gray-800 rounded-2xl p-4 md:p-5 bg-white dark:bg-gray-800 relative overflow-hidden">
              <div class="absolute top-0 left-0 w-1 h-full bg-blue-500"></div>
              
              <div class="flex items-center gap-3 mb-4">
                  <div class="w-7 h-7 md:w-8 md:h-8 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                      <i class="bi bi-bank text-xs md:text-sm"></i>
                  </div>
                  <div>
                      <h5 class="text-xs md:text-sm font-bold text-gray-900 dark:text-white">Transfer Bank / VA</h5>
                      <p class="text-[9px] md:text-[10px] text-gray-400 dark:text-gray-500">Transfer manual via ATM / M-Banking</p>
                  </div>
              </div>

              <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-3 md:p-4 border border-gray-100 dark:border-gray-800 flex items-end justify-between gap-2">
                  <div class="overflow-hidden">
                      <p class="text-[9px] md:text-[10px] text-gray-500 dark:text-gray-400 mb-1">Nomor Rekening</p>
                      <p class="text-base md:text-xl font-black text-gray-900 dark:text-white tracking-tight font-mono truncate">1111-2222-3333-4444</p>
                      <p class="text-[9px] md:text-[10px] text-gray-500 dark:text-gray-400 mt-1">a/n <span class="font-bold text-gray-700 dark:text-gray-300 uppercase">Flashsoft Indonesia</span></p>
                  </div>
                  <button class="text-[10px] md:text-[11px] font-bold text-brand-purple flex items-center gap-1.5 hover:bg-brand-purple-light dark:hover:bg-brand-purple/20 px-2 py-1.5 rounded transition-colors bg-brand-purple/5" onclick="navigator.clipboard.writeText('1111222233334444'); alert('Nomor rekening disalin!')">
                      <i class="bi bi-copy"></i> Salin
                  </button>
              </div>
            </div>
          </div>

          {{-- Rincian Harga --}}
          <div class="space-y-3 mb-6 pb-6 border-b border-gray-100 dark:border-gray-800 border-dashed">
              <div class="flex justify-between items-center text-xs md:text-sm">
                  <span class="text-gray-500 dark:text-gray-400 font-medium">Harga Normal</span>
                  <span class="text-gray-900 dark:text-gray-200 font-bold">Rp{{ number_format($kursus->harga * 2, 0, ',', '.') }}</span>
              </div>
              <div class="flex justify-between items-center text-xs md:text-sm">
                  <span class="text-gray-500 dark:text-gray-400 font-medium">Diskon Event (50%)</span>
                  <span class="text-emerald-500 font-bold">-Rp{{ number_format($kursus->harga, 0, ',', '.') }}</span>
              </div>
          </div>

          <div class="flex justify-between items-end mb-8">
              <div>
                  <h4 class="text-xs md:text-sm font-bold text-gray-900 dark:text-white">Total Pembayaran</h4>
                  <p class="text-[9px] md:text-[10px] text-gray-400 dark:text-gray-500 mt-0.5">Termasuk pajak</p>
              </div>
              <span class="text-2xl md:text-3xl font-black text-brand-purple tracking-tighter">Rp{{ number_format($kursus->harga, 0, ',', '.') }}</span>
          </div>

          {{-- Info & Action --}}
          <div class="bg-amber-50 dark:bg-amber-500/10 border border-amber-200/60 dark:border-amber-500/20 rounded-xl p-3 md:p-4 flex gap-3 mb-6">
              <i class="bi bi-info-circle-fill text-amber-500 text-xs md:text-sm mt-0.5"></i>
              <p class="text-[11px] md:text-xs text-amber-800 dark:text-amber-200/80 leading-relaxed font-medium">
                  Setelah transfer, silakan kirim bukti pembayaran melalui WhatsApp untuk konfirmasi.
              </p>
          </div>

          <a href="https://wa.me/6281996663358?text={{ urlencode('Hallo Admin Flodemi, Saya ' . auth()->user()->username . ' ingin mengirim bukti pembayaran terkait kursus ' . $kursus->judul . ' senilai Rp' . number_format($kursus->harga, 0, ',', '.') . ',-') }}"
             target="_blank" 
             class="w-full flex items-center justify-center gap-2 py-3 md:py-3.5 bg-[#00A859] hover:bg-[#00964F] text-white font-bold rounded-xl transition-all shadow-lg shadow-green-200/50 dark:shadow-none active:scale-[0.98] mb-6 text-sm">
              <i class="bi bi-whatsapp"></i>
              Kirim Bukti Pembayaran
          </a>

          {{-- Form & Checkbox --}}
          <div class="flex items-start gap-3 mb-6 group">
            <input class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-brand-purple focus:ring-brand-purple cursor-pointer mt-0.5 transition-colors" type="checkbox" id="setuju">
            <label class="text-[10px] md:text-[11px] text-gray-500 dark:text-gray-400 leading-relaxed cursor-pointer" for="setuju">
              Saya telah membaca dan menyetujui <a href="#" class="font-bold text-brand-purple hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="font-bold text-brand-purple hover:underline">Kebijakan Privasi</a>.
            </label>
          </div>

          <form action="{{ route('checkout.berbayar', $kursus->id) }}" method="POST" id="formBerbayar">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-2 py-3.5 md:py-4 bg-gray-900 dark:bg-gray-800 hover:bg-black dark:hover:bg-gray-700 text-white font-bold rounded-xl transition-all shadow-xl shadow-gray-200 dark:shadow-none disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:shadow-none active:scale-[0.98] text-xs md:text-sm" 
                    id="btnKonfirmasi" 
                    disabled>
              Selesaikan Pesanan <i class="bi bi-arrow-right"></i>
            </button>
          </form>

          <div class="mt-6 flex justify-center items-center gap-2 text-gray-400 dark:text-gray-500 text-[9px] md:text-[10px] font-bold uppercase tracking-widest">
              <i class="bi bi-shield-lock-fill"></i>
              Pembayaran Aman & Terenkripsi
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<script>
  document.getElementById('setuju').addEventListener('change', function () {
    const btn = document.getElementById('btnKonfirmasi');
    btn.disabled = !this.checked;
    if(this.checked) {
        btn.classList.add('bg-brand-purple', 'hover:bg-brand-purple-dark', 'shadow-purple-200');
        btn.classList.remove('bg-gray-900', 'hover:bg-black', 'shadow-gray-200');
    } else {
        btn.classList.remove('bg-brand-purple', 'hover:bg-brand-purple-dark', 'shadow-purple-200');
        btn.classList.add('bg-gray-900', 'hover:bg-black', 'shadow-gray-200');
    }
  });
</script>
@endsection