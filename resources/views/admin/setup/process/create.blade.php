@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Add Process
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.process.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('process_id') ? 'has-error' : '' }}">
                    <label for="process_id">Process ID*</label>
                    <input type="text" id="process_id" name="process_id" class="form-control" value="{{ old('process_id') }}" required>
                    @if($errors->has('process_id'))
                        <p class="help-block">
                            {{ $errors->first('process_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('process_name') ? 'has-error' : '' }}">
                    <label for="process_name">Process Name*</label>
                    <input type="text" id="process_name" name="process_name" class="form-control" value="{{ old('process_name') }}" required>
                    @if($errors->has('process_name'))
                        <p class="help-block">
                            {{ $errors->first('process_name') }}
                        </p>
                    @endif
                </div>
                
                <div>
                    <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                    <a href="{{   route('admin.setup.process') }}" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection