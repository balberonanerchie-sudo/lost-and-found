<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManageItemController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\CheckAppointmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;

// --- Public Routes ---
Route::get('/home', [PageController::class, 'welcome'])->name('home');
Route::get('/search', [PageController::class, 'search'])->name('public.search');
Route::get('/book-appointment', [PageController::class, 'bookAppointment'])->name('public.appointment');
Route::get('/report-item', [PageController::class, 'reportItem'])->name('public.report');
// --- Authentication Routes ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'loginvalidate'])->name('login.validate');
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'registerValidate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- Admin Routes ---
Route::middleware(['auth:admin'])->group(function () {
Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('adminDashboard');
Route::get('/manage-item', [ManageItemController::class, 'index'])->name('manageItem');
Route::get('/manage-user', [ManageUserController::class, 'index'])->name('manageUser');
Route::get('/appointments', [CheckAppointmentController::class, 'index'])->name('checkAppointment');
});

// Admin Login Action
// Admin Login Action
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.validate');