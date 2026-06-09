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
    <link rel="stylesheet" href="sudah memilih course.css">
</head>

<body>

    <!-- NAVBAR -->
    @include('layouts.mentee.navbar')


    <!-- MAIN CONTENT -->
    <section class="course-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-profile">
                <div class="avatar">ZR</div>
                <p class="name">Zikra Rahmadani</p>
            </div>

            <ul class="sidebar-menu">
                <li class="active">
                    <i class="bi bi-book"></i>
                    <span>Course Saya</span>
                </li>
            </ul>
        </aside>

        <!-- CONTENT -->
        <main class="course-content">
            <h2 class="content-title">Course Saya</h2>
            <p class="content-subtitle">
                Belajar skill digital dari mentor berpengalaman dan mulai bangun karir impianmu dari sekarang!
            </p>

            <div class="row mt-4">

                <!-- CARD 1 -->
                <div class="col-12 col-md-6 col-lg-4">

                    <div class="card course-card">
                        <img src="assets/course.png" class="card-img-top" loading="lazy">
                        <div class="card-body">
                            <small class="text-muted">
                                The history of UI/UX design
                            </small>
                            <h6 class="fw-bold mt-2">
                                UX Design: Prototype & UI Animation with Figma
                            </h6>
                        </div>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="col-12 col-md-6 col-lg-4">

                    <div class="card course-card">
                        <img src="assets/course.png" class="card-img-top" loading="lazy">
                        <div class="card-body">
                            <small class="text-muted">
                                The history of UI/UX design
                            </small>
                            <h6 class="fw-bold mt-2">
                                UX Design: Prototype & UI Animation with Figma
                            </h6>
                        </div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="col-12 col-md-6 col-lg-4">

                    <div class="card course-card">
                        <img src="assets/course.png" class="card-img-top" loading="lazy">
                        <div class="card-body">
                            <small class="text-muted">
                                The history of UI/UX design
                            </small>
                            <h6 class="fw-bold mt-2">
                                UX Design: Prototype & UI Animation with Figma
                            </h6>
                        </div>
                    </div>
                </div>

            </div>
        </main>


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

                <!-- Kontak -->
                <div class="col-md-4 text-md-end">
                    <h6 class="fw-bold">Kontak</h6>
                    <p class="mb-0">
                        <img src="assets/Whatsapp logo.png" class="footer-icon-sm" loading="lazy">
                        +62 853-6838-4829
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