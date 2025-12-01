<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckAppointmentController extends Controller
{
    public function index()
    {
        return view('pages.check-appointment');
    }
}
