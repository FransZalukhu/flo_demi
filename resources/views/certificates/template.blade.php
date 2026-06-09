<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sertifikat Kelulusan - {{ $name }}</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            width: 297mm;
            height: 210mm;
            overflow: hidden;
            background: #ffffff;
        }

        .certificate-container {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: #3d1f4e;
            overflow: hidden;
        }

        .panel-left {
            position: absolute;
            top: 0; left: 0;
            width: 42%;
            height: 100%;
            background: #faf8fc;
            z-index: 1;
            border-right: 3px solid #9F66AF;
        }

        .panel-right {
            position: absolute;
            top: 0; left: 42%;
            width: 58%;
            height: 100%;
            background: linear-gradient(to bottom, #3d1f4e 0%, #6b2fa0 100%);
            z-index: 2;
        }

        .left-content {
            position: absolute;
            top: 0; left: 0;
            width: 42%;
            height: 210mm;
            z-index: 5;
            border-collapse: collapse;
        }

        .left-inner {
            vertical-align: middle;
            padding: 0 35px;
            text-align: center;
            height: 210mm;
        }

        .logo-wrap { margin-bottom: 20px; }

        .logo-img {
            height: 50px;
            margin-bottom: 8px;
        }

        .brand-name {
            font-size: 16px;
            color: #3d1f4e;
            letter-spacing: 6px;
            text-transform: uppercase;
            font-weight: normal;
        }

        .divider {
            width: 50px;
            height: 2px;
            background: #9F66AF;
            margin: 14px auto;
        }

        .cert-label {
            font-size: 9px;
            color: #9ca3af;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-family: 'Helvetica', sans-serif;
        }

        .main-title {
            font-size: 32px;
            font-weight: bold;
            color: #3d1f4e;
            letter-spacing: 8px;
            text-transform: uppercase;
            line-height: 1.1;
            margin-bottom: 3px;
        }

        .main-subtitle {
            font-size: 11px;
            color: #9F66AF;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-style: italic;
            margin-bottom: 24px;
        }

        .medallion-wrap {
            width: 86px;
            height: 86px;
            position: relative;
            margin: 0 auto 16px;
        }

        .medallion-ring {
            position: absolute;
            top: 0; left: 0;
            width: 86px; height: 86px;
            border-radius: 43px;
            border: 1.5px solid #9F66AF;
        }

        .medallion-star { width: 36px; height: 36px; }
        
    
        .medallion-inner-table {
            position: absolute;
            top: 8px; left: 8px;
            width: 70px; height: 70px;
            border-radius: 35px;
            background: #5b1d80;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .medallion-inner-table tr {
            height: 70px;
        }

        .medallion-inner-table td {
            width: 70px;
            height: 70px;
            text-align: center;
            vertical-align: middle;
            color: #ffffff;
            font-size: 7.5px;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.5;
        }        

        .dot-row { margin: 12px 0 14px; }
        .dot {
            display: inline-block;
            width: 5px; height: 5px;
            border-radius: 50%;
            background: #9F66AF;
            margin: 0 2px;
            opacity: 0.4;
        }
        .dot.active { opacity: 1; width: 6px; height: 6px; }

        .cert-id-text {
            font-size: 8px;
            color: #7B4A8A;;
            letter-spacing: 1px;
            font-family: 'Manrope', sans-serif;
            text-transform: uppercase;
        }

        .right-content {
            position: absolute;
            top: 0; left: 42%;
            width: 58%;
            height: 210mm;
            z-index: 3;
            border-collapse: collapse;
        }

        .right-inner {
            vertical-align: middle;
            padding: 0 45px 0 65px;
            text-align: center;
            height: 210mm;
        }

        .presented-label {
            font-size: 10px;
            color: rgba(233,213,255,0.65);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-family: 'Helvetica', sans-serif;
        }

        .recipient-name {
            font-size: 40px;
            font-weight: bold;
            color: #ffffff;
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .name-rule {
            width: 100%;
            height: 1px;
            background: #c084fc;
            margin-bottom: 18px;
        }

        .description {
            font-size: 13px;
            color: rgba(233,213,255,0.8);
            line-height: 1.8;
            margin: 0 auto 18px;
            text-transform: uppercase;
            max-width: 400px;
            font-family: 'Manrope', sans-serif;
        }

        .course-badge {
            display: inline-block;
            border-left: 3px solid #c084fc;
            padding: 8px 18px;
            background: rgba(255,255,255,0.08);
        }

        .course-label {
            font-size: 9px;
            color: rgba(192,132,252,0.75);
            letter-spacing: 2.5px;
            text-transform: uppercase;
            font-family: 'Helvetica', sans-serif;
            margin-bottom: 2px;
        }

        .course-name {
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .footer-row {
            position: absolute;
            bottom: 0; left: 42%;
            width: 58%;
            height: 70px;
            z-index: 20;
            padding: 0 45px 0 65px;
            display: table;
        }

        .footer-left, .footer-right {
            display: table-cell;
            vertical-align: bottom;
            padding-bottom: 20px;
        }
        
        .footer-right { text-align: right; }

        .meta-item {
            font-size: 9px;
            color: rgba(192,132,252,0.65);
            letter-spacing: 1.2px;
            text-transform: uppercase;
            font-family: 'Helvetica', sans-serif;
            line-height: 1.8;
        }
        .meta-value { color: #e9d5ff; font-weight: bold; }

        .sig-line {
            width: 130px;
            height: 1px;
            background: rgba(255,255,255,0.25);
            margin-bottom: 6px;
            display: inline-block;
        }

        .sig-name {
            font-size: 11px;
            font-weight: bold;
            color: #ffffff;
            display: block;
            margin-bottom: 2px;
        }

        .sig-title {
            font-size: 9px;
            color: rgba(192,132,252,0.65);
            letter-spacing: 1px;
            text-transform: uppercase;
            font-style: italic;
        }

        .bottom-rule {
            position: absolute;
            bottom: 70px; left: calc(42% + 65px);
            right: 45px;
            height: 1px;
            background: rgba(192,132,252,0.35);
            z-index: 4;
        }

        .footer-accent-left {
            position: absolute;
            bottom: 0; left: 0;
            width: 42%;
            height: 4px;
            background: #9F66AF;
            z-index: 10;
        }

        .corner-tr {
            position: absolute;
            top: 15px; right: 15px;
            width: 50px; height: 50px;
            border-top: 2px solid rgba(255,255,255,0.3);
            border-right: 2px solid rgba(255,255,255,0.3);
            z-index: 4;
        }

        .corner-br {
            position: absolute;
            bottom: 15px;
            right: 20px; 
            width: 60px; 
            height: 60px;
            border-bottom: 2px solid rgba(255,255,255,0.3);
            border-right: 2px solid rgba(255,255,255,0.3);
            z-index: 5;
        }

        .watermark {
            position: absolute;
            bottom: 75px; right: 40px;
            font-size: 90px;
            font-weight: bold;
            color: rgba(255,255,255,0.05);
            text-transform: uppercase;
            z-index: 2;
            font-family: 'Georgia', serif;
        }

        .pattern-dot {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(192,132,252,0.15);
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div class="certificate-container">

    <div class="pattern-dot" style="top: 30mm; right: 50mm;"></div>
    <div class="pattern-dot" style="top: 60mm; right: 80mm;"></div>
    <div class="pattern-dot" style="top: 100mm; right: 40mm;"></div>
    <div class="pattern-dot" style="top: 140mm; right: 70mm;"></div>

    <!-- LEFT WHITE PANEL -->
    <div class="panel-left"></div>

    <!-- RIGHT PURPLE PANEL -->
    <div class="panel-right"></div>

    <!-- LEFT CONTENT -->
    <table class="left-content">
        <tr>
            <td class="left-inner">
                <div class="logo-wrap">
                    @php
                        $path = public_path('assets/logo1.png');
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $dataImg = file_exists($path) ? file_get_contents($path) : null;
                        $base64 = $dataImg ? 'data:image/' . $type . ';base64,' . base64_encode($dataImg) : null;

                        $starPath = public_path('assets/star_badge.png');
                        $starPng = file_exists($starPath) ? file_get_contents($starPath) : null;
                        $starB64 = $starPng ? 'data:image/' . $type . ';base64,' . base64_encode($starPng) : null;
                    @endphp
                    @if($base64)
                        <img src="{{ $base64 }}" class="logo-img" alt="Logo">
                    @endif             
                </div>

                <div class="divider"></div>

                <h1 class="main-title">CERTIFICATE</h1>
                <p class="main-subtitle">Of Completion</p>

                <!-- <div class="medallion-wrap">
                    <table class="medallion-inner-table" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                @if($starB64)
                                    <img src="{{ $starB64 }}" class="medallion-star" alt="star">
                                @else
                                    <span class="medallion-text">★</span>
                                @endif
                                <span class="medallion-text">VERIFIED</span>
                            </td>
                        </tr>
                    </table>
                </div>                 -->

                <div class="dot-row">
                    <span class="dot"></span>
                    <span class="dot active"></span>
                    <span class="dot"></span>
                </div>

                <div class="divider"></div>
                <p class="cert-id-text">{{ $cert_no }}</p>
            </td>
        </tr>
    </table>

    <!-- <div class="footer-accent-left"></div> -->

    <div class="corner-tr"></div>
    <div class="corner-br"></div>

    <div class="watermark">FL</div>

    <div class="bottom-rule"></div>

    <table class="right-content">
        <tr>
            <td class="right-inner">
                <p class="presented-label">Dengan bangga diberikan kepada</p>

                <h2 class="recipient-name">{{ $name }}</h2>
                <div class="name-rule"></div>

                <p class="description">
                    Telah berhasil menyelesaikan program dan seluruh kurikulum pada kelas:
                </p>

                <div class="course-badge">
                    <p class="course-name">{{ $course }}</p>
                </div>
            </td>
        </tr>
    </table>

    <!-- FOOTER ROW -->
    <div class="footer-row">
        <div class="footer-right">
            <p class="meta-item">Tanggal Terbit &nbsp;<span class="meta-value">{{ $date }}</span></p>
            <p class="meta-item">Verifikasi &nbsp;<span class="meta-value">flodemi.com/verify</span></p>
        </div>
    </div>

</div>
</body>
</html>