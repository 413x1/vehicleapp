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
                                <th>---</th>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Name</th>
                          <th>Plat Code</th>
                          <th>Content</th>
                          <th>Is Owned</th>
                          <th>Status</th>
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