@extends('layouts.app')

@section('csscode')
<link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('/thema/assets/libs/select2/dist/css/select2.min.css') }}"
/>
@stop

@section('content')

<div class="col-12">
    <div class="card">
        @if (Request::segment(1) == 'root')
            <form method="post" action="{{ route('root-order-store') }}">
        @else
            <form method="post" action="{{ route('admin-order-store') }}">
        @endif
        
            @csrf
            
            <div class="card-body">
                <h5 class="card-title">Order Form</h5>
                <div class="row">
                    <div class="col">
                        <div class="form-group mt-3">
                            <label>Return Time</label>
                            <input name="return_at" type="datetime-local" class="form-control" id="lname" value="{{ date('Y-m-d\TH:i:00', time()+3660) }}" min="{{ date('Y-m-d\TH:i:00', time()+3660) }}"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-3">
                            <label>Driver</label>
                            <select class="select2 form-select shadow-none" name="driver_id" style="width: 100%; height: 36px">
                                <option>Select drivers</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-3">
                            <label>Vehicle</label>
                            <select class="select2 form-select shadow-none" name="vehicle_id" style="width: 100%; height: 36px">
                                <option>Select vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-3">
                            <label>Staff Approval</label>
                            <select class="select2 form-select shadow-none mt-3" multiple="multiple" name="staff_ids[]" style="height: 30px; width: 100%;">
                                @foreach ($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        
        </form>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order Data</h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Car</th>
                            <th>Driver</th>
                            <th>Status</th>
                            <th>Created time</th>
                            <th>Return Time</th>
                            <th>Approval</th>
                            <th>Approved</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th>
                                    <a href="#">
                                        {{ $order->vehicle->name }}
                                    </a>
                                </th>
                                <th>{{ $order->driver->name }}</th>
                                <th>{{ $order->status }}</th>
                                <th>{{ $order->created_at }}</th>
                                <th>{{ $order->return_at }}</th>
                                <th>{{ $order->details()->count() }}</th>
                                <th>{{ $order->details_approved()->count() }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('jscode')
    <script src="{{ asset('/thema/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/thema/assets/libs/select2/dist/js/select2.min.js') }}"></script>

    <script>
        $("#zero_config").DataTable({
            order: [[3, 'desc']]
        });

        $( document ).ready(function() {
            $(".select2").select2();
        });

    </script>
@stop