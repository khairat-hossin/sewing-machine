@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Edit Line
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.line.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $line->id }}">
                <div class="form-group {{ $errors->has('location_id') ? 'has-error' : '' }}">
                    <label for="location_id">Location Name*</label>
                    <select id="location_id" name="location_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($locationList AS $location)
                            <option value="{{ $location->id }}" {{ ($location->id== $line->location_id)? "selected": null }}>{{ $location->location_name }}</option>
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
                    <input type="text" id="line_name" name="line_name" class="form-control" value="{{ $line->line_name }}" required>
                    @if($errors->has('line_name'))
                        <p class="help-block">
                            {{ $errors->first('line_name') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('line_description') ? 'has-error' : '' }}">
                    <label for="line_description">Description</label>
                    <textarea id="line_description" name="line_description" class="form-control " style="min-height: 50px;"> {{ $line->line_description }}</textarea>
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
                                <option value="{{ $machine->id }}" {{ (is_array(unserialize($line->belonging_devices)))? ((in_array($machine->id, unserialize($line->belonging_devices))) ? "selected": null) : null }}>{{ $machine->machine_name }}</option>
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