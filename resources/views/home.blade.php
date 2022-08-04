@extends('layouts.admin')
@section('content')

<div class="content">
	<div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary text-center">
                <div class="inner">
                    <p>Number Of Machine</p>
                    <h3 id="machine_num"></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('admin.setup.machine') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success text-center">
                <div class="inner">

                    <p>Number of Line</p>

                    <h3 id="line_num"></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('admin.setup.line') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning text-center">
                <div class="inner">
                    <p>Number of Worker</p>
                    <h3 id="worker_num"></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger text-center">
                <div class="inner">
                    <p>Todays ({{ date('d-M-Y') }}) Target</p>
                    <h3 id="target_num"></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('daily.total.target') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        {{-- Chart3 High Chart --}}
        <div class="col-sm-12">
            <figure class="highcharts-figure">
                <div id="container"></div>
                <p class="highcharts-description">
                  {{-- Description Here --}}
                </p>
            </figure>
        </div>
        {{-- High chart end --}}
	</div>

    <div class="row mt-3">
        
        <div class="col-sm-12">
            <div class="d-flex flex-row-reverse">
                <div class="col-sm-4">
                    <select class="form-control"  name="line_for_operation_status" id="line_for_operation_status">
                        @foreach($lineList AS $line)
                        <option value="{{ $line->id }}">{{ $line->line_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <figure class="highcharts-figure">
                <div id="container_combo"></div>
                <p class="highcharts-description">
                  {{-- Description Here --}}
                </p>
            </figure>
        </div>
    </div>
</div>
<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <figure class="highcharts-figure">
                    <div id="container_line"></div>
                    <p class="highcharts-description">
                      {{-- Description Here --}}
                    </p>
                </figure>
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
    function lineMachineOperatorTarget(){
        $.ajax({
            method: 'get',
            dataType: 'json',
            url: 'line/machine/operator/target',
            success: function(data){
                $("#line_num").text(data.line);
                $("#machine_num").text(data.machine);
                $("#worker_num").text(data.operator);
                $("#target_num").text(data.target);
            },
            error: function(xhr){
                console.log("error");
            }
        });
    }

    $(document).ready(function(){
        lineMachineOperatorTarget();
    });
    setInterval(function(){
        lineMachineOperatorTarget() // this will run after every 5 seconds
    }, 600000);



</script>

<script>

    //Bar Chart Por performance 
    $(function () {
        var labels= <?php echo "[ '". implode("' , '", $data['id'])  ."' ]";  ?>;
        // high Chart
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Production Performance'
            },
            subtitle: {
                // text: 'ISMNS'
            },
            xAxis: {
                categories: <?php echo "[ '". implode("' , '", $data['lines'])  ."' ]";  ?>,
                crosshair: true,
                
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Target (Pieces)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} Pieces</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                },
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                var x= event.point.x;
                                var line_id= labels[x];

                                $.ajax({
                                    method: 'get',
                                    data: {line_id},
                                    dataType: 'json',
                                    url: 'lines/machine/target',
                                    success: function(data){
                                      generateChart(data.machines, data.targets, data.achievements);
                                      $("#exampleModal").modal('show');
                                    },
                                    error: function(xhr) { 
                                        console.log("failed");
                                    }  
                                });
                            }
                        }
                    }
                }
            },
            series: [
                {
                    name: 'Targets',
                    data: <?php echo "[ ". implode(", ", $data['targets'])  ." ]";  ?>
                },
                {
                    name: 'Achievements',
                    data: <?php echo "[ ". implode(", ", $data['achievements'])  ." ]";  ?>
                }

            ]
        });
    })


    // line wise performance, this will show on click on the bar
    var cat = [];
    var target=[];
    var achievements=[];
    function generateChart(cat,target,achievements) {
    
        var barChart= $(function () {
                Highcharts.chart('container_line', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Production Performance'
                    },
                    subtitle: {
                        // text: 'ISMNS'
                    },
                    xAxis: {
                        categories: cat,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Target (Pieces)'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f} Pieces</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                        }
                    },
                    series: [
                        {
                            name: 'Targets',
                            data: target

                        },
                        {
                            name: 'Achievements',
                            data: achievements
                        }
                    ]
            });
        });
    }

    // generate Status Chart
    var machine_model         =[];
    var average_power_on_time =[];
    var usage_rate            =[];
    var operating_rate        =[];
    function generateOperatingStatusChart(machine_model, average_power_on_time, usage_rate, operating_rate){
        $(function (){
            Highcharts.chart('container_combo', {
                chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Machine Operating Status',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ismns.transparencyint.com',
                    text: '',
                    align: 'center'
                },
                xAxis: [{
                    categories: machine_model,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: '{value}m',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    title: {
                        text: 'Average Power-on Time Per-piece',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    opposite: true

                }, { // Secondary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Usage Rate',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    labels: {
                        format: '{value}%',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }

                }, { // Tertiary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Operating Rate',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    labels: {
                        format: '{value}%',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    opposite: true
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    // layout: 'vertical',
                    // align: 'left',
                    // x: 80,
                    // verticalAlign: 'top',
                    // y: 55,
                    // floating: true,
                    // backgroundColor:
                    //     Highcharts.defaultOptions.legend.backgroundColor || // theme
                    //     'rgba(255,255,255,0.25)'
                },
                series: [{
                    name: 'Average Power-on Time Per-piece',
                    type: 'column',
                    data: average_power_on_time,
                    tooltip: {
                        valueSuffix: ''
                    }

                }, {
                    name: 'Usage Rate',
                    type: 'spline',
                    yAxis: 1,
                    data: usage_rate,
                    tooltip: {
                        valueSuffix: ''
                    }

                }, {
                    name: 'Operating Rate',
                    type: 'spline',
                    yAxis: 2,
                    data: operating_rate,
                    tooltip: {
                        valueSuffix: ''
                    }
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                floating: false,
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom',
                                x: 0,
                                y: 0
                            },
                            yAxis: [{
                                labels: {
                                    align: 'right',
                                    x: 0,
                                    y: -6
                                },
                                showLastLabel: false
                            }, {
                                labels: {
                                    align: 'left',
                                    x: 0,
                                    y: -6
                                },
                                showLastLabel: false
                            }, {
                                visible: false
                            }]
                        }
                    }]
                }
            });
        });
    }

    var mm=null;
    var apt=null;
    var ur=null;
    var or=null;
    generateOperatingStatusChart(mm,apt,ur,or);

    //first time call with line id 1 and then specific line
    var url= "{{ url('line/machine/operatingStatus') }}";
    $(document).ready(function(barChart){
        var line_id= 1;
        ajaxCall(line_id);
    });

    //on line change
    $('#line_for_operation_status').on('change', function(barChart){
        var line_id= $(this).val();
        var that= $(this);
        ajaxCall(line_id);
    });

    // setInterval(function(){
    //     var line_id= $('#line_for_operation_status').find(":selected").val();
    //     ajaxCall(line_id);
    // }, 600000);

    //ajax call for repeating call
    function ajaxCall(line_id){
        $.ajax({
            method: 'get',
            data: {line_id:line_id},
            dataType: 'json',
            url: url,
            success: function(data){
              generateOperatingStatusChart(data.machine_model, data.average_power_on_time, data.usage_rate, data.operating_rate);
            },
            error: function(xhr) { 
                console.log("Status Chart failed");
            }  
        });
    }   
</script>


@endsection