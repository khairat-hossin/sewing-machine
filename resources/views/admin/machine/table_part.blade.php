
<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<div class="row" style="text-align: center;">
    <h1 style="margin:0; padding-bottom: 0;">LOGIKEYE Induatrial Network System</h1>
    <p style="margin: 0px; padding: 0px;">Machine Status</p>
</div>

<div class="card-body" id="printArea">
    <table class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>Sl.</th>
                <th>Machine Name</th>
                <th>Model</th>
                <th>Usage Rate</th>
                <th>Operating Rate</th>
                <th>Average Cycle Time</th>
                <th>Reference Cycle Time</th>
                <th>Acheivement Rate</th>
                <th>Total Target Pieces</th>
                <th>Current Target Pieces</th>
                <th>Sewing Pieces</th>
            </tr>
        </thead>
        <tbody>
            @php $sl=1; @endphp
            @foreach($data as $machine)
                <tr>
                    <td>{{$sl++}}</td>
                    <td>{{ $machine->machine_name }}</td>
                    <td>{{ $machine->model_no }}</td>
                    <td style="text-align: right;">{{ $machine->usage_rate }}%</td>
                    <td style="text-align: right;">{{ $machine->operating_rate }}%</td>
                    <td style="text-align: right;">{{ $machine->average_power_on_time ?? '0' }}</td>
                    <td style="text-align: right;">{{ ($machine->actual_time && $machine->sweing_pcs) ? ( (int)($machine->actual_time/$machine->sweing_pcs)): '0' }}</td>
                    <td style="text-align: right;">{{ $machine->achievement_ratio }}%</td>
                    <td style="text-align: right;">{{ $machine->target }}</td>
                    <td style="text-align: right;">{{ ($machine->target-$machine->sweing_pcs)? ($machine->target-$machine->sweing_pcs) : 0 }}</td>
                    <td style="text-align: right;">{{ $machine->sweing_pcs }}</td>
                </tr>
            @endforeach
                

            {{-- <tr>
                <td>2</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
            </tr>
            <tr>
                <td>3</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
            </tr>
            <tr>
                <td>4</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
            </tr> --}}

        </tbody>
    </table>
</div>