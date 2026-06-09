@extends('layouts.mentee.navbar')

@section('title', 'Invoice Pembayaran - Flodemi')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] dark:bg-gray-950 py-12 px-6">
    <div class="max-w-4xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Invoice Pembayaran</h2>
                <p class="text-slate-500 dark:text-gray-400 text-sm">ID Pembayaran: <span class="font-bold text-slate-700 dark:text-gray-200">#PAY-{{ $payment->id }}</span></p>
            </div>
            
            <div class="flex flex-col items-end">
                @php
                    $isExpired = $payment->expired_at && $payment->expired_at->isPast();
                    $statusConfig = match($payment->status) {
                        'pending' => $isExpired 
                            ? ['bg' => 'bg-red-100 text-red-700 border-red-200', 'text' => 'Expired']
                            : ['bg' => 'bg-amber-100 text-amber-700 border-amber-200', 'text' => 'Belum Bayar'],
                        'waiting' => ['bg' => 'bg-blue-100 text-blue-700 border-blue-200', 'text' => 'Verifikasi'],
                        'failed'  => ['bg' => 'bg-red-100 text-red-700 border-red-200', 'text' => 'Ditolak'],
                        'success' => ['bg' => 'bg-green-100 text-green-700 border-green-200', 'text' => 'Berhasil'],
                    };
                @endphp
                <span class="px-4 py-2 {{ $statusConfig['bg'] }} border rounded-full text-xs font-black uppercase tracking-widest shadow-sm">
                    {{ $statusConfig['text'] }}
                </span>
            </div>
        </div>

        {{-- Countdown Section --}}
        @if($payment->status === 'pending' || $payment->status === 'failed')
            @if(!$isExpired)
            <div class="mb-8 p-6 bg-white dark:bg-gray-900 border border-slate-100 dark:border-gray-800 rounded-[2.5rem] shadow-sm flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-2 h-full bg-amber-400"></div>
                <div class="flex items-center gap-5 text-center md:text-left relative z-10">
                    <div class="w-14 h-14 bg-amber-50 dark:bg-amber-900/20 rounded-2xl flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                        <i class="ri-time-line text-3xl animate-pulse"></i>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Selesaikan Pembayaran Sebelum</h4>
                        <p class="text-lg font-black text-slate-900 dark:text-white leading-none">
                            {{ $payment->expired_at->translatedFormat('d F Y, H:i') }} <span class="text-slate-400">WIB</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex gap-3 relative z-10" id="countdown-timer" data-expiry="{{ $payment->expired_at->toIso8601String() }}">
                    <div class="flex flex-col items-center min-w-[64px]">
                        <span class="text-2xl font-black text-brand-purple" id="cd-hours">00</span>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Jam</span>
                    </div>
                    <div class="text-2xl font-black text-slate-200 dark:text-gray-800">:</div>
                    <div class="flex flex-col items-center min-w-[64px]">
                        <span class="text-2xl font-black text-brand-purple" id="cd-minutes">00</span>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Menit</span>
                    </div>
                    <div class="text-2xl font-black text-slate-200 dark:text-gray-800">:</div>
                    <div class="flex flex-col items-center min-w-[64px]">
                        <span class="text-2xl font-black text-brand-purple" id="cd-seconds">00</span>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Detik</span>
                    </div>
                </div>
            </div>
            @else
            <div class="mb-8 p-8 bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/30 rounded-[2.5rem] text-center">
                <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ri-error-warning-line text-3xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-black text-red-900 dark:text-red-400 mb-2 uppercase tracking-tight">Waktu Pembayaran Habis</h3>
                <p class="text-sm text-red-700 dark:text-red-300 font-medium max-w-md mx-auto leading-relaxed">
                    Mohon maaf, batas waktu pembayaran Anda telah berakhir. Silakan hubungi Admin atau lakukan pendaftaran ulang untuk mendapatkan kode pembayaran baru.
                </p>
            </div>
            @endif
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                {{-- Detail Course --}}
                <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-gray-800 shadow-sm">
                    <h5 class="text-sm font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-6">Ringkasan Pesanan</h5>
                    <div class="flex gap-6 items-center">
                        <div class="w-24 h-24 rounded-2xl overflow-hidden flex-shrink-0 bg-slate-100 dark:bg-gray-800">
                            <img src="{{ asset('storage/' . $payment->kursus->gambar) }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">{{ $payment->kursus->judul }}</h4>
                            <p class="text-2xl font-black text-brand-purple">Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Instruksi Pembayaran --}}
                <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-gray-800 shadow-sm">
                    <h5 class="text-sm font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-6">Instruksi Pembayaran</h5>
                    
                    <div class="space-y-8">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 font-bold shrink-0">1</div>
                            <div class="flex-1">
                                <p class="text-slate-600 dark:text-gray-400 text-sm leading-relaxed mb-4">Lakukan transfer sebesar <span class="font-black text-slate-900 dark:text-white">Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</span> ke salah satu rekening berikut:</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    {{-- BCA --}}
                                    <div class="p-5 bg-slate-50 dark:bg-gray-800/50 rounded-2xl border border-slate-100 dark:border-gray-800 hover:border-brand-purple transition-all group">
                                        <div class="flex items-center gap-3 mb-3">
                                            <img src="{{ asset('assets/bca.png') }}" class="h-5 object-contain">
                                            <span class="text-xs font-bold text-slate-900 dark:text-white">BCA</span>
                                        </div>
                                        <div class="flex justify-between items-center bg-white dark:bg-gray-900 p-3 rounded-xl border dark:border-gray-700">
                                            <span class="text-sm font-mono font-bold text-slate-700 dark:text-gray-300" id="rek-bca">1234567890</span>
                                            <button onclick="copyToClipboard('1234567890', this)" class="text-brand-purple hover:scale-110 transition-transform">
                                                <i class="ri-file-copy-line"></i>
                                            </button>
                                        </div>
                                        <p class="text-[10px] text-slate-400 font-bold mt-2 uppercase tracking-tighter">A/N Flodemi Indonesia</p>
                                    </div>

                                    {{-- Mandiri --}}
                                    <div class="p-5 bg-slate-50 dark:bg-gray-800/50 rounded-2xl border border-slate-100 dark:border-gray-800 hover:border-brand-purple transition-all group">
                                        <div class="flex items-center gap-3 mb-3">
                                            <img src="{{ asset('assets/livin.png') }}" class="h-5 object-contain">
                                            <span class="text-xs font-bold text-slate-900 dark:text-white">Mandiri</span>
                                        </div>
                                        <div class="flex justify-between items-center bg-white dark:bg-gray-900 p-3 rounded-xl border dark:border-gray-700">
                                            <span class="text-sm font-mono font-bold text-slate-700 dark:text-gray-300" id="rek-mandiri">0987654321</span>
                                            <button onclick="copyToClipboard('0987654321', this)" class="text-brand-purple hover:scale-110 transition-transform">
                                                <i class="ri-file-copy-line"></i>
                                            </button>
                                        </div>
                                        <p class="text-[10px] text-slate-400 font-bold mt-2 uppercase tracking-tighter">A/N Flodemi Indonesia</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 font-bold shrink-0">2</div>
                            <div>
                                <p class="text-slate-600 dark:text-gray-400 text-sm leading-relaxed">Pastikan nominal transfer sesuai dan simpan bukti transfer (Screenshot/Foto).</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 font-bold shrink-0">3</div>
                            <div>
                                <p class="text-slate-600 dark:text-gray-400 text-sm leading-relaxed">Upload bukti transfer melalui form di samping. Admin akan memverifikasi secepatnya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Upload --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-gray-800 shadow-xl sticky top-24">
                    <h5 class="text-sm font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-6">Konfirmasi Pembayaran</h5>
                    
                    @if($payment->status === 'waiting')
                        <div class="text-center">
                            <div class="w-20 h-20 bg-blue-50 dark:bg-blue-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="ri-time-line text-4xl text-blue-600 animate-pulse"></i>
                            </div>
                            <h6 class="font-black text-slate-900 dark:text-white mb-2 uppercase tracking-tight">Verifikasi Berlangsung</h6>
                            <p class="text-xs text-slate-500 dark:text-gray-400 leading-relaxed mb-6">Bukti sudah diterima. Admin akan memverifikasi dalam maksimal 1x24 jam.</p>
                            
                            @if($payment->bukti)
                            <div class="mt-6 pt-6 border-t border-slate-100 dark:border-gray-800">
                                <p class="text-[10px] text-slate-400 font-black uppercase mb-3 tracking-widest">Bukti Terkirim:</p>
                                <a href="{{ asset('storage/' . $payment->bukti) }}" target="_blank" class="block group relative rounded-2xl overflow-hidden border-2 border-slate-100 dark:border-gray-800">
                                    <img src="{{ asset('storage/' . $payment->bukti) }}" class="w-full h-32 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-brand-purple/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="ri-zoom-in-line text-white text-2xl"></i>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                    @else
                        @if($isExpired)
                            <div class="text-center py-6">
                                <div class="w-20 h-20 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <i class="ri-close-circle-line text-4xl text-red-600"></i>
                                </div>
                                <h6 class="font-black text-slate-900 dark:text-white mb-2 uppercase tracking-tight">Pembayaran Expired</h6>
                                <p class="text-xs text-slate-500 dark:text-gray-400 leading-relaxed">Form dinonaktifkan karena waktu sudah habis.</p>
                            </div>
                        @else
                            <form action="{{ route('mentee.pembayaran.uploadBukti', $payment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="uploadForm">
                                @csrf
                                
                                @if($payment->catatan_admin)
                                    <div class="p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-r-2xl">
                                        <p class="text-[10px] font-black text-red-600 dark:text-red-400 uppercase mb-1">Ditolak oleh Admin:</p>
                                        <p class="text-xs text-red-700 dark:text-red-300 font-bold leading-relaxed">{{ $payment->catatan_admin }}</p>
                                    </div>
                                @endif

                                <div class="space-y-4">
                                    <label class="block">
                                        <span class="text-xs font-black text-slate-500 dark:text-gray-400 mb-3 block uppercase tracking-widest">Upload Bukti Transfer</span>
                                        <div class="relative group">
                                            <input type="file" name="bukti" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewFile(this)">
                                            <div id="dropzone" class="border-2 border-dashed border-slate-200 dark:border-gray-800 rounded-3xl p-8 text-center transition-all group-hover:border-brand-purple group-hover:bg-brand-purple/5 min-h-[160px] flex flex-col items-center justify-center">
                                                
                                                <div id="preview-container" class="hidden w-full h-32 mb-4 rounded-xl overflow-hidden border-2 border-brand-purple/20">
                                                    <img id="image-preview" src="#" class="w-full h-full object-cover">
                                                </div>

                                                <div id="upload-placeholder">
                                                    <i class="ri-image-add-line text-4xl text-slate-300 group-hover:text-brand-purple mb-2 block transition-colors"></i>
                                                    <span class="text-xs text-slate-400 font-bold block" id="fileName">Pilih File...</span>
                                                    <p class="text-[10px] text-slate-300 mt-1 uppercase font-bold">JPG, PNG (Maks 5MB)</p>
                                                </div>

                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <button type="submit" id="btnSubmit" class="w-full py-4 bg-brand-purple text-white font-black rounded-2xl shadow-purple-gradient hover:scale-[1.02] active:scale-95 transition-all text-sm uppercase tracking-widest flex items-center justify-center gap-2">
                                    <span id="btnText">Kirim Bukti</span>
                                    <div id="btnLoading" class="hidden w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                                </button>
                            </form>
                        @endif
                    @endif

                    <div class="mt-8 pt-8 border-t border-slate-50 dark:border-gray-800">
                        <p class="text-[10px] text-center text-slate-400 dark:text-gray-500 font-black uppercase mb-4 tracking-widest">Ada Kendala?</p>
                        <a href="https://wa.me/6281996663358" target="_blank" class="flex items-center justify-center gap-2 text-green-600 font-bold text-sm hover:underline hover:scale-105 transition-transform">
                            <i class="ri-whatsapp-line text-xl"></i>
                            Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const countdownEl = document.getElementById('countdown-timer');
        if (countdownEl) {
            const expiryDate = new Date(countdownEl.dataset.expiry).getTime();
            
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = expiryDate - now;
                
                if (distance < 0) {
                    clearInterval(timer);
                    window.location.reload();
                    return;
                }
                
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                document.getElementById('cd-hours').innerText = hours.toString().padStart(2, '0');
                document.getElementById('cd-minutes').innerText = minutes.toString().padStart(2, '0');
                document.getElementById('cd-seconds').innerText = seconds.toString().padStart(2, '0');

                // Urgency coloring
                if (distance < (1000 * 60 * 60)) { // Less than 1 hour
                    const timerContainer = document.getElementById('countdown-timer');
                    timerContainer.querySelectorAll('span.text-brand-purple').forEach(el => {
                        el.classList.replace('text-brand-purple', 'text-red-500');
                    });
                }
            }, 1000);
        }
    });

    function previewFile(input) {
        const file = input.files[0];
        const fileName = document.getElementById('fileName');
        const dropzone = document.getElementById('dropzone');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');

        if (file) {
            fileName.innerText = file.name;
            dropzone.classList.add('border-brand-purple', 'bg-brand-purple/5');
            
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                placeholder.classList.add('mt-4');
            }
            reader.readAsDataURL(file);
        }
    }

    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const icon = btn.querySelector('i');
            icon.classList.replace('ri-file-copy-line', 'ri-check-line');
            icon.classList.add('text-green-500');
            
            setTimeout(() => {
                icon.classList.replace('ri-check-line', 'ri-file-copy-line');
                icon.classList.remove('text-green-500');
            }, 2000);
        });
    }

    const form = document.getElementById('uploadForm');
    if(form) {
        form.onsubmit = function() {
            const btn = document.getElementById('btnSubmit');
            const text = document.getElementById('btnText');
            const loading = document.getElementById('btnLoading');

            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
            text.innerText = 'Mengirim...';
            loading.classList.remove('hidden');
        };
    }
</script>
@endsection
