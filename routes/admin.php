<?php

use App\Constants\Guard;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('admin.login'))->name('index');

Route::get('login', Auth\Login::class)->name('login');

Route::middleware('auth:' . Guard::ADMIN)->group(function () {

    Route::get('dashboard', Dashboard::class)->name('dashboard');
});
