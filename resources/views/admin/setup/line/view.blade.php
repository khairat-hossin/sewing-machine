@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            View Line
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Line Name</th>
                        <td>{{ ($line->line_name) ? $line->line_name : null }}</td>
                    </tr>
                    <tr>
                        <th>Location Name</th>
                        <td>{{ ($line->location_name) ? $line->location_name : null }}</td>
                    </tr>
                    <tr>
                        <th>Line Description</th>
                        <td>{{ ($line->line_description) ? $line->line_description : null }}</td>
                    </tr>
                    <tr>
                        <th>Belonging Devices</th>
                        <td>
                            @foreach($machine_names as $id => $value)
                                {{ $value }} <br>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection