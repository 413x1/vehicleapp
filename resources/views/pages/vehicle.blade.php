@extends('layouts.app')

@section('content')
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<h5 class="card-title">Vehicle Data</h5>
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
					<table id="vehicleTable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Plat Code</th>
								<th>Content</th>
								<th>Is Owned</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($vehicles as $vehicle)
							<tr>
								<th>{{$vehicle->name}}</th>
								<th>{{$vehicle->plat_code}}</th>
								<th>{{$vehicle->content}}</th>
								@if ($vehicle->is_owned)
								<th>Yes</th>
								@else
								<th>No</th>
								@endif
								<th>-</th>
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
        var elt = document.getElementById("vehicleTable");
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ? XLSX.write(wb, { bookType: type, bookSST: true, type: "base64" }) : XLSX.writeFile(wb, fn || "VehicleTable." + (type || "xlsx"));
    }
    $("#vehicleTable").DataTable();
</script>
@stop
