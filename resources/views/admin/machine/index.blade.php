@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.machine.title_singular') }} {{ trans('global.list') }}
        <a href="{{ route('admin.machine.download.pdf') }}" class="btn btn-success float-right" target="_blank"><i class="fas fa-file-pdf"></i> Download</a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <td></td>
                        <td>#</td>
                        <td>Error History</td>
                        <td>Machine Name</td>
                        <td>Model</td>
                        <td>Usage Rate</td>
                        <td>Operating Rate</td>
                        <td>Average Cycle Time</td>
                        <td>Reference Cycle Time</td>
                        <td>Acheivement Rate</td>
                        <td>Total Target Pieces</td>
                        <td>Current Target Pieces</td>
                        <td>Sewing Pieces</td>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0; @endphp
                    @foreach($machines as $key => $machine)
                    @php $i++; @endphp
                        <tr data-entry-id="{{ $machine->id }}">
                            <td>
                            </td>
                            <td>
                                {{ $i }}
                            </td>
                            <td>
                                <button class="btn btn-secondary btn-sm error-history" type="button" machine-id="{{$machine->id}}" machine-name="{{ $machine->machine_name ?? '' }}">History</button>
                            </td>
                            <td>
                                {{ $machine->machine_name ?? '' }}
                            </td>
                            <td>
                                {{ $machine->model_no ?? '' }}
                            </td>
                            <td>
                                {{ $machine->usage_rate ?? '0' }}%
                            </td>
                            <td>
                                {{ $machine->operating_rate ?? '0' }}%
                            </td>
                            <td>
                                {{ $machine->average_power_on_time ?? '0' }}
                            </td>
                            <td>
                                {{ ($machine->actual_time && $machine->sweing_pcs) ? ( (int)($machine->actual_time/$machine->sweing_pcs)): '0' }}
                            </td>
                            <td>
                                {{  $machine->achievement_ratio ?? '0' }}%
                            </td>
                            <td>
                                {{ $machine->target ?? '0' }}
                            </td>
                            <td>
                                {{ $machine->target ?? '0' }}
                            </td>
                            <td>
                                {{ $machine->sweing_pcs ?? '0' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal right fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img class="card-img-left" src="{{asset('public/images/113310.svg')}}" alt="" height="30" width="60">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('product_delete')
      // dtButtons.push(deleteButton)
    @endcan

    //on click error history
    $('body').on('click', '.error-history', function(){

        var machine_id= $(this).attr('machine-id');
        var machine_name= $(this).attr('machine-name');

        $.ajax({
            method: 'get',
            data: {machine_id},
            dataType: 'json',
            url: 'machine/get_error_history',
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

    $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection