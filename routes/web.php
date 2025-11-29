<?php

use Illuminate\Support\Facades\Route;

//View Routes

Route::view('/Admin_Dashboard', 'pages.AdminDashboard')
->name('Admin_Dashboard');
Route::view('/Manage_Item', 'pages.manage-item')
->name('manageItem');
Route::view('/Manage_User', 'pages.manage-user')
->name('manageUser');
Route::view('/Check_Appointment', 'pages.check-appointment')
->name('checkAppointment');



Route::get('/', function () {
    return view('pages.AdminDashboard');
});