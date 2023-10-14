@extends('layouts.app')

@section('content')
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<h5 class="card-title">Order Logs Data</h5>
					</div>
					<div class="col-auto align-right">
						<button type="button" onclick="ExportToExcel('xlsx')" class="btn btn-info btn-sm">
							Export excel
						</button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<h5 class="card-title">Basic Datatable</h5>
				<div class="table-responsive">
					<table id="orderLogsTable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Order Vehicle</th>
								<th>User</th>
								<th>Role</th>
								<th>Description</th>
								<th>Datetime</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($order_logs as $log)
							<tr>
								<th>{{$log->order_id}}</th>
								<th>{{!is_null($log->order_id) ? $log->order->vehicle->name : '-' }}</th>
								<th>{{ $log->user->name }}</th>
								<th>{{ $log->user->role }}</th>
								<th>{{ $log->description }}</th>
								<th>{{ $log->created_at }}</th>
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
        var elt = document.getElementById("orderLogsTable");
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ? XLSX.write(wb, { bookType: type, bookSST: true, type: "base64" }) : XLSX.writeFile(wb, fn || "OrderLogsTable." + (type || "xlsx"));
    }

    $("#orderLogsTable").DataTable();
</script>
@stop
