@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Edit Machine
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.machine.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('location_id') ? 'has-error' : '' }}">
                    <label for="location_id">Location Name*</label>
                    <input type="hidden" name="id" value="{{ $machine->id }}">
                    <select id="location_id" name="location_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($locationList AS $location)
                            <option value="{{ $location->id }}" {{ ($location->id== $machine->location_id) ? "selected" : null }}>{{ $location->location_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('location_id'))
                        <p class="help-block">
                            {{ $errors->first('location_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('line_id') ? 'has-error' : '' }}">
                    <label for="line_id">Line Name*</label>
                    <select id="line_id" name="line_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($lineList AS $line)
                            <option value="{{ $line->id }}" {{ ($line->id== $machine->line_id) ? "selected" : null }}>{{ $line->line_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('line_id'))
                        <p class="help-block">
                            {{ $errors->first('line_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('model_no') ? 'has-error' : '' }}">
                    <label for="model_no">Model*</label>
                    <input type="text" id="model_no" name="model_no" class="form-control" value="{{ $machine->model_no }}" placeholder="Will Be Auto Input" required>
                    @if($errors->has('model_no'))
                        <p class="help-block">
                            {{ $errors->first('model_no') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('serial_no') ? 'has-error' : '' }}">
                    <label for="serial_no">Serial Number*</label>
                    <input type="text" id="serial_no" name="serial_no" class="form-control" value="{{ $machine->serial_no }}" placeholder="Will Be Auto Input" required>
                    @if($errors->has('serial_no'))
                        <p class="help-block">
                            {{ $errors->first('serial_no') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('machine_name') ? 'has-error' : '' }}">
                    <label for="machine_name">Machine Name*</label>
                    <input type="text" id="machine_name" name="machine_name" class="form-control" value="{{ $machine->machine_name  }}" required>
                    @if($errors->has('machine_name'))
                        <p class="help-block">
                            {{ $errors->first('machine_name') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('machine_description') ? 'has-error' : '' }}">
                    <label for="machine_description">Description</label>
                    <textarea id="machine_description" name="machine_description" class="form-control " style="min-height: 50px;"> {{ $machine->machine_description }}</textarea>
                    @if($errors->has('machine_description'))
                        <p class="help-block">
                            {{ $errors->first('machine_description') }}
                        </p>
                    @endif
                </div>
                
                <div>
                    <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                    <a href="{{   route('admin.setup.machine') }}" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection