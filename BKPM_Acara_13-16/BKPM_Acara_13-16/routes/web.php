<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Backend'], function()
{
    Route::resource('dashboard' ,'DashboardController');
});
