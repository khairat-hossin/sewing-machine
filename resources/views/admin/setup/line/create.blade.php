@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Add Line
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.line.store') }}" method="POST" enctype="multipart/form-data">
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
                <div class="form-group {{ $errors->has('line_name') ? 'has-error' : '' }}">
                    <label for="line_name">Line Name*</label>
                    <input type="text" id="line_name" name="line_name" class="form-control" value="{{ old('line_name') }}" required>
                    @if($errors->has('line_name'))
                        <p class="help-block">
                            {{ $errors->first('line_name') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('line_description') ? 'has-error' : '' }}">
                    <label for="line_description">Description</label>
                    <textarea id="line_description" name="line_description" class="form-control " style="min-height: 50px;"> {{ old('line_description') }}</textarea>
                    @if($errors->has('line_description'))
                        <p class="help-block">
                            {{ $errors->first('line_description') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-top" for="duallist"> Belonging Machines </label>

                    <div class="col-sm-8">
                        
                        <select multiple="multiple" size="10" name="duallistbox_demo1[]" id="duallist" style="display: none;">
                            @foreach($machines AS $machine)
                                <option value="{{ $machine->id }}">{{ $machine->machine_name }}</option>
                            @endforeach
                        </select>

                        <div class="hr hr-16 hr-dotted"></div>
                    </div>
                </div>
                
                <div>
                    <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                    <a href="{{   route('admin.setup.line') }}" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection