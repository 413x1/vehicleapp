@extends('layouts.app')

@section('content')
<div class="col-12">
<div class="card">
                <div class="card-body">
                  <h5 class="card-title">Basic Datatable</h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
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
                      <tfoot>
                        <tr>
                          <th>Name</th>
                          <th>License code</th>
                          <th>Status</th>
                          <th>Car Name</th>
                          <th>Order Status</th>
                        </tr>
                      </tfoot>
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