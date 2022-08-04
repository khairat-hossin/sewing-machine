
<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<div class="row" style="text-align: center;">
    <h1 style="margin:0; padding-bottom: 0;">LOGIKEYE Induatrial Network System</h1>
    <p style="margin: 0px; padding: 0px;">Machine Wise Record</p>
</div>
@php $index=1; @endphp
<div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Date</th>
                <th>Operator Name</th>
                <th>Target Value</th>
                <th>Sewing value(Pcs)</th>
                <th>Buyer Name</th>
                <th>NPT</th>
            </tr>
        </thead>
        <tbody id="table_body">
            @for($i=0; $i<90; $i++)
            
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{ $data['dates'][$i] }}</td>
                    <td>{{ $data['operator_name'] }}</td>
                    <td style="text-align: right; padding-right: 3px;">{{ $data['targets'][$i] ?? 0 }}</td>
                    <td style="text-align: right; padding-right: 3px;">{{ $data['achievements'][$i] ?? 0 }}</td>
                    <td>{{ $data['buyer_name'] }}</td>
                    <td style="text-align: right; padding-right: 3px;">{{ $data['npts'][$i] }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>