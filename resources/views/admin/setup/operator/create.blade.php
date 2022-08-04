@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Add Operator
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.operator.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('location_id') ? 'has-error' : '' }}">
                    <label for="location_id">Location Name*</label>
                    <select id="location_id" name="location_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($locationList AS $location)
                            <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('location_id'))
                        <p class="help-block">
                            {{ $errors->first('location_id') }}
                        </p>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('operator_id') ? 'has-error' : '' }}">
                    <label for="operator_id">Operator ID*</label>
                    <input type="text" id="operator_id" name="operator_id" class="form-control" value="{{ old('operator_id') }}" required>
                    @if($errors->has('operator_id'))
                        <p class="help-block">
                            {{ $errors->first('operator_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('operator_name') ? 'has-error' : '' }}">
                    <label for="operator_name">Operator Name*</label>
                    <input type="text" id="operator_name" name="operator_name" class="form-control" value="{{ old('operator_name') }}" required>
                    @if($errors->has('operator_name'))
                        <p class="help-block">
                            {{ $errors->first('operator_name') }}
                        </p>
                    @endif
                </div>
                
                <div>
                    <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                    <a href="{{   route('admin.setup.operator') }}" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection