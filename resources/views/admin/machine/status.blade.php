@extends('layouts.admin')
@section('content')
<div class="row text-center" style="margin-bottom: 10px;">
	<div class="col-lg-12">
		<h1 class="text-center">Machine Status</h1>
	</div>

</div>
<div class="container">
	<div class="row">
		@foreach($machines as $key => $machine)
			<div class="col-md-2 col-sm-2 col-xs-6">
				<div class="card flex-row flex-wrap {{ $machine->class }}">
					<div class="card-header border-0" style="padding: 0; margin: 0">
			            <img class="card-img-left" src="{{asset('images/113310.svg')}}" alt="" height="30" width="50">
			            <span>{{$machine->model_no}}</span>
			        </div>
			        <div class="card-block px-2">
			            <h4 class="card-text">{{ $machine->machine_id }}</h4>
			        </div>
				</div>
			</div>
		@endforeach

	</div>
</div>
@endsection
@section('scripts')
@parent

@endsection
