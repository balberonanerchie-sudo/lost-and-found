<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManageItemController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\CheckAppointmentController;

// Guest: show login/register page
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');

// Auth actions
Route::post('/', [LoginController::class, 'login'])->name('login.perform');
Route::post('/register', [LoginController::class, 'register'])->name('register.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// All routes below require login
Route::middleware('auth')->group(function () {

    // Student pages
    Route::get('/home', [PageController::class, 'welcome'])->name('home');
    Route::get('/search', [PageController::class, 'search'])->name('search');
    Route::get('/book-appointment', [PageController::class, 'bookAppointment'])->name('appointment');
    Route::get('/report-item', [PageController::class, 'reportItem'])->name('report');

    // Admin pages
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/manage-item', [ManageItemController::class, 'index'])->name('admin.items');
        Route::get('/manage-user', [ManageUserController::class, 'index'])->name('admin.users');
        Route::get('/appointments', [CheckAppointmentController::class, 'index'])->name('admin.appointments');
    });
});
