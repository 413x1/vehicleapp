<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RootDashboard extends Controller
{
    protected $data = [];

    public function __construct() {
        $this->data['page_name'] = 'Root Dashboard';
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

        return view('pages.root-dashboard', $this->data);
    }
    
}
