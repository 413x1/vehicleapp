<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootDashboard extends Controller
{

    public function index()
    {
        return view('pages.root-dashboard');
    }
    
}
