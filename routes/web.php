<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.AdminDashboard');
});

Route::get('/manage-item', function () {
    return view('pages.manage-item');
});

Route::get('/manage-user', function () {
    return view('pages.manage-user');
});

Route::get('/check-appointment', function () {
    return view('pages.check-appointment');
});
