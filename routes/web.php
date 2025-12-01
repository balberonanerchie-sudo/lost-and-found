<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManageItemController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\CheckAppointmentController;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'homepage'])->name('studHomepage');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/manage-item', [ManageItemController::class, 'index'])->name('manageItem');
    Route::get('/manage-user', [ManageUserController::class, 'index'])->name('manageUser');
    Route::get('/check-appointment', [CheckAppointmentController::class, 'index'])->name('checkAppointment');
});


// Student Routes
Route::get('/report-item', [StudentController::class, 'reportItem'])->name('studReportItem');
Route::get('/search-item', [StudentController::class, 'searchItem'])->name('studSearchItem');
Route::get('/appointment', [StudentController::class, 'appointment'])->name('studAppointment');
