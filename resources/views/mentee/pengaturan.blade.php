<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaturan - Flodemi</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="pengaturan.css">
</head>

<body>

<!-- NAVBAR -->
@include('layouts.mentee.navbar')

<!-- ================= PENGATURAN ================= -->
<section class="settings-section">
  <div class="container">

    <!-- JUDUL -->
    <div class="settings-header">
      <h2 class="settings-title">Pengaturan</h2>
      <p class="settings-subtitle">
        Silakan kelola pengaturan aplikasi dan referensi Anda!
      </p>
    </div>

    <!-- CARD -->
    <div class="settings-card">

      <h5 class="card-title fw-bold">Pengaturan Tampilan</h5>

      <!-- TEMA -->
      <div class="settings-group">
        <label class="group-label fw-bold">Tema</label>

        <div class="theme-options">
          <div class="theme-box">
            <i class="bi bi-cloud"></i>
            <span>Auto</span>
          </div>
          <div class="theme-box">
            <i class="bi bi-sun"></i>
            <span>Terang</span>
          </div>
          <div class="theme-box">
            <i class="bi bi-moon"></i>
            <span>Gelap</span>
          </div>
        </div>
      </div>

      <!-- UKURAN TEKS -->
      <div class="settings-group">
        <label class="group-label fw-bold">Ukuran Teks</label>

        <div class="text-size">
          <span>Kecil</span>
          <input type="range" min="1" max="3" value="2">
          <span>Besar</span>
        </div>
      </div>

    </div>

    <!-- ACTION -->
    <div class="settings-actions">
      <button class="btn btn-abu">Batal</button>
      <button class="btn btn-purple text-white">Simpan</button>
    </div>

  </div>
</section>


<!-- FOOTER -->
  <footer class="footer-section">
    <div class="container">
      <div class="row text-white">

        <!-- Tentang Kami -->
        <div class="col-md-4 mb-4 mb-md-0">
          <h6 class="fw-bold">Tentang Kami</h6>
          <p class="mb-1">PT. Flashsoft Indonesia</p>
          <p class="mb-0">
            Jl. Naga Sakti, Kecamatan Tampan,<br>
            Pekanbaru, Riau, Indonesia
          </p>
        </div>

        <!-- Sosial Media -->
        <div class="col-md-4 mb-4 mb-md-0 text-md-center">
          <h6 class="fw-bold">Sosial Media</h6>
          <div class="d-flex justify-content-md-center gap-3 mt-2">
            <img src="assets/Instagram logo.png" alt="Instagram" class="footer-icon" loading="lazy">
            <img src="assets/Telegram logo.png" alt="Telegram" class="footer-icon" loading="lazy">
            </div>
            </div>
            <div class="col-md-4 text-md-end">
            <h6 class="fw-bold">Kontak</h6>
            <p>
            <img src="assets/Whatsapp logo.png" class="footer-icon-sm" loading="lazy">
            +62 853-6838-4829
            </p>
            </div>
          </p>
        </div>

      </div>

      <hr class="footer-line">

      <p class="text-center mb-0 text-white">
        © Copyright 2025 || Flashsoft Indonesia
      </p>
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
