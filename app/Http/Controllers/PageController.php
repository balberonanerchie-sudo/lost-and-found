<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Student Homepage
     */
    public function welcome()
    {
        return view('pages.studHomepage');
    }

    /**
     * Search for lost items
     */
    public function search()
    {
        return view('pages.studSearch');
    }

    /**
     * Book an appointment to claim an item
     */
    public function bookAppointment()
    {
        return view('pages.studAppointment');
    }

    /**
     * Report a lost item
     */
    public function reportItem()
    {
        return view('pages.studReport');
    }
}
