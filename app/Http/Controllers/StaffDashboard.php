<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffDashboard extends Controller
{
    public function index()
    {
        return view('pages.staff-dashboard');
    }
}
