@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header text-center">
        <form action="{{ route('record.date_wise.pdf') }}" method="GET" class="form-horizontal" enctype="multipart/form-data" target="_blank">
            @csrf
            <div class="col-sm-12 row" style="align-content: center ">  
                <div class="input-group col-sm-6 offset-sm-3">
                    <input type="date" class="form-control" name="record_date" id="record_date">
                    <div class="input-group-append">
                        <button class="btn btn-warning" type="button" id="search_button">
                            <i class="fa fa-search"> See Record</i>
                        </button>
                        &nbsp &nbsp &nbsp
                        <button type="submit" id="pdf_button" class="btn btn-success float-right"><i class="fas fa-file-pdf"></i> Download</button>
                    </div>
                </div>
            </div>
        </form>
            
    </div>

    <div id="loader" class="text-center" style="display: none">
        <div class="spinner-grow text-muted"></div>
        <div class="spinner-grow text-primary"></div>
        <div class="spinner-grow text-success"></div>
        <div class="spinner-grow text-info"></div>
        <div class="spinner-grow text-warning"></div>
        <div class="spinner-grow text-danger"></div>
        <div class="spinner-grow text-secondary"></div>
        <div class="spinner-grow text-dark"></div>
        <div class="spinner-grow text-light"></div>
    </div>

    
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
                        <th>Error List</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
            </table>
        </div>

    
</div>
<div class="modal right fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img class="card-img-left" src="{{asset('images/113310.svg')}}" alt="" height="30" width="60">
                <h5 class="modal-title" id="exampleModalLabel">Error History of Machine <b><span id="machine_name"></span> </b> </h5>
                <!-- <h5 class="modal-title" id="exampleModalLabel">Error History of Machine <b><span id="machine_name"></span> </b> </h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="history-details">
                   <!--  <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-4">
                                    <strong>Location: </strong>
                                </div>
                                <div class="col-sm-8">
                                    <span id="location_name"></span>
                                </div>
                                <div class="col-sm-4">
                                    <strong>Line: </strong>
                                </div>
                                <div class="col-sm-8">
                                    <span id="line_name"></span>
                                </div>
                                <div class="col-sm-4">
                                    <strong>Model: </strong>
                                </div>
                                <div class="col-sm-8">
                                    <span id="model_no"></span>
                                </div>

                            </div>

                        </div>
                        <div class="col-sm-8">
                            <table class="table table-bordered">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th>Error Date</th>
                                        <th>Error Name</th>
                                    </tr>
                                </thead>
                                <tbody id="errors_list">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- NPT modal --}}

<div class="modal right fade" id="nptModal" tabindex="-1" role="dialog" aria-labelledby="nptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img class="card-img-left" src="{{asset('public/images/113310.svg')}}" alt="" height="30" width="60">
                <h5 class="modal-title" id="nptModalLabel">NPT details of Machine <b><span id="npt_machine_name"></span> </b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="npt-details">
                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <th>Machine Problem</th>
                                <th>Needle Broken</th>
                                <th>Thread Broken</th>
                                <th>Refreshment</th>
                                <th>Others</th>
                            </thead>
                            <tbody id="npt_row">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

<script type="text/javascript">
    $(document).ajaxStart(function() {
      $("#loader").show();
    }).ajaxStop(function() {
      $("#loader").hide();
    });


    $('#search_button').click(function() {
        var date= $("#record_date").val();
        if(date){
            $.ajax({
                type: "GET",
                url: "get_record",
                data: {date: date},
                success: function(data) {

                    var code="";

                    
                    for (let index = 0; index < data.length; index++) {
                        var machine_name="";
                        var line_name="";
                        var operator_name= "";
                        var target_value= 0;
                        var achieved_value= 0;
                        var buyer_name = "";
                        var npts= 0;
                        if(data[index].machine_name){
                             machine_name= data[index].machine_name;
                        }
                        if(data[index].line_name){
                             line_name= data[index].line_name;
                        }
                        if(data[index].operator_name){
                             operator_name= data[index].operator_name;
                        }
                        if(data[index].target_value){
                             target_value= data[index].target_value;
                        }
                        if(data[index].achieved_value){
                             achieved_value= data[index].achieved_value;
                        }
                        if(data[index].buyer_name){
                             buyer_name= data[index].buyer_name;
                        }
                        if(data[index].npts){
                             npts= data[index].npts;
                        }



                        code=  code+ "<tr>\
                            <td>"+(index+1)+"</td>\
                            <td>"+ machine_name +"</td>\
                            <td>"+ line_name +"</td>\
                            <td>"+operator_name +"</td>\
                            <td>"+target_value+"</td>\
                            <td>"+achieved_value+"</td>\
                            <td>"+buyer_name+"</td>\
                            <td><a class='npt_details'  npt-machine-id='"+ data[index].id +"' npt-machine-name='"+ machine_name +"'>"+npts+"</a></td>\
                            <td><button class='btn btn-secondary btn-sm error-history' type='button' machine-id='"+ data[index].id +"' machine-name='"+ machine_name +"'>Error History</button></td>\
                        </tr>";
                    }

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

    //on click error history
    $('body').on('click', '.error-history', function(){
        var date= $("#record_date").val();
        var machine_id= $(this).attr('machine-id');
        var machine_name= $(this).attr('machine-name');

        $.ajax({
            method: 'get',
            data: {machine_id: machine_id, date: date},
            dataType: 'json',
            url: "get_error_history",
            success: function(data){
                $("#machine_name").text(machine_name);
                var l= 0; 
                var str= '<tr> <td colspan="2">No error found!</td> </tr>';
                if(data.error_time != null){
                    l= data.error_time.length;
                    str="";
                }              
                for ( var i = 0; i <l; i++ ) {
                    if(data.error_no[i]>1 && data.error_no[i]<=8){
                        str+= '<tr><td>'+data.error_time[i]+'</td><td>'+data.error_name[i]+'</td></tr>';
                    }
                }
                $("#errors_list").html(str);
                $("#location_name").text(data.location_name);
                $("#line_name").text(data.line_name);
                $("#model_no").text(data.model_no);
                $("#exampleModal").modal('show');
            },
            error: function(xhr) { 
                console.log("failed");
            }  
        });
    });

    //on click npt details
    $('body').on('click', '.npt_details', function(){
        var date= $("#record_date").val();
        var machine_id= $(this).attr('npt-machine-id');
        var machine_name= $(this).attr('npt-machine-name');

        $.ajax({
            method: 'get',
            data: {machine_id: machine_id, date: date},
            dataType: 'json',
            url: "get_npt_details",
            success: function(data){
                
                var code="";
                var machine_problem=0;
                var needle_broken=0;
                var thread_broken=0;
                var refreshment=0;
                var others=0;
                if(data.machine_problem) machine_problem= data.machine_problem;
                if(data.needle_broken) needle_broken= data.needle_broken;
                if(data.thread_broken) thread_broken= data.thread_broken;
                if(data.refreshment) refreshment= data.refreshment;
                if(data.others) others= data.others;

                code+="<tr><td>"+machine_problem+"</td><td>"+needle_broken+"</td><td>"+thread_broken+"</td><td>"+refreshment+"</td><td>"+others+"</td></tr>";
                $("#npt_machine_name").text(machine_name);
                $("#npt_row").html(code);
                $("#nptModal").modal('show');
            },
            error: function(xhr) { 
                console.log("failed");
            }  
        });
    });

    $('#pdf_button').click(function(e) {
        var date= $("#record_date").val();
        if(!date){
            alert("Please Select a date!");
            e.preventDefault();
        }
    });
</script>


@endsection