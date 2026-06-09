<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Detail Transaksi'])
    <style>
        .card.detail-card-purple {
            border: 1.5px solid #9F66AF !important;
            border-radius: 14px !important;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(159, 102, 175, 0.08);
        }

        .detail-card-purple .card-body {
            padding: 30px;
        }

        .detail-label {
            font-weight: 600;
            color: #4b2c57;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #333;
            font-size: 1rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1f1f1;
        }

        .status-badge { font-size: 11px; font-weight: 800; padding: 5px 12px; border-radius: 50px; text-transform: uppercase; }

        .info-icon {
            color: #9F66AF;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="dashboard-main-wrapper">
        @include('layouts.superadmin.partials.header')
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'dashboard', 'activePage' => 'manajemen-pendaftaran'])

        <div class="dashboard-wrapper">
            <div class="dashboard-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Detail Transaksi</h2>
                                <p class="pageheader-text">Informasi lengkap mengenai transaksi dan pendaftaran mentee.</p>

                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('superadmin.dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('superadmin.enrollment.index') }}" class="breadcrumb-link">Manajemen Pendaftaran</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Detail Transaksi
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-8 col-lg-10 col-md-12 mx-auto">
                            <div class="card detail-card-purple">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                        <div>
                                            <h4 class="mb-1" style="color: #4b2c57; font-weight: 700;">#ENR-{{ $enrollment->id }}</h4>
                                            <small class="text-muted">{{ $enrollment->created_at->format('d M Y, H:i') }} WIB</small>
                                        </div>
                                        @php
                                            $statusMap = [
                                                'menunggu_pembayaran' => ['bg' => 'bg-amber-100 text-amber-700', 'label' => 'Belum Bayar'],
                                                'menunggu_verifikasi' => ['bg' => 'bg-blue-100 text-blue-700', 'label' => 'Menunggu Verifikasi'],
                                                'aktif'               => ['bg' => 'bg-green-100 text-green-700', 'label' => 'Aktif'],
                                                'ditolak'             => ['bg' => 'bg-red-100 text-red-700', 'label' => 'Ditolak'],
                                                'selesai'             => ['bg' => 'bg-gray-100 text-gray-700', 'label' => 'Selesai'],
                                            ];
                                            $cfg = $statusMap[$enrollment->status] ?? ['bg' => 'bg-light', 'label' => $enrollment->status];
                                        @endphp
                                        <span class="status-badge {{ $cfg['bg'] }}">{{ $cfg['label'] }}</span>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-user info-icon"></i> Mentee</div>
                                            <div class="detail-value fw-bold">{{ $enrollment->pengguna->username ?? '-' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-envelope info-icon"></i> Email</div>
                                            <div class="detail-value">{{ $enrollment->pengguna->email ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-book info-icon"></i> Kursus</div>
                                            <div class="detail-value">{{ $enrollment->kursus->judul ?? '-' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-tag info-icon"></i> Harga Kursus</div>
                                            <div class="detail-value text-brand-purple fw-bold">Rp {{ number_format($enrollment->kursus->harga ?? 0, 0, ',', '.') }}</div>
                                        </div>
                                    </div>

                                    @if($enrollment->pembayaran)
                                    <hr class="my-4" style="border-color: #f1f1f1;">
                                    <h5 class="mb-3" style="color: #4b2c57; font-weight: 700;">Informasi Pembayaran</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-credit-card info-icon"></i> Jumlah Bayar</div>
                                            <div class="detail-value fw-bold text-brand-purple">Rp {{ number_format($enrollment->pembayaran->jumlah ?? 0, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-clock info-icon"></i> Status Pembayaran</div>
                                            <div class="detail-value">
                                                @php
                                                    $paymentStatusMap = [
                                                        'pending' => ['bg' => 'bg-amber-100 text-amber-700', 'label' => 'Pending'],
                                                        'waiting' => ['bg' => 'bg-blue-100 text-blue-700', 'label' => 'Menunggu'],
                                                        'success' => ['bg' => 'bg-green-100 text-green-700', 'label' => 'Berhasil'],
                                                        'failed'  => ['bg' => 'bg-red-100 text-red-700', 'label' => 'Gagal'],
                                                    ];
                                                    $payCfg = $paymentStatusMap[$enrollment->pembayaran->status] ?? ['bg' => 'bg-light', 'label' => $enrollment->pembayaran->status];
                                                @endphp
                                                <span class="status-badge {{ $payCfg['bg'] }}">{{ $payCfg['label'] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if($enrollment->pembayaran->bukti)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-image info-icon"></i> Bukti Transfer</div>
                                            <div class="detail-value">
                                                <a href="{{ asset('storage/' . $enrollment->pembayaran->bukti) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> Lihat Bukti
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-calendar info-icon"></i> Batas Pembayaran</div>
                                            <div class="detail-value">
                                                @if($enrollment->pembayaran->expired_at)
                                                    {{ $enrollment->pembayaran->expired_at->format('d M Y, H:i') }} WIB
                                                    @if($enrollment->pembayaran->expired_at < now())
                                                        <span class="badge bg-danger ms-2">Expired</span>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($enrollment->pembayaran->verifiedBy)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-user-check info-icon"></i> Diverifikasi Oleh</div>
                                            <div class="detail-value">{{ $enrollment->pembayaran->verifiedBy->username ?? '-' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-check-circle info-icon"></i> Tanggal Verifikasi</div>
                                            <div class="detail-value">
                                                @if($enrollment->pembayaran->verified_at)
                                                    {{ $enrollment->pembayaran->verified_at->format('d M Y, H:i') }} WIB
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($enrollment->pembayaran->catatan_admin)
                                    <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-10">
                                        <div class="detail-label text-danger"><i class="fas fa-exclamation-circle info-icon"></i> Catatan Admin</div>
                                        <div class="detail-value text-danger mb-0 border-0">{{ $enrollment->pembayaran->catatan_admin }}</div>
                                    </div>
                                    @endif

                                    @if($enrollment->pembayaran->rejected_at)
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="detail-label"><i class="fas fa-times-circle info-icon"></i> Tanggal Penolakan</div>
                                            <div class="detail-value">{{ $enrollment->pembayaran->rejected_at->format('d M Y, H:i') }} WIB</div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                        <a href="{{ route('superadmin.enrollment.index') }}" 
                                            style="background-color: #e5e7eb; color: #374151; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 500; text-decoration: none;">
                                            <i class="fas fa-arrow-left me-1"></i> Kembali
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.superadmin.partials.footer')
        </div>

        @include('layouts.superadmin.partials.base')
</body>

</html>
