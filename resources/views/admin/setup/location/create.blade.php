@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Add Location
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.location.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('location_name') ? 'has-error' : '' }}">
                    <label for="location_name">Location Name*</label>
                    <input type="text" id="location_name" name="location_name" class="form-control" value="{{ old('location_name') }}" required>
                    @if($errors->has('location_name'))
                        <p class="help-block">
                            {{ $errors->first('location_name') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="operating_time_start">Operating Time*</label>
                    <div class="form-group form-inline {{ $errors->has('operating_time_start') || $errors->has('operating_time_end')  ? 'has-error' : '' }}">
                        <input type="text" id="operating_time_start" name="operating_time_start" class="form-control col-sm-3 timepicker" value="{{ old('operating_time_start') }}" required>
                        <div class="col-sm-1 text-center">-</div>
                        <input type="text" id="operating_time_end" name="operating_time_end" class="form-control col-sm-3 timepicker" value="{{ old('operating_time_end') }}" required>
                    </div>
                    @if($errors->has('operating_time_start') || $errors->has('operating_time_end'))
                        <p class="help-block">
                            {{ $errors->first('operating_time_start') }} {{ $errors->first('operating_time_end') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="rest_1_start">Rest Time*</label>
                    <div class="form-group form-inline {{ $errors->has('rest_1_start') || $errors->has('rest_1_end')  ? 'has-error' : '' }}">
                        <input type="text" id="rest_1_start" name="rest_1_start" class="form-control col-sm-3 timepicker" value="{{ old('rest_1_start') }}">
                        <div class="col-sm-1 text-center">-</div>
                        <input type="text" id="rest_1_end" name="rest_1_end" class="form-control col-sm-3 timepicker" value="{{ old('rest_1_end') }}">
                    </div>

                    <div class="form-group form-inline {{ $errors->has('rest_2_start') || $errors->has('rest_2_end')  ? 'has-error' : '' }}">
                        <input type="text" id="rest_2_start" name="rest_2_start" class="form-control col-sm-3 timepicker" value="{{ old('rest_2_start') }}">
                        <div class="col-sm-1 text-center">-</div>
                        <input type="text" id="rest_2_end" name="rest_2_end" class="form-control col-sm-3 timepicker" value="{{ old('rest_2_end') }}">
                    </div>

                    <div class="form-group form-inline {{ $errors->has('rest_3_start') || $errors->has('rest_3_end')  ? 'has-error' : '' }}">
                        <input type="text" id="rest_3_start" name="rest_3_start" class="form-control col-sm-3 timepicker" value="{{ old('rest_3_start') }}">
                        <div class="col-sm-1 text-center">-</div>
                        <input type="text" id="rest_3_end" name="rest_3_end" class="form-control col-sm-3 timepicker" value="{{ old('rest_3_end') }}">
                    </div>

                    <div class="form-group form-inline {{ $errors->has('rest_4_start') || $errors->has('rest_4_end')  ? 'has-error' : '' }}">
                        <input type="text" id="rest_4_start" name="rest_4_start" class="form-control col-sm-3 timepicker" value="{{ old('rest_4_start') }}">
                        <div class="col-sm-1 text-center">-</div>
                        <input type="text" id="rest_4_end" name="rest_4_end" class="form-control col-sm-3 timepicker" value="{{ old('rest_4_end') }}">
                    </div>
                </div>

                <div class="form-group {{ $errors->has('location_description') ? 'has-error' : '' }}">
                    <label for="location_description">Description</label>
                    <textarea id="location_description" name="location_description" class="form-control " style="min-height: 50px;"> {{ old('location_description') }}</textarea>
                    @if($errors->has('location_description'))
                        <p class="help-block">
                            {{ $errors->first('location_description') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-top" for="duallist"> Belonging Lines </label>

                    <div class="col-sm-8">
                        
                        <select multiple="multiple" size="10" name="duallistbox_demo1[]" id="duallist" style="display: none;">
                            @foreach($lines AS $line)
                                <option value="{{ $line->id }}">{{ $line->line_name }}</option>
                            @endforeach
                        </select>

                        <div class="hr hr-16 hr-dotted"></div>
                    </div>
                </div>
                <div>
                    <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                    <a href="{{   route('admin.setup.location') }}" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection