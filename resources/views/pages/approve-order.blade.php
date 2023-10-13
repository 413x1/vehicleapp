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
    @if(is_null($staff_approval->is_allow))
        @if (Request::segment(1) == 'root')
            <form method="post" class="form-horizontal" action="{{ route('root-update-order', $order->id) }}">
        @elseif (Request::segment(1) == 'admin')
            <form method="post" class="form-horizontal" action="{{ route('admin-update-order', $order->id) }}">
        @else
            <form method="post" class="form-horizontal" action="{{ route('staff-update-order', $order->id) }}">
        @endif
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
                    <label class="col-md-3" for="disabledTextInput">Other Approval Line</label>
                    <div class="col-md-9">
                        @foreach ($details as $detail)
                            <div class="row mb-1">
                                <div class="col-12">
                                    @if ($detail->user_id != Auth::user()->id)
                                        {{ $detail->staff->name }} - 
                                    @else
                                        </b>{{ $detail->staff->name }} (you) </b> - 
                                    @endif
                                    @if (is_null($detail->is_allow))
                                        <span class="badge badge-sm bg-secondary">pending</span>
                                    @elseif ($detail->is_allow == 0)
                                        <span class="badge badge-sm bg-danger">rejected</span>
                                    @else
                                        <span class="badge badge-sm bg-success">approved</span>
                                    @endif
                                </div>
                            </div>
                            @if ($detail->user_id != Auth::user()->id)
                            @else

                            @endif
                        @endforeach
                    </div>
                </div>

                @if(is_null($staff_approval->is_allow))
                    <div class="form-group row">
                        <label class="col-md-3" for="disabledTextInput">Your Approval</label>
                        <div class="col-md-9">
                            <select class="select2 form-select shadow-none" name="is_allow" style="width: 100%; height: 36px">
                            <option>Select Approval</option>
                            <option value="1">Approve</option>
                            <option value="0">Reject</option>
                        </select>
                        </div>
                    </div>
                @endif


			</div>
			<div class="border-top">
                @if(is_null($staff_approval->is_allow))
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                    </div>
                @else
                <div class="card-body">
                    <div class="alert alert-secondary" role="alert">
                        Approval is already submitted!!
                    </div>
                </div>
                @endif
			</div>
            @if(is_null($staff_approval->is_allow))
        </form>
        @endif
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