@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <a type="button" href="{{ route('admin-order-create') }}" class="btn btn-primary">
                Primary
            </a>
        </div>
        <div class="card-body">
            <h5 class="card-title">Basic Datatable</h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
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
<script>
    $("#zero_config").DataTable();
</script>
@stop