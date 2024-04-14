<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthenticatedMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Tasks\Dashboard;
use App\Livewire\Tasks\TaskGroups;
use App\Livewire\Tasks\TaskListing;
use App\Livewire\Tasks\Tasks;
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
    Route::get('/task-groups', TaskGroups::class)->name('task-groups');
    Route::get('/tasks', Tasks::class)->name('tasks');
    Route::get('/task-listing', TaskListing::class)->name('task-listing');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});