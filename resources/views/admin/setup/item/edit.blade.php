@extends('layouts.admin')
@section('content')
@include('inc/message')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            Add Item
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setup.item.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('item_code') ? 'has-error' : '' }}">
                    <label for="item_code">Item Code*</label>
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="text" id="item_code" name="item_code" class="form-control" value="{{ ($item->item_code)? $item->item_code :null }}" required>
                    @if($errors->has('item_code'))
                        <p class="help-block">
                            {{ $errors->first('item_code') }}
                        </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('item_name') ? 'has-error' : '' }}">
                    <label for="item_name">Item Name*</label>
                    <input type="text" id="item_name" name="item_name" class="form-control" value="{{ ($item->item_name)? $item->item_name :null }}" required>
                    @if($errors->has('item_name'))
                        <p class="help-block">
                            {{ $errors->first('item_name') }}
                        </p>
                    @endif
                </div>
                
                <div>
                    <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                    <a href="{{route('admin.setup.item') }}" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection