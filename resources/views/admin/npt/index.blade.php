@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header text-center">
        <h3>Non Productive Times</h3>
        <form action="{{ route('admin.npt_by_date.pdf') }}" target="_blank" method="get" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="col-sm-12 row" style="align-content: center ">  
                <div class="input-group col-sm-6 offset-sm-3">
                    <input type="date" name="npt_date" id="npt_date" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-warning" type="button" id="search_button">
                            <i class="fa fa-search"> See Record</i>
                        </button>&nbsp &nbsp &nbsp
                        <button type="submit" id="pdf_button" class="btn btn-success float-right"><i class="fas fa-file-pdf"></i> Download</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered">
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
            <tbody id="table_body">
                @php $i=1; @endphp
                @if($npts->count()>0)    
                    @foreach($npts as $npt)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $npt->machine_name }}</td>
                            <td>{{ $npt->machine_problem }}</td>
                            <td>{{ $npt->needle_broken }}</td>
                            <td>{{ $npt->thread_broken }}</td>
                            <td>{{ $npt->refreshment }}</td>
                            <td>{{ $npt->others }}</td>
                            <td>{{ ($npt->machine_problem+$npt->needle_broken+$npt->thread_broken+$npt->refreshment + $npt->others) }}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center"> No data found!</td>
                        </tr>
                    @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script type="text/javascript">
    $('#search_button').click(function() {
        var date= $("#npt_date").val();
        if(date){
            $.ajax({
                type: "GET",
                url: "{{ url('admin/npt_by_date') }}",
                data: {date: date},
                success: function(data) {
                    console.log(data);

                    let code="";

                    $.each(data, function(index, value) {
                        code+= "<tr>\
                            <td>"+(index+1)+"</td>\
                            <td>"+ value.machine_name +"</td>\
                            <td>"+value.machine_problem +"</td>\
                            <td>"+value.needle_broken +"</td>\
                            <td>"+value.thread_broken +"</td>\
                            <td>"+value.refreshment +"</td>\
                            <td>"+value.others +"</td>\
                            <td>"+ parseInt(value.machine_problem + value.needle_broken + value.thread_broken + value.refreshment + value.others) +"</td>\
                        </tr>";
                    });

                   $("#table_body").html(code);
                },
                error: function (error) {
                    console.log("error");
                }

            });
        }
        else{
            alert("Please Select a date!");
        }
    });

    $('#pdf_button').click(function(e) {
        var date= $("#npt_date").val();
        if(!date){
            alert("Please Select a date!");
            e.preventDefault();
        }
    });
</script>
@endsection