
<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<div class="row" style="text-align: center;">
    <h1 style="margin:0; padding-bottom: 0;">LOGIKEYE Induatrial Network System</h1>
    <p style="margin: 0px; padding: 0px;">NPT</p>
</div>
@php $index=1; @endphp
<div class="card-body" id="printArea">
    <table class="table table-bordered table-striped table-responsive">
		<thead>
			<tr>
				<th>Sl</th>
	            <th>Machine</th>
	            <th>Machine Problem</th>
	            <th>Needle Broken</th>
	            <th>Thread Broken</th>
	            <th>Refreshment</th>
	            <th>Others</th>
	            <th>Breakdown</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $npt)
				<tr>
					<td>{{$index++}}</td>
					<td>{{ $npt->machine_name }}</td>
					<td style="text-align: right; padding-right: 3px;">{{ $npt->machine_problem }}</td>
					<td style="text-align: right; padding-right: 3px;">{{ $npt->needle_broken }}</td>
					<td style="text-align: right; padding-right: 3px;">{{ $npt->thread_broken }}</td>
					<td style="text-align: right; padding-right: 3px;">{{ $npt->refreshment }}</td>
					<td style="text-align: right; padding-right: 3px;">{{ $npt->others }}</td>
					<td style="text-align: right; padding-right: 3px;">{{ (int)((int)$npt->machine_name+ (int) $npt->machine_problem+ (int)$npt->needle_broken+ (int)$npt->thread_broken+ (int)$npt->refreshment+ (int)$npt->others) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>