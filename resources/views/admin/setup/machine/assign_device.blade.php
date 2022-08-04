@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Add Machine
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.machine.store_device') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('machine_name') ? 'has-error' : '' }}">
                    <label for="machine_name">Machine*</label>
                    <input type="hidden" name="machine_id" value="{{ $machine->id }}">
                    <input type="text" id="machine_name" name="machine_name" class="form-control" value="{{ $machine->machine_name }}" required readonly>
                    @if($errors->has('machine_name'))
                        <p class="help-block">
                            {{ $errors->first('machine_name') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('device_id') ? 'has-error' : '' }}">
                    <label for="device_id">Device Name*</label>
                    <select id="device_id" name="device_id" class="form-control" required>
                        @if($deviceList->count())
                        <option value="">Select Device</option>
                        @foreach($deviceList AS $device)
                            <option value="{{ $device->id }}">{{ $device->device_name }}-{{$device->device_model_no}}</option>
                        @endforeach
                        @else
                        <option value="">No Device to Select</option>
                        @endif
                    </select>
                    @if($errors->has('device_id'))
                        <p class="help-block">
                            {{ $errors->first('device_id') }}
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