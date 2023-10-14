<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    protected $data = [];

    public function __construct() {
        $this->data['page_name'] = 'Admin Dashboard';
    }

    public function index()
    {   

        $vdatas = Vehicle::select(['name'])
            ->withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit(10)
            ->get()
            // ->pluck('orders_count', 'name')
            ->toArray();
        
        $this->data['data_json'] = json_encode($vdatas);
        // dd($this->data['vehicle_data']);

        return view('pages.admin-dashboard', $this->data);
    }
    
}
