<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PendidikanController;
use App\Http\Controllers\Backend\PengalamanKerjaController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Backend'], function()
{
    Route::resource('dashboard' ,'DashboardController');
});
    // Pendidikan
    Route::controller(PendidikanController::class)->group(function () {
        Route::get('pendidikan', 'showPendidikan')->name('pendidikan.backend');
        Route::get('pendidikan/add', 'showPendidikanAdd')->name('pendidikan.backend.add');
        Route::post('pendidikan/store', 'storePendidikan')->name('pendidikan.store');
        Route::get('pendidikan/edit/{id}', 'editPendidikan')->name('edit.pendidikan');
        Route::put('pendidikan/update/{id}', 'updatePendidikan')->name('update.pendidikan');
        Route::delete('pendidikan/delete/{id}', 'deletePendidikan')->name('delete.pendidikan');
    });

    // Pengalaman Kerja
    Route::controller(PengalamanKerjaController::class)->group(function () {
        Route::get('pengalamankerja', 'showPengalamanKerja')->name('pengalamankerja.backend');
        Route::get('pengalamankerja/add', 'showPengalamanKerjaAdd')->name('pengalamankerja.backend.add');
        Route::post('pengalamankerja/store', 'storePengalamanKerja')->name('pengalamankerja.store');
        Route::get('pengalamankerja/edit/{id}', 'editPengalamanKerja')->name('pengalamankerja.edit');
        Route::put('pengalamankerja/update/{id}', 'updatePengalamanKerja')->name('pengalamankerja.update');
        Route::delete('pengalamankerja/delete/{id}', 'deletePengalamanKerja')->name('pengalamankerja.delete');
    });

    // Alternatively, use resource routes
    // Route::resource('pendidikan', PendidikanController::class);
    // Route::resource('pengalamankerja', PengalamanKerjaController::class);

