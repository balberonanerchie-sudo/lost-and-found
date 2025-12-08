<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManageItemController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\CheckAppointmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Public / Auth Routes
|--------------------------------------------------------------------------
*/

// Guest: show login/register page
Route::get('/',        [LoginController::class, 'showLoginForm'])->name('login');
// Alias so auth middleware redirect to /login works
Route::get('/login',   [LoginController::class, 'showLoginForm']);
Route::get('/register',[LoginController::class, 'showRegistrationForm'])->name('register');

// Auth actions
Route::post('/',         [LoginController::class, 'login'])->name('login.perform');
Route::post('/register', [LoginController::class, 'register'])->name('register.perform');
Route::post('/logout',   [LoginController::class, 'logout'])->name('logout');

//forgot password routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
/*
|--------------------------------------------------------------------------
| Student & Shared Routes (require login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Student home + search
    Route::get('/home',   [PageController::class, 'welcome'])->name('home');
    Route::get('/search', [ManageItemController::class, 'userIndex'])->name('search');

    // Student: My Appointments (dynamic)
    Route::get('/appointments', [CheckAppointmentController::class, 'studentIndex'])
        ->name('appointment'); // keep original route name for navbar etc.

    // Optional alias if you still use this name somewhere
    Route::get('/read-appointments', [CheckAppointmentController::class, 'studentIndex'])
        ->name('student.appointments.index');

    // Student report form (Lost / Found)
    Route::get('/report-item',  [PageController::class, 'reportItem'])->name('report');
    Route::post('/report-item', [ReportController::class, 'store'])->name('report.store');

    // Appointment routes (student side)

    // From Search Items → Claim button
    Route::get('/items/{item}/claim', [CheckAppointmentController::class, 'createClaim'])
        ->name('appointments.claim');

    // After submitting a FOUND report → schedule turnover appointment
    Route::get('/reports/{report}/schedule-turnover', [CheckAppointmentController::class, 'createTurnover'])
        ->name('appointments.turnover');

    // Form POST from Schedule Pickup (claim + turnover share this)
    Route::post('/appointments', [CheckAppointmentController::class, 'store'])
        ->name('appointments.store');

    // Item creation (used by admin Manage Items & “Add Item from Report”)
    Route::post('/items/store', [ManageItemController::class, 'store'])->name('items.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (require login + admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/whoami', function () {
    return auth()->user();
});

    // Dashboard
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
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::post('/reports/{report}/create-item', [ReportController::class, 'createItemFromFound'])
        ->name('admin.reports.createItem');
    Route::get('/reports/{report}/match', [ReportController::class, 'matchInItems'])
        ->name('admin.reports.match');
    Route::put('/reports',  [ReportController::class, 'update'])->name('admin.reports.update');
    Route::delete('/reports', [ReportController::class, 'destroy'])->name('admin.reports.destroy');

    // Admin appointment management
    Route::get('/appointments', [CheckAppointmentController::class, 'index'])
        ->name('admin.appointments');

    Route::patch('/appointments/{appointment}/approve', [CheckAppointmentController::class, 'approve'])
        ->name('admin.appointments.approve');

    Route::patch('/appointments/{appointment}/reject', [CheckAppointmentController::class, 'reject'])
        ->name('admin.appointments.reject');

    Route::patch('/appointments/{appointment}/complete', [CheckAppointmentController::class, 'complete'])
        ->name('admin.appointments.complete');

    Route::patch('/appointments/{appointment}/cancel', [CheckAppointmentController::class, 'cancel'])
        ->name('admin.appointments.cancel');
});
