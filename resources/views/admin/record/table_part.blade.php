
<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<div class="row" style="text-align: center;">
    <h1 style="margin:0; padding-bottom: 0;">LOGIKEYE Induatrial Network System</h1>
    <p style="margin: 0px; padding: 0px;">Date Wise Record</p>
    <p style="margin: 0px; padding: 0px;">{{ date('d-M-Y', strtotime($date)) }}</p>
</div>
@php $index=1; @endphp
<div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Machine Name</th>
                <th>Line Name</th>
                <th>Operator Name</th>
                <th>Target Value</th>
                <th>Sewing value(Pcs)</th>
                <th>Buyer Name</th>
                <th>NPT</th>
            </tr>
        </thead>
        <tbody id="table_body">
        	@foreach($data as $machine)
        		<tr>
        			<td>{{ $index++}}</td>
        			<td> {{$machine->machine_name}} </td>
        			<td> {{$machine->line_name}} </td>
        			<td> {{$machine->operator_name}} </td>
        			<td style="text-align: right; padding-right: 3px;"> {{$machine->target_value ?? 0}} </td>
        			<td style="text-align: right; padding-right: 3px;"> {{$machine->achieved_value ?? 0}} </td>
        			<td> {{$machine->buyer_name}} </td>
        			<td style="text-align: right; padding-right: 3px;"> {{$machine->npts ?? 0}} </td>
        		</tr>
        	@endforeach
        </tbody>
    </table>
</div>