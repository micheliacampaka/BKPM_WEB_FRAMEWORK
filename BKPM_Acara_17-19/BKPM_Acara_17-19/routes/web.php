<?php

use App\Http\Controllers\{
    CobaController,
    PegawaiController,
    SessionController,
    UploadController,
    ManagementUserController,
    User\UserController,
    Backend\ProductController,
    Backend\DashboardController,
    Frontend\HomeController,
    Backend\PendidikanController,
    Backend\PengalamanKerjaController
};
use Illuminate\Support\Facades\{Route, Auth};
use App\Http\Middleware\CheckAge;

// Route untuk user management
Route::prefix('user')->group(function () {
    Route::get('/', [ManagementUserController::class, 'index']);
    Route::get('/create', [ManagementUserController::class, 'create']);
    Route::post('/', [ManagementUserController::class, 'store']);
    Route::get('/{id}', [ManagementUserController::class, 'show']);
    Route::get('/{id}/edit', [ManagementUserController::class, 'edit']);
    Route::put('/{id}', [ManagementUserController::class, 'update']);
    Route::delete('/{id}', [ManagementUserController::class, 'destroy']);
});

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route untuk frontend home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route untuk backend dashboard dan produk
Route::resource('dashboard', DashboardController::class);
Route::resource('product', ProductController::class);

// Middleware auth untuk halaman profile admin
Route::get('/admin/profile', function () {
    return 'Halaman Profil Admin';
})->middleware('auth');

// Route dengan CheckAge middleware
Route::get('/admin/profile', function () {
    return 'Halaman Profil Admin dengan Middleware CheckAge';
})->middleware(CheckAge::class);

Auth::routes();

// Redirect routes
Route::redirect('/welcome', '/');

// Route dengan prefix untuk admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', fn () => 'Dashboard Admin');
    Route::get('/db', fn () => 'Halaman Database Admin');
});

// Route untuk backend
Route::prefix('backend')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard.backend');

    // Pendidikan
    Route::prefix('pendidikan')->group(function () {
        Route::get('/', [PendidikanController::class, 'showPendidikan'])->name('pendidikan.backend');
        Route::get('/add', [PendidikanController::class, 'showPendidikanAdd'])->name('pendidikan.backend.add');
        Route::post('/store', [PendidikanController::class, 'storePendidikan'])->name('pendidikan.store');
        Route::get('/edit/{id}', [PendidikanController::class, 'editPendidikan'])->name('edit.pendidikan');
        Route::put('/update/{id}', [PendidikanController::class, 'updatePendidikan'])->name('update.pendidikan');
        Route::delete('/delete/{id}', [PendidikanController::class, 'deletePendidikan'])->name('delete.pendidikan');
    });

    // Pengalaman Kerja
    Route::prefix('pengalamankerja')->group(function () {
        Route::get('/', [PengalamanKerjaController::class, 'showPengalamanKerja'])->name('pengalamankerja.backend');
        Route::get('/add', [PengalamanKerjaController::class, 'showPengalamanKerjaAdd'])->name('pengalamankerja.backend.add');
        Route::post('/store', [PengalamanKerjaController::class, 'storePengalamanKerja'])->name('pengalamankerja.store');
        Route::get('/edit/{id}', [PengalamanKerjaController::class, 'editPengalamanKerja'])->name('pengalamankerja.edit');
        Route::put('/update/{id}', [PengalamanKerjaController::class, 'updatePengalamanKerja'])->name('pengalamankerja.update');
        Route::delete('/delete/{id}', [PengalamanKerjaController::class, 'deletePengalamanKerja'])->name('pengalamankerja.delete');
    });
});

// Route untuk sesi
Route::prefix('session')->group(function () {
    Route::get('/create', [SessionController::class, 'create']);
    Route::get('/show', [SessionController::class, 'show']);
    Route::get('/delete', [SessionController::class, 'delete']);
});

// Route untuk pegawai
Route::get('/pegawai/{nama}', [PegawaiController::class, 'index']);

// Formulir dan validasi
Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses'])->name('proses.formulir');

// Upload gambar
Route::prefix('upload')->group(function () {
    Route::get('/', [UploadController::class, 'upload'])->name('upload');
    Route::post('/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');
    Route::get('/resize', [UploadController::class, 'viewResize'])->name('upload.resize');
    Route::post('/resize/proses', [UploadController::class, 'proses_upload_resize'])->name('upload.proses.resize');
});

// Multiple upload menggunakan Dropzone
Route::prefix('dropzone')->group(function () {
    Route::get('/', [UploadController::class, 'dropzone'])->name('dropzone');
    Route::post('/store', [UploadController::class, 'dropzone_store'])->name('dropzone.store');
    Route::get('/pdf', [UploadController::class, 'dropzonePdf'])->name('dropzone.pdf');
    Route::post('/pdf/store', [UploadController::class, 'dropzonePdfStore'])->name('dropzone.pdf.store');
})