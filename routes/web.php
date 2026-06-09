<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenteeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\Superadmin\AdminController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\CourseController;
use App\Http\Controllers\Superadmin\ModuleController;
use App\Http\Controllers\Superadmin\KategoriController;
use App\Http\Controllers\Superadmin\EnrollmentController;
use App\Http\Controllers\Superadmin\MenteeController as MenteeManageController;
use App\Http\Controllers\Mentee\ProfileController as MenteeProfileController;
use App\Http\Controllers\Superadmin\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PushSubscriptionController;


Route::get('/', [KursusController::class, 'index'])->name('home');

// Superadmin Login (Public)
Route::get('/superadmin/login', function () {
    return view('superadmin.login');
})->name('superadmin.login');

Route::post('/superadmin/login', [AuthController::class, 'superadminLogin'])
    ->middleware('throttle:superadmin-auth')
    ->name('superadmin.login.post');

// Superadmin Panel (Protected)
Route::prefix('superadmin')->name('superadmin.')->middleware('superadmin')->group(function () {

    // Dashboard
    Route::prefix('dashboard')->name('dashboard.')
        ->controller(DashboardController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/notifikasi', 'notifikasi')->name('notifikasi');
            Route::post('/admin/{id}/update-status', 'updateStatus')->name('admin.updateStatus');
            Route::post('/admin/{id}/reset-password', 'resetPassword')
                ->middleware('throttle:admin-reset-limit')
                ->name('admin.resetPassword');
            Route::get('/admin/{id}/reset-password-page', 'resetPasswordPage')->name('admin.resetPasswordPage');
            Route::post('/admin/{id}/reset-password-save', 'resetPasswordSave')
                ->middleware('throttle:admin-reset-limit')
                ->name('admin.resetPasswordSave');
        });

    // Manajemen Admin (hanya superadmin)
    Route::prefix('admin')->name('admin.')
        ->controller(AdminController::class)
        ->middleware('role:superadmin')
        ->group(function () {
            Route::get('/list', 'index')->name('list');
            Route::get('/tambah', 'create')->name('add');
            Route::post('/tambah', 'store')->name('store');
            Route::get('/{id}/detail', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/update', 'update')->name('update');
        });

    // Manajemen Course
    Route::prefix('course')->name('course.')
        ->middleware('permission:kelola_course')
        ->group(function () {
            // List & Tambah Course
            Route::get('/list',   [CourseController::class, 'CourseList'])->name('list');
            Route::get('/tambah', [CourseController::class, 'CreateCourse'])->name('add');
            Route::post('/store', [CourseController::class, 'StoreCourse'])->name('store');

            // Edit & Update Course
            Route::get('/{id}/edit', [CourseController::class, 'EditCourse'])->name('edit');
            Route::post('/{id}/update', [CourseController::class, 'UpdateCourse'])->name('update');

            // Manajemen Modul
            Route::get('/modul',               [ModuleController::class,  'index'])->name('modul');
            Route::get('/modul/{id}',          [ModuleController::class,  'index'])->name('modul.show');
            Route::post('/modul/store',        [ModuleController::class,  'store'])->name('modul.store');
            Route::put('/modul/{id}/update',   [ModuleController::class,  'update'])->name('modul.update');
            Route::delete('/modul/{id}/hapus', [ModuleController::class,  'destroy'])->name('modul.destroy');

            // Manajemen Kategori
            Route::get('/kategori',             [KategoriController::class, 'index'])->name('kategori.index');
            Route::post('/kategori/store',      [KategoriController::class, 'store'])->name('kategori.store');
            Route::put('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
            Route::delete('/kategori/{id}/hapus', [KategoriController::class, 'destroy'])->name('kategori.destroy');

            // Approval & Extra
            Route::post('/approve/{id}', [EnrollmentController::class, 'approve'])->name('approve');
            Route::post('/reject/{id}',  [EnrollmentController::class, 'reject'])->name('reject');
        });

    // Manajemen Pendaftaran & Pembayaran
    Route::prefix('enrollment')->name('enrollment.')->controller(EnrollmentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}/detail', 'detail')->name('detail');
        Route::post('/{id}/approve', 'approve')->name('approve');
        Route::post('/{id}/reject', 'reject')->name('reject');
    });

    // Manajemen Mentee
    Route::prefix('mentee')->name('mentee.')
        ->controller(MenteeManageController::class)
        ->middleware('permission:kelola_mentee')
        ->group(function () {
            Route::get('/list', 'MenteeList')->name('list');
        });

    // Profile
    Route::prefix('profile')->name('profile.')
        ->controller(ProfileController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update', 'update')->name('update');
            Route::post('/reset-password', 'resetPassword')
                ->middleware('throttle:superadmin-auth')
                ->name('resetPassword');
        });
});

// Mentee Auth (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/daftar', function () {
        return view('mentee.register');
    })->name('register');

    Route::get('/masuk', function () {
        return view('mentee.login');
    })->name('login');

    Route::post('/masuk', [AuthController::class, 'login'])
        ->middleware('throttle:critical-auth')
        ->name('login.post');
    Route::post('/daftar', [AuthController::class, 'register'])
        ->middleware('throttle:critical-auth')
        ->name('register.post');
});


// Public Routes
Route::get('/kursus/{id}', [KursusController::class, 'show'])->name('kursus.show');
Route::get('/katalog',     [KursusController::class, 'indexKatalog'])->name('katalog');


// Mentee Panel (Auth Required)
Route::middleware('auth')->group(function () {
    Route::post('/push-subscriptions', [PushSubscriptionController::class, 'store']);
    Route::delete('/push-subscriptions', [PushSubscriptionController::class, 'destroy']);
    Route::post('/keluar', [AuthController::class, 'logout'])->name('logout');

    // Unified Notification Routes
    Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
        Route::get('/latest', [NotificationController::class, 'getLatest'])->name('latest');
        Route::post('/read-all', [NotificationController::class, 'markAllRead'])->name('readAll');
        Route::get('/{id}/read', [NotificationController::class, 'readAndRedirect'])->name('read');
    });
});

Route::middleware('mentee')->group(function () {
    // Dashboard & Course Mentee
    Route::get('/dashboard-mentee',    [MenteeController::class, 'dashboard'])->name('mentee.dashboard');
    Route::get('/mentee/course-saya',  [MenteeController::class, 'courseSaya'])->name('mentee.course.saya');
    Route::get('/mentee/course/{id}',  [MenteeController::class, 'detailCourseSaya'])->name('mentee.course.detail');

    // Mentee Profile Routes
    Route::prefix('mentee/profile')->name('mentee.profile.')->group(function () {
        Route::get('/', [MenteeProfileController::class, 'index'])->name('index');
        Route::post('/update', [MenteeProfileController::class, 'update'])->name('update');
    });

    // Checkout
    Route::get('/checkout/{id}',             [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{id}/gratis',     [CheckoutController::class, 'joinGratis'])->name('checkout.gratis');
    Route::post('/checkout/{id}/berbayar',   [CheckoutController::class, 'joinBerbayar'])
        ->middleware('throttle:payment-limit')
        ->name('checkout.berbayar');

    // Pembayaran & Invoice
    Route::prefix('pembayaran')->name('mentee.pembayaran.')->group(function () {
        Route::get('/invoice/{id}', [\App\Http\Controllers\Mentee\PaymentController::class, 'invoice'])->name('invoice');
        Route::get('/detail/{id}', [\App\Http\Controllers\Mentee\PaymentController::class, 'detail'])->name('detail');
        Route::post('/upload-bukti/{id}', [\App\Http\Controllers\Mentee\PaymentController::class, 'uploadBukti'])->name('uploadBukti');
        Route::get('/riwayat', [\App\Http\Controllers\Mentee\PaymentController::class, 'history'])->name('riwayat');
    });

    // Modul Progress
    Route::post('/modul/{modulId}/selesai', [MenteeController::class, 'tandaiSelesai'])->name('modul.selesai');

    // Detail Course Saya
    Route::get('/course-saya/{id}',            [MenteeController::class, 'detailCourseSaya'])->name('mentee.detailCourseSaya');
    Route::post('/course-saya/tandai-selesai', [MenteeController::class, 'tandaiSelesai'])->name('mentee.tandaiSelesai');

    // Sertifikat
    Route::prefix('mentee/sertifikat')->name('mentee.sertifikat.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Mentee\SertifikatController::class, 'index'])->name('index');
        Route::get('/{id}/download', [\App\Http\Controllers\Mentee\SertifikatController::class, 'download'])->name('download');
    });

    // Notifikasi
    Route::get('/mentee/notifikasi', [MenteeController::class, 'notifikasi'])->name('mentee.notifikasi.index');
});

// Route sementara
// Route::get('/preview-sertifikat', function() {
//      $user = \App\Models\User::skip(7)->first();
//      $course = \App\Models\Kursus::first();
     
//      if (!$user || !$course) return "Tambahkan setidaknya 1 user dan 1 kursus di database untuk testing.";

//      $data = [
//             'name'      => strtoupper($user->name ?? $user->username),
//             'course'    => $course->judul,
//             'date'      => now()->translatedFormat('d F Y'),
//             'cert_no'   => 'FL/' . now()->format('Y') . '/TEST/0001'
//         ];
   
//         $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('certificates.template', $data)
//                   ->setPaper('a4', 'landscape');
                  
//         return $pdf->stream('preview-sertifikat.pdf');
// });
