@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">{{ Auth::user()->role == 'root' ? 'User' : 'Staff'}} Data</h5>
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
                <table id="userTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $user->name }}</th>
                                <th>{{ $user->email }}</th>
                                <th>{{ $user->username }}</th>
                                <th>{{ $user->role }}</th>
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
        var elt = document.getElementById("userTable");
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ? XLSX.write(wb, { bookType: type, bookSST: true, type: "base64" }) : XLSX.writeFile(wb, fn || "{{ Auth::user()->role == 'root' ? 'User' : 'Staff'}}Table." + (type || "xlsx"));
    }
    
    $("#userTable").DataTable();
</script>
@stop