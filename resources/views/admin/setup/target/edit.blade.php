@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Edit Target
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.target.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('target_date') ? 'has-error' : '' }}">
                    <label for="target_date">Target From*</label>
                    <input type="hidden" name="id" value="{{ $target->id }}">
                    <input type="date" id="target_date" name="target_date" class="form-control" value="{{ $target->target_date }}" placeholder="Enter Target Value" required>
                    @if($errors->has('target_date'))
                        <p class="help-block">
                            {{ $errors->first('target_date') }}
                        </p>
                    @endif
                </div> 

                <div class="form-group {{ $errors->has('target_date_end') ? 'has-error' : '' }}">
                    <label for="target_date_end">Target To*</label>
                    <input type="hidden" name="id" value="{{ $target->id }}">
                    <input type="date" id="target_date_end" name="target_date_end" class="form-control" value="{{ $target->target_date_end }}" placeholder="Enter Target Value" required>
                    @if($errors->has('target_date_end'))
                        <p class="help-block">
                            {{ $errors->first('target_date_end') }}
                        </p>
                    @endif
                </div>            

                <div class="form-group {{ $errors->has('machine_id') ? 'has-error' : '' }}">
                    <label for="machine_id">Machine Name*</label>
                    <select id="machine_id" name="machine_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($machineList AS $machine)
                            <option value="{{ $machine->id }}" {{  ($machine->id == $target->machine_id) ? "selected" : null }}>{{ $machine->machine_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('machine_id'))
                        <p class="help-block">
                            {{ $errors->first('machine_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('operator_id') ? 'has-error' : '' }}">
                    <label for="operator_id">Operator Name*</label>
                    <select id="operator_id" name="operator_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($operatorList AS $operator)
                            <option value="{{ $operator->id }}" {{  ($operator->id == $target->operator_id) ? "selected" : null }} >{{ $operator->operator_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('operator_id'))
                        <p class="help-block">
                            {{ $errors->first('operator_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('item_id') ? 'has-error' : '' }}">
                    <label for="item_id">Item Name*</label>
                    <select id="item_id" name="item_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($itemList AS $item)
                            <option value="{{ $item->id }}" {{  ($item->id == $target->item_id) ? "selected" : null }} >{{ $item->item_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('item_id'))
                        <p class="help-block">
                            {{ $errors->first('item_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('process_id') ? 'has-error' : '' }}">
                    <label for="process_id">Process Name*</label>
                    <select id="process_id" name="process_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($processList AS $process)
                            <option value="{{ $process->id }}" {{  ($process->id == $target->process_id) ? "selected" : null }}  >{{ $process->process_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('process_id'))
                        <p class="help-block">
                            {{ $errors->first('process_id') }}
                        </p>
                    @endif
                </div>



                <div class="form-group {{ $errors->has('target_value') ? 'has-error' : '' }}">
                    <label for="target_value">Target*</label>
                    <input type="number" id="target_value" name="target_value" class="form-control" value="{{ $target->target_value }}" placeholder="Enter Target Value" required>
                    @if($errors->has('target_value'))
                        <p class="help-block">
                            {{ $errors->first('target_value') }}
                        </p>
                    @endif
                </div>


                <div>
                    <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                    <a href="{{ route('admin.setup.target') }}" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection