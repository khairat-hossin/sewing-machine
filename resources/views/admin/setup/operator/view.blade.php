@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Add Operator
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Operator ID</th>
                        <td>{{ $operator->operator_id }}</td>
                    </tr>

                    <tr>
                        <th>Operator Name</th>
                        <td>{{ $operator->operator_name }}</td>
                    </tr>

                    <tr>
                        <th>Location Name</th>
                        <td>{{ $operator->location_name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection