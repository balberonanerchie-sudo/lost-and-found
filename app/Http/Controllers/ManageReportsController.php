<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; 

class ManageReportsController extends Controller
{
    public function index()
    {
        // Fetch Lost and Found items separately
        // Note: Ensure your 'items' table has a 'type' column (lost/found)
        $lostReports = Item::where('type', 'lost')->orderBy('created_at', 'desc')->get();
        $foundReports = Item::where('type', 'found')->orderBy('created_at', 'desc')->get();

        return view('pages.manage-report', compact('lostReports', 'foundReports'));
    }
}

