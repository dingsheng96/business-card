<?php

use App\Constants\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', fn () => redirect()->route('admin.login'))->name('index');

Auth::routes();

Route::middleware('auth:' . Guard::ADMIN)->group(function () {

    Route::get('dashboard', [DashboardController::class, '__invoke']);
});
