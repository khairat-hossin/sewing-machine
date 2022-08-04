@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            View Location
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Location Name</th>
                        <td>{{ $location->location_name }}</td>
                    </tr>
                    <tr>
                        <th>Operating Time</th>
                        <td>{{ $location->operating_time_start }} - {{ $location->operating_time_end }}</td>
                    </tr>
                    <tr>
                        <th>Rest Time 1</th>
                        <td>{{ $location->rest_1_start }} - {{ $location->rest_1_end }}</td>
                    </tr>
                    <tr>
                        <th>Rest Time 2</th>
                        <td>{{ $location->rest_2_start }} - {{ $location->rest_2_end }}</td>
                    </tr>
                    <tr>
                        <th>Rest Time 3</th>
                        <td>{{ $location->rest_3_start }} - {{ $location->rest_3_end }}</td>
                    </tr>
                    <tr>
                        <th>Rest Time 4</th>
                        <td>{{ $location->rest_4_start }} - {{ $location->rest_4_end }}</td>
                    </tr>
                    <tr>
                        <th>Rest Time 5</th>
                        <td>{{ $location->rest_5_start }} - {{ $location->rest_5_end }}</td>
                    </tr>
                    <tr>
                        <th>Location Description</th>
                        <td>{{ $location->location_description }}</td>
                    </tr>
                    <tr>
                        <th>Belonging Lines</th>
                        <td>
                            @foreach($line_names as $id => $value)
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