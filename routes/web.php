<?php

use App\Http\Middleware\AuthenticatedMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Tasks\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->middleware(AuthenticatedMiddleware::class)->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::prefix('admin')->name('admin.')->middleware(AuthMiddleware::class)->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
});