<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderLogRequest;
use App\Http\Requests\UpdateOrderLogRequest;
use App\Models\OrderLog;

class OrderLogController extends Controller
{
    protected $data = [];

    public function __construct() {
        $this->data['page_name'] = 'Order Logs';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['order_logs'] = OrderLog::all();
        return view('pages.order-log', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderLog $orderLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderLog $orderLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderLogRequest $request, OrderLog $orderLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderLog $orderLog)
    {
        //
    }
}
