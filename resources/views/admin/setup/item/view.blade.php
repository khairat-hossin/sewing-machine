@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            View Item
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Item Code</th>
                        <td>{{ $item->item_code }}</td>
                    </tr>
                    <tr>
                        <th>Item Name</th>
                        <td>{{ $item->item_name }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection