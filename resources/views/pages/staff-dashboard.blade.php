@extends('layouts.app')

@section('content')
	<div class="col-12">
		<div class="row">
			<div class="col mt-3">
				<div class="bg-dark p-10 text-white text-center">
					<i class="mdi mdi-inbox-arrow-down fs-3 font-16"></i>
					<h5 class="mb-0 mt-1">{{ $new_approvals->count() }}</h5>
					<small class="font-light">New approval</small>
				</div>
			</div>
			<div class="col mt-3">
				<div class="bg-dark p-10 text-white text-center">
					<i class="mdi mdi-bookmark-check fs-3 font-16"></i>
					<h5 class="mb-0 mt-1">{{ $approveds->count() }}</h5>
					<small class="font-light">Approved</small>
				</div>
			</div>
			<div class="col mt-3">
				<div class="bg-dark p-10 text-white text-center">
					<i class="mdi mdi-bookmark-remove fs-3 font-16"></i>
					<h5 class="mb-0 mt-1">{{ $rejecteds->count() }}</h5>
					<small class="font-light">Rejected</small>
				</div>
			</div>
			<div class="col mt-3">
				<div class="bg-dark p-10 text-white text-center">
					<i class="mdi mdi-book-open fs-3 font-16"></i>
					<h5 class="mb-0 mt-1">{{ $orders->count() }}</h5>
					<small class="font-light">Total Order</small>
				</div>
			</div>
			<div class="col mt-3">
				<div class="bg-dark p-10 text-white text-center">
					<i class="mdi mdi-car fs-3 font-16"></i>
					<h5 class="mb-0 mt-1">{{ isset($last_approval) ? $last_approval->vehicle_name : '0' }}</h5>
					<small class="font-light">Last Car Approved</small>
				</div>
			</div>
			<div class="col mt-3">
				<div class="bg-dark p-10 text-white text-center">
					<i class="mdi mdi-worker fs-3 font-16"></i>
					<h5 class="mb-0 mt-1">{{ isset($last_approval) ? $last_approval->driver_name : '0' }}</h5>
					<small class="font-light">Last Driver Approved</small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 mt-3">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<h5 class="card-title">My Order Data</h5>
					</div>
					<div class="col-auto align-right">
						<button type="button" onclick="ExportToExcel('xlsx')" class="btn btn-info btn-sm">
							Export excel
						</button>
					</div>
				</div>
			</div>
			<div class="card-body px-0">
				<div class="table-responsive">
					<table id="myOrderTable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Car</th>
								<th>Driver</th>
								<th>Status</th>
								<th>Return Time</th>
								<th>Request time</th>
								<th>Staff Name</th>
								<th>Approval</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($orders as $order)
							<tr>
								<th>
									<a href="{{ route('staff-show-order', $order->order_id) }}">
										{{ $order->vehicle_name }}
									</a>
								</th>
								<th>{{ $order->driver_name }}</th>
								<th>{{ $order->order_status }}</th>
								<th>{{ $order->return_at }}</th>
								<th>{{ $order->request_time }}</th>
								<th>{{ $order->staff_name }}</th>
								<th>{{ $order->is_allow == 1 ? 'Approved' : 'Decline' }}</th>
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
<script src="{{ asset('/thema/js/xlsx.full.min.js') }}"></script>
<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById("myOrderTable");
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ? XLSX.write(wb, { bookType: type, bookSST: true, type: "base64" }) : XLSX.writeFile(wb, fn || "MyOrderTable." + (type || "xlsx"));
    }
    $("#myOrderTable").DataTable({
        order: [[3, "desc"]],
    });
</script>
@stop
