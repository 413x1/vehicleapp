@extends('layouts.app')

@section('content')
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<h5 class="card-title">Driver Data</h5>
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
					<table id="driverTable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>License code</th>
								<th>Status</th>
								<th>Car Name</th>
								<th>Order Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($drivers as $driver)
							<tr>
								<th>{{$driver->name}}</th>
								<th>{{$driver->license_code}}</th>
								<th>Free</th>
								<th>Random</th>
								<th>---</th>
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
        var elt = document.getElementById("driverTable");
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ? XLSX.write(wb, { bookType: type, bookSST: true, type: "base64" }) : XLSX.writeFile(wb, fn || "DriverTable." + (type || "xlsx"));
    }
    $("#driverTable").DataTable();
</script>
@stop
