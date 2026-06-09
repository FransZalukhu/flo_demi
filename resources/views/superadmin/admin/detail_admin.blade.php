<!doctype html>
<html lang="en">

<head>
    @include('layouts.superadmin.partials.head', ['pageTitle' => 'Admin Dashboard - Detail Admin'])

    <style>
        .card.detail-card-purple {
            border: 1.5px solid #9F66AF !important;
            border-radius: 14px !important;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(159, 102, 175, 0.08);
        }

        /* Padding isi card */
        .detail-card-purple .card-body {
            padding: 30px;
        }

        /* LABEL & VALUE*/
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

        /*Avatar */
        .detail-avatar-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .detail-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #9F66AF;
            padding: 3px;
            object-fit: cover;
        }

        /* BADGES */
        .badge-aktif {
            background: #e8f7ee;
            color: #2e7d32;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .badge-nonaktif {
            background: #fdecea;
            color: #c62828;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .perm-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-right: 5px;
            margin-bottom: 5px;
            font-weight: 500;
        }
    </style>

</head>

<body>
    <div class="dashboard-main-wrapper">
        @include('layouts.superadmin.partials.header')
        @include('layouts.superadmin.partials.sidebar', ['activeMenu' => 'manajemen-admin', 'activePage' => 'manajemen-admin-list'])

        <div class="dashboard-wrapper">
            <div class="dashboard-content">
                <div class="container-fluid">

                    <!-- Page Header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Detail Admin</h2>
                                <p class="pageheader-text">
                                    Informasi lengkap mengenai data Admin.
                                </p>

                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('superadmin.dashboard.index')}}" class="breadcrumb-link">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="{{route('superadmin.admin.list')}}" class="breadcrumb-link">Manajemen Admin</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Detail Admin
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Card -->
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 mx-auto">
                            <div class="card detail-card-purple">
                                <div class="card-body">

                                    <div class="detail-avatar-container">
                                        @if($admin->photo)
                                            <img src="{{ asset('storage/' . $admin->photo) }}" class="detail-avatar" alt="{{ $admin->username }}">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->username) }}&background=9F66AF&color=fff&size=120"
                                                class="detail-avatar" alt="{{ $admin->username }}">
                                        @endif
                                        <h3 class="mt-3 mb-1" style="color: #4b2c57; font-weight: 700;">{{ $admin->username }}</h3>
                                        <p class="text-muted">{{ ucfirst($admin->role) }}</p>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">Email</div>
                                            <div class="detail-value">{{ $admin->email }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Nomor Handphone</div>
                                            <div class="detail-value">{{ $admin->nomor_hp ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">Role</div>
                                            <div class="detail-value">
                                                @if($admin->role === 'superadmin')
                                                    <span class="badge bg-primary">Superadmin</span>
                                                @else
                                                    <span class="badge bg-secondary">Admin</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Status Akun</div>
                                            <div class="detail-value">
                                                @if($admin->status === 'aktif')
                                                    <span class="badge-aktif">Aktif</span>
                                                @else
                                                    <span class="badge-nonaktif">Nonaktif</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="detail-label">Hak Akses</div>
                                        <div class="mt-2">
                                            @php
                                                $permissions = $admin->getPermissionsArray();
                                            @endphp
                                            @if(!empty($permissions))
                                                @foreach($permissions as $permission)
                                                    @php
                                                        $badgeClass = match($permission) {
                                                            'kelola_mentor' => 'success',
                                                            'kelola_mentee' => 'info',
                                                            'kelola_course' => 'warning',
                                                            default => 'secondary'
                                                        };
                                                        $label = match($permission) {
                                                            'kelola_mentor' => 'Kelola Mentor',
                                                            'kelola_mentee' => 'Kelola Mentee',
                                                            'kelola_course' => 'Kelola Course',
                                                            default => $permission
                                                        };
                                                    @endphp
                                                    <span class="badge bg-{{ $badgeClass }} perm-badge">{{ $label }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="detail-label">Bergabung Pada</div>
                                            <div class="detail-value">{{ $admin->created_at->format('d M Y, H:i') }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Terakhir Diperbarui</div>
                                            <div class="detail-value">{{ $admin->updated_at->format('d M Y, H:i') }}</div>
                                        </div>
                                    </div>

                                    <!-- ACTION BUTTONS -->
                                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                        <a href="{{ route('superadmin.admin.list') }}" 
                                            style="background-color: #e5e7eb; color: #374151; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 500; text-decoration: none;">
                                            Kembali
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

        @include('layouts.superadmin.partials.scripts')

</body>

</html>