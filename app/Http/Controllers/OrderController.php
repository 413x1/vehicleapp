<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\OrderDetail;
use App\Models\OrderLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{
    protected $data = [];

    public function __construct() {
        $this->data['page_name'] = 'Orders';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $this->data['orders'] = Order::orderBy('created_at')->get();
        $this->data['vehicles'] = Vehicle::all();
        $this->data['drivers'] = Driver::all();
        $this->data['staffs'] = User::where('role', 'staff')->get();
        return view('pages.order', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->data['vehicles'] = Vehicle::all();
        $this->data['drivers'] = Driver::all();
        $this->data['staffs'] = User::where('role', 'staff')->get();
        $this->data['page_name'] = 'Create Order';

        return view('pages.add-order', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $detail = [];

        foreach ($validated['staff_ids'] as $staff_id) {
            array_push($detail, ['user_id' => $staff_id]);
        }

        $flash = [];

        DB::beginTransaction();

        try {
            
            $order = new Order;
            $order->driver_id = $validated['driver_id'];
            $order->vehicle_id = $validated['vehicle_id'];
            $order->return_at = $validated['return_at'];
            $order->status = 'ordered';

            $order->save();

            if($detail) {
                $order->details()->createMany($detail);
            }

            OrderLog::create([
                'user_id' => Auth::user()->id,
                'order_id' => $order->id,
                'description' => 'Order created',
            ]);

            DB::commit();

            $flash['success'] = 'Order create successfully';

        } catch (\Throwable $th) {
            OrderLog::create([
                'user_id' => Auth::user()->id,
                'description' => "Order created failed error {$th->getMessage()}",
            ]);
            DB::rollBack();

            $flash['error'] = "Order create failed.. {$th->getMessage()}";
            
        }
        
        return Redirect::back()->with($flash);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->data['order'] = $order;
        $this->data['details'] = $order->details;

        if(auth()->user()->role == 'staff') {
            $this->data['staff_approval'] = $order->details->where('user_id', Auth::user()->id)->first();
            $this->data['page_name'] = 'Order Approval';
    
            return view(
                'pages.approve-order',
                $this->data
            );
        } else {
            $this->data['page_name'] = 'Update Approval';
    
            return view(
                'pages.update-order',
                $this->data
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order): RedirectResponse
    {
        $validated = $request->validated();
        
        if(in_array(auth()->user()->role, ['admin', 'root'])) {

            if ($validated['status'] == 'approved' && $order->details->where('is_allow')->count() < 2) {
                OrderLog::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'description' => "Order update data status {$validated['status']} failed",
                ]);
                $flash['error'] = 'Order update failed min staff approved 2';

                return Redirect::back()->with($flash);
            }

            DB::beginTransaction();
            try {
                $order->update($validated);

                OrderLog::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'description' => "Order update data status {$validated['status']}",
                ]);
                
                DB::commit();
    
                $flash['success'] = 'Order update successfully';
    
            } catch (\Throwable $th) {
                OrderLog::create([
                    'user_id' => Auth::user()->id,
                    'description' => "Order update failed error {$th->getMessage()}",
                ]);
                DB::rollBack();
    
                $flash['error'] = "Order update failed.. {$th->getMessage()}";
            }
    
            return Redirect::back()->with($flash);

        } else {

            DB::beginTransaction();
            try {
                OrderDetail::where('order_id', $order->id)->where('user_id', Auth::user()->id)->update($validated);
    
                OrderLog::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'description' => "Order approval data {$validated['is_allow']}",
                ]);
                
                DB::commit();
                
                $approval = $validated['is_allow'] == 1 ? 'Approved' : 'Rejected';
                $flash['success'] = "Order {$approval} successfully";
    
            } catch (\Throwable $th) {
                OrderLog::create([
                    'user_id' => Auth::user()->id,
                    'description' => "Order approval failed error {$th->getMessage()}",
                ]);
                DB::rollBack();
    
                $flash['error'] = "Order approval failed.. {$th->getMessage()}";
            }
    
            return Redirect::back()->with($flash);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
