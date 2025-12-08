<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManageItemController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\CheckAppointmentController;
use App\Http\Controllers\ReportController;

// Guest: show login/register page
Route::get('/',         [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');

// Auth actions
Route::post('/',         [LoginController::class, 'login'])->name('login.perform');
Route::post('/register', [LoginController::class, 'register'])->name('register.perform');
Route::post('/logout',   [LoginController::class, 'logout'])->name('logout');

// All routes below require login
Route::middleware('auth')->group(function () {

    // Student pages
    Route::get('/read-appointments', [CheckAppointmentController::class, 'studentIndex'])
        ->name('student.appointments.index');

    Route::get('/home',        [PageController::class, 'welcome'])->name('home');
    Route::get('/search',      [ManageItemController::class, 'userIndex'])->name('search');
    Route::get('/appointments',[PageController::class, 'readAppointment'])->name('appointment');

    // Student report form (Lost / Found)
    Route::get('/report-item', [PageController::class, 'reportItem'])->name('report');

    // Student submits Lost / Found report
    Route::post('/report-item', [ReportController::class, 'store'])->name('report.store');

    // Admin pages
    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Item management
        Route::get('/manage-item',    [ManageItemController::class, 'index'])->name('admin.items');
        Route::put('/manage-item',    [ManageItemController::class, 'update'])->name('admin.items.update');
        Route::delete('/manage-item', [ManageItemController::class, 'destroy'])->name('admin.items.destroy');
        Route::patch('/manage-item/{item}/claim', [ManageItemController::class, 'markClaimed'])
            ->name('admin.items.claim');

        // User management
        Route::get('/manage-user',    [ManageUserController::class, 'index'])->name('admin.users');
        Route::put('/manage-user',    [ManageUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/manage-user', [ManageUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('/manage-user',   [ManageUserController::class, 'store'])->name('admin.users.store');

        // Report management
        // Admin list of ALL reports (lost + found)
        Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
        // Actions:
        Route::post('/reports/{report}/create-item', [ReportController::class, 'createItemFromFound'])->name('admin.reports.createItem');
        Route::get('/reports/{report}/match', [ReportController::class, 'matchInItems'])->name('admin.reports.match');
        Route::put('/reports', [ReportController::class, 'update'])->name('admin.reports.update');
        Route::delete('/reports', [ReportController::class, 'destroy'])->name('admin.reports.destroy');


        // Other admin pages
        Route::get('/appointments', [CheckAppointmentController::class, 'index'])
            ->name('admin.appointments');
    });

    // Item management routes (still behind auth)
    Route::post('/items/store', [ManageItemController::class, 'store'])->name('items.store');
});
