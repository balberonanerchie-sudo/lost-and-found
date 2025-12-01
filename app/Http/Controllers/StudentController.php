<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function homepage()
    {
        return view('pages.studHomepage');
    }

    public function reportItem()
    {
        return view('pages.studReportItem');
    }

    public function searchItem()
    {
        return view('pages.studSearchItem');
    }

    public function appointment()
    {
        return view('pages.studAppointment');
    }
}
