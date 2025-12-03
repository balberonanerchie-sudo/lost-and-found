<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManageItemController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\CheckAppointmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/admin/login', [LoginController::class, 'adminLogin']);
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('adminDashboard');

Route::get('/manage-item', [ManageItemController::class, 'index'])->name('manageItem');

Route::get('/manage-user', [ManageUserController::class, 'index'])->name('manageUser');

Route::get('/appointments', [CheckAppointmentController::class, 'index'])->name('checkAppointment');
