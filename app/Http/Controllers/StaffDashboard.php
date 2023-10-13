<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffDashboard extends Controller
{
    protected $data = [];

    public function __construct() {
        $this->data['page_name'] = 'Staff Dashboard';
    }

    public function index()
    {   
        $staff_id = Auth::user()->id;
        $orders = DB::table('order_details')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->join('vehicles', 'vehicles.id', '=', 'orders.vehicle_id')
            ->join('drivers', 'drivers.id', '=', 'orders.driver_id')
            ->select(
                'orders.id as order_id',
                'orders.return_at as return_at',
                'orders.status as order_status',
                'users.name as staff_name',
                'drivers.name as driver_name',
                'vehicles.name as vehicle_name',
                'order_details.is_allow as is_allow',
                'order_details.created_at as request_time'
            )
            ->where('order_details.user_id', $staff_id);

        // $orders_detail = OrderDetail::where('user_id', $staff_id);
        // $this->data['all_approvals'] = $orders_detail->get();
        $this->data['new_approvals'] = $orders->clone()->whereNull('is_allow');
        $this->data['approveds'] = $orders->clone()->where('is_allow', 1);
        $this->data['rejecteds'] = $orders->clone()->where('is_allow', 0);
        
        if($this->data['approveds']->exists()) {
            $this->data['last_approval'] = $this->data['approveds']->latest('request_time')->first();
        }
        $this->data['orders'] = $orders->get();

        // if($orders_detail->exists()) {
        //     $order_ids = $orders_detail->pluck('order_id')->toArray();
        //     $this->data['orders'] = Order::whereIn('id', $order_ids)->get();
        //     if ($orders_detail->where('is_allow', 1)->exists()) {
        //         $this->data['last_approval'] = Order::find($this->data['approveds']->latest()->first()->order_id);
        //     }
        // }


        // if($o)

        return view('pages.staff-dashboard', $this->data);
    }
}
