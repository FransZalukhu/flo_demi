<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>chekout - Flodemi</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/checkout_berhasil.css') }}">
</head>

<body>

  <!-- NAVBAR -->
  @include('layouts.mentee.navbar')

  <!-- ================= CHECKOUT CONTENT ================= -->
  <section class="py-5">
    <div class="container">

      <!-- TITLE -->
      <div class="text-center mb-3">
        <h2 class="fw-bold text-purple">Checkout Kelas</h2>
        <p class="text-muted small">
          Bergabung dengan kami di kelas Premium dan membangun sebuah real-world project
        </p>
      </div>

      <div class="checkout-divider"></div>

      <div class="row g-4 justify-content-center">

        <!-- KONTRAK BELAJAR -->
        <div class="col-lg-5">
          <div class="contract-card">

            <div class="contract-title">Kontrak Belajar</div>

            <div class="contract-list">
              <div class="contract-item">
                <img src="assets/1.png" loading="lazy">
                <p>Gabung grup WhatsApp untuk informasi Live Session</p>
                <i class="bi bi-check-circle-fill"></i>
              </div>

              <div class="contract-item">
                <img src="assets/2.png" loading="lazy">
                <p>Jadwal Live Session ditentukan oleh Admin Flodemi</p>
                <i class="bi bi-check-circle-fill"></i>
              </div>

              <div class="contract-item">
                <img src="assets/3.png" loading="lazy">
                <p>Tidak ada reschedule untuk sesi Live Session</p>
                <i class="bi bi-check-circle-fill"></i>
              </div>

              <div class="contract-item">
                <img src="assets/4.png" loading="lazy">
                <p>Dilarang menyebarkan e-Module untuk kebutuhan komersial tanpa izin</p>
                <i class="bi bi-check-circle-fill"></i>
              </div>

              <div class="contract-item">
                <img src="assets/4.png" loading="lazy">
                <p>Silakan unduh e-Sertifikat jika sudah menyelesaikan semua e-Module</p>
                <i class="bi bi-check-circle-fill"></i>
              </div>
            </div>

          </div>
        </div>

        

        <div class="col-lg-5">
          <div class="payment-card">

            <div class="payment-title">Metode Pembayaran</div>

            <div class="bank-box">
              <h6>Transfer Bank</h6>

              <div class="bank-info">
                <img src="assets/bca.png" alt="BCA" loading="lazy">
                <div>
                  <p class="rekening">1111-2222-3333-4444</p>
                  <p class="nama">a/n Yura Lisera</p>
                </div>
              </div>

            </div>

            <hr class="divider-ungu">

            <div class="total-row">
              <span class="total-text">Total</span>
              <span class="total-price">Rp299.000,00</span>
            </div>

            <p class="info-text" style="text-align: center; margin-top: 20px;">
  Silakan kirim bukti pembayaran Anda pada WhatsApp berikut!
</p>


            <div class="wa-wrapper">
              <a href="#" class="btn-wa">
                <img src="assets/Whatsapp logo.png" alt="" loading="lazy">
                Kirim disini
              </a>
            </div>


            <div class="form-check mt-3">
              <input class="form-check-input" type="checkbox">
              <label class="form-check-label small">
                Saya setuju dengan --<b>syarat dan ketentuan</b>
              </label>
            </div>

            <button class="btn-confirm" disabled>
              Konfirmasi Bayar & Gabung Kelas
            </button>

          </div>
        </div>


      </div>
    </div>
  </section>


 <footer class="footer-section mt-auto">
  <div class="container py-4">
    <div class="row text-white">
      
      <div class="col-md-4 mb-4 mb-md-0">
        <h6 class="fw-bold">Tentang Kami</h6>
        <p class="mb-1">PT. Flashsoft Indonesia</p>
        <p class="mb-0">
          Jl. Naga Sakti, Kecamatan Tampan,<br>
          Pekanbaru, Riau, Indonesia
        </p>
      </div>

      <div class="col-md-4 text-center">
        <h6 class="fw-bold">Sosial Media</h6>
        <div class="d-flex justify-content-center gap-3 mt-2">
          <img src="{{ asset('assets/Instagram logo.png') }}" class="footer-icon" loading="lazy">
          <img src="{{ asset('assets/Telegram logo.png') }}" class="footer-icon" loading="lazy">
        </div>
      </div>

      <div class="col-md-4 text-md-end">
        <h6 class="fw-bold">Kontak</h6>
        <p>
          <img src="{{ asset('assets/Whatsapp logo.png') }}" class="footer-icon-sm" loading="lazy">
          +62 853-6838-4829
        </p>
      </div>

    </div>

    <hr class="footer-line">

    <p class="text-center text-white small mb-0">
      © Copyright 2026 || Flashsoft Indonesia
    </p>
  </div>
</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>