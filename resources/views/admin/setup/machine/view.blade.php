@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            View Machine
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Machine Name</th>
                        <td>{{ $machine->machine_name }}</td>
                    </tr>
                    <tr>
                        <th>Serial No</th>
                        <td>{{ $machine->serial_no }}</td>
                    </tr>
                    <tr>
                        <th>Model No</th>
                        <td>{{ $machine->model_no }}</td>
                    </tr>
                    <tr>
                        <th>Locatrion Name</th>
                        <td>{{ $machine->location_name }}</td>
                    </tr>
                    <tr>
                        <th>Line Name</th>
                        <td>{{ $machine->line_name }}</td>
                    </tr>
                    <tr>
                        <th>Machine Description</th>
                        <td>{{ $machine->machine_description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection