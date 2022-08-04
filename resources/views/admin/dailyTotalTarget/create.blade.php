@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="card">
    <div class="card-header">
        Add Target
    </div>

    <div class="card-body">
        <form action="{{ route('daily.total.target.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            
            <div class="form-group {{ $errors->has('target_date') ? 'has-error' : '' }}">
                <label for="target_date" class="col-sm-5">Target Date*</label>
                <input type="date" id="target_date" name="target_date" class="form-control col-sm-5" value="{{ old('target_date') }}" required>
                @if($errors->has('target_date'))
                    <p class="help-block">
                        {{ $errors->first('target_date') }}
                    </p>
                @endif
            </div>

            <div class="form-group {{ $errors->has('target_value') ? 'has-error' : '' }}">
                <label for="target_value" class="col-sm-5">Target Value*</label>
                <input type="number" id="target_value" name="target_value" class="form-control col-sm-5" value="{{ old('target_value') }}" required>
                @if($errors->has('target_value'))
                    <p class="help-block">
                        {{ $errors->first('target_value') }}
                    </p>
                @endif
            </div>
            
            <div>
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                <a href="{{   route('daily.total.target') }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection