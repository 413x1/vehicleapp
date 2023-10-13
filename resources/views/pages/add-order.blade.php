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
		<form action="" method="post" class="form-horizontal" action="{{ route('root-order-store') }}">
	@else
		<form action="" method="post" class="form-horizontal" action="{{ route('admin-order-store') }}">
	@endif
			@csrf
			<div class="card-body">
				<h4 class="card-title">Order Form</h4>

				<div class="form-group row">
					<label for="fname" class="col-sm-3 text-end control-label col-form-label">Return time</label>
					<div class="col-md-9">
					<input name="return_at" type="datetime-local" class="form-control" id="lname" value="{{ date('Y-m-d\TH:i:00', time()+3660) }}" min="{{ date('Y-m-d\TH:i:00', time()+3660) }}"/>
					</div>
				</div>

				<div class="form-group row">
					<label for="fname" class="col-sm-3 text-end control-label col-form-label">Driver</label>
					<div class="col-md-9">
					<select class="select2 form-select shadow-none" name="driver_id" style="width: 100%; height: 36px">
						<option>Select drivers</option>
						@foreach ($drivers as $driver)
							<option value="{{ $driver->id }}">{{ $driver->name }}</option>
						@endforeach
					</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="fname" class="col-sm-3 text-end control-label col-form-label">Vehicle</label>
					<div class="col-md-9">
					<select class="select2 form-select shadow-none" name="vehicle_id" style="width: 100%; height: 36px">
						<option>Select vehicle</option>
						@foreach ($vehicles as $vehicle)
							<option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
						@endforeach
					</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 text-end control-label col-form-label">Staff approval</label>
					<div class="col-md-9">
						<select class="select2 form-select shadow-none mt-3" multiple="multiple" name="staff_ids[]" style="height: 30px; width: 100%;">
							@foreach ($staffs as $staff)
								<option value="{{ $staff->id }}">{{ $staff->name }}</option>
							@endforeach
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