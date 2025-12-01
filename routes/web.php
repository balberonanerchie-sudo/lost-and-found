<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManageItemController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\CheckAppointmentController;

Route::get('/', [AdminDashboardController::class, 'index'])->name('adminDashboard');

Route::get('/manage-item', [ManageItemController::class, 'index'])->name('manageItem');

Route::get('/manage-user', [ManageUserController::class, 'index'])->name('manageUser');

Route::get('/appointments', [CheckAppointmentController::class, 'index'])->name('checkAppointment');
