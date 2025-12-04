<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // --- Public Pages ---

    public function welcome()
    {
        // Points to resources/views/pages/welcome.blade.php
        return view('pages.studHomepage');
    }

    public function search()
    {
        // Points to resources/views/pages/public-search.blade.php
        return view('pages.studSearch');
    }

    public function bookAppointment()
    {
        // Points to resources/views/pages/book-appointment.blade.php
        return view('pages.studAppointment');
    }

    public function reportItem()
    {
        // Points to resources/views/pages/book-appointment.blade.php
        return view('pages.studReport');
    }
    public function adminDashboard()
    {
        return view('pages.AdminDashboard');
    }

    public function manageItem()
    {
        return view('pages.manage-item');
    }

    public function manageUser()
    {
        return view('pages.manage-user');
    }

    public function checkAppointment()
    {
        return view('pages.check-appointment');
    }
}