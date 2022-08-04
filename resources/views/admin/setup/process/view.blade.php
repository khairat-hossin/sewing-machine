@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            View Process
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Process ID</th>
                        <td>{{ $process->process_id }}</td>
                    </tr>
                    <tr>
                        <th>Process Name</th>
                        <td>{{ $process->process_name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection