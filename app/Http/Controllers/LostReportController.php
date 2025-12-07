<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class LostReportController extends Controller
{
    public function index()
    {
        // Fetch only items reported as 'lost', ordered by newest first
        $lostItems = Item::where('type', 'lost')->orderBy('created_at', 'desc')->get();
        
        return view('pages.lost-reports', compact('lostItems'));
    }
}