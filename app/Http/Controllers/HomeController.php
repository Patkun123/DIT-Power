<?php

namespace App\Http\Controllers;

use App\Models\AdminContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $adminContents = AdminContent::published()
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('home', compact('adminContents'));
    }
}
