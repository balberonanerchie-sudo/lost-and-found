<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
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
