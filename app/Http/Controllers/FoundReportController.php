<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class FoundReportController extends Controller
{
    public function index()
    {
        // Fetch only items reported as 'found', ordered by newest first
        $foundItems = Item::where('type', 'found')->orderBy('created_at', 'desc')->get();
        
        return view('pages.found-reports', compact('foundItems'));
    }
}