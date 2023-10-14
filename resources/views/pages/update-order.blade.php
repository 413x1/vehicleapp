@extends('layouts.app')

@section('csscode')
<link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('/thema/assets/libs/select2/dist/css/select2.min.css') }}"
/>
@stop


@section('content')

<div class="col-md-6">
    <div class="card">
    @if (Request::segment(1) == 'root')
        <form method="post" class="form-horizontal" action="{{ route('root-update-order', $order->id) }}">
    @elseif (Request::segment(1) == 'admin')
        <form method="post" class="form-horizontal" action="{{ route('admin-update-order', $order->id) }}">
    @else
        <form method="post" class="form-horizontal" action="{{ route('staff-update-order', $order->id) }}">
    @endif
			@csrf
            @method('PATCH')
			<div class="card-body">
				<h4 class="card-title">Order Form</h4>

                <div class="form-group row">
                    <label class="col-md-3" for="disabledTextInput">Vehicle Name</label>
                    <div class="col-md-9">
                        <input type="text" id="disabledTextInput" class="form-control" value="{{ $order->vehicle->name }}" placeholder="Disabled input" disabled="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3" for="disabledTextInput">Driver Name</label>
                    <div class="col-md-9">
                        <input type="text" id="disabledTextInput" class="form-control" value="{{ $order->driver->name }}" placeholder="Disabled input" disabled="">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3" for="disabledTextInput">Return Time</label>
                    <div class="col-md-9">
                        <input type="text" id="disabledTextInput" class="form-control" value="{{ $order->return_at }}" placeholder="Disabled input" disabled="">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3" for="disabledTextInput">Status</label>
                    <div class="col-md-9">
                        <input type="text" id="disabledTextInput" class="form-control" value="{{ $order->status }}" placeholder="Disabled input" disabled="">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3" for="disabledTextInput">Request Time</label>
                    <div class="col-md-9">
                        <input type="text" id="disabledTextInput" class="form-control" value="{{ $order->created_at }}" placeholder="Disabled input" disabled="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3" for="disabledTextInput">Approval Line</label>
                    <div class="col-md-9">
                        @foreach ($details as $detail)
                            <div class="row mb-1">
                                <div class="col-12">
                                    {{ $detail->staff->name }} - 
                                    @if (is_null($detail->is_allow))
                                        <span class="badge badge-sm bg-secondary">pending</span>
                                    @elseif ($detail->is_allow == 0)
                                        <span class="badge badge-sm bg-danger">rejected</span>
                                    @else
                                        <span class="badge badge-sm bg-success">approved</span>
                                    @endif
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3" for="disabledTextInput">Update Order Status</label>
                    <div class="col-md-9">
                        <select class="select2 form-select shadow-none" require name="status" style="width: 100%; height: 36px">
                        <option>Select Status</option>
                        @foreach (['approved' => 'Approved', 'rejected' => 'Rejected', 'returned' => 'Returned'] as $status => $value)
                            <option value="{{$status}}"
                                @if ($order->status == $status)
                                    selected
                                @endif
                            >{{$value}}</option>
                            
                        @endforeach
                        <!-- <option value="rejected">Rejected</option>
                        <option value="returned">Returned</option> -->
                    </select>
                    </div>
                </div>

			</div>
			<div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        Reset
                    </button>
                </div>
			</div>
        </form>
    </div>
</div>


@stop

@section('jscode')
	<script src="{{ asset('/thema/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('/thema/assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script>
	$( document ).ready(function() {
		$(".select2").select2();
	});
</script>
@stop