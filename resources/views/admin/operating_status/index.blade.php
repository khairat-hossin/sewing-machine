@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header text-center">
        <h3>Machine Operating Status</h3>
    </div>

    <div class="card-body">
        <div class="row">

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
</div>
@endsection
@section('scripts')
@parent
<script type="text/javascript">
    //first time call with line id 1 and then specific line
    var url= "{{ url('line/machine/operatingStatus') }}";
    $(document).ready(function(barChart){
        var line_id= 1;
        ajaxCall(line_id);
    });

    $('#line_for_operation_status').on('change', function(barChart){
        var line_id= $(this).val();
        var that= $(this);
        ajaxCall(line_id);
    });

    setInterval(function(){
        var line_id= $('#line_for_operation_status').find(":selected").val();
        ajaxCall(line_id);
    }, 30000);

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
    // line wise chart end

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
                    text: 'Source: ismns.transparencyint.com',
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
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    title: {
                        text: 'Average Power-on Time Per-piece',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    opposite: true

                }, { // Secondary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Usage Rate',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: '{value}%',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }

                }, { // Tertiary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Operating Rate',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    labels: {
                        format: '{value}%',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    opposite: true
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    x: 80,
                    verticalAlign: 'top',
                    y: 55,
                    floating: true,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || // theme
                        'rgba(255,255,255,0.25)'
                },
                series: [{
                    name: 'Average Power-on Time Per-piece',
                    type: 'column',
                    yAxis: 1,
                    data: average_power_on_time,
                    tooltip: {
                        valueSuffix: ''
                    }

                }, {
                    name: 'Usage Rate',
                    type: 'spline',
                    yAxis: 2,
                    data: usage_rate,
                    // marker: {
                    //     enabled: false
                    // },
                    // dashStyle: 'shortdot',
                    tooltip: {
                        valueSuffix: ''
                    }

                }, {
                    name: 'Operating Rate',
                    type: 'spline',
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
</script>
@endsection