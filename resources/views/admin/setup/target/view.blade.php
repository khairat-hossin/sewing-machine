@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            View Target
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Target From</th>
                        <td>{{ $target->target_date }}</td>
                    </tr>
                    <tr>
                        <th>Target To</th>
                        <td>{{ $target->target_date_end }}</td>
                    </tr>
                    <tr>
                        <th>Machine Name</th>
                        <td>{{ $target->machine_name }}</td>
                    </tr>
                    <tr>
                        <th>Operator Name</th>
                        <td>{{ $target->operator_name }}</td>
                    </tr>
                    <tr>
                        <th>Item Name</th>
                        <td>{{ $target->item_name }}</td>
                    </tr>
                    <tr>
                        <th>Process Name</th>
                        <td>{{ $target->process }}</td>
                    </tr>
                    <tr>
                        <th>Target Value</th>
                        <td>{{ $target->target_value }}</td>
                    </tr>
                    <tr>
                        <th>Achievement Value</th>
                        <td>{{ $target->achieved_value }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection