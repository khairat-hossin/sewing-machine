@extends('layouts.admin')
@section('content')
@include('inc/message')
@can('setup')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.setup.machine.create') }}">
                Add Machine
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        Machine Management
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Location Name
                        </th>
                        <th>
                            Line Name
                        </th>
                        <th>
                            Machine Name
                        </th>
                        <th>
                            Model
                        </th>
                        <th>
                            Serial Number
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Device Name
                        </th>
                        
                        <th width="70px">
                            Action/Device Assign
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($machines))
                        @foreach($machines as $key => $machine)
                            <tr data-entry-id="{{ $machine->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $machine->location_name ?? '' }}
                                </td>
                                <td>
                                    {{ $machine->line_name ?? '' }}
                                </td>
                                <td>
                                    {{ $machine->machine_name ?? '' }}
                                </td>
                                <td>
                                    {{ $machine->model_no ?? '' }}
                                </td>
                                <td>
                                    {{ $machine->serial_no ?? '' }}
                                </td>
                                <td>
                                    {{ $machine->machine_description ?? '' }}
                                </td>
                                <td>
                                    {{ $machine->device_name ?? 'N/A' }}
                                </td>
                                
                                <td>
                                    @if($machine->device_name == null)
                                    <a class="btn btn-xs btn-primary" href="{{ url('admin/setup/machine/assign_device/'.$machine->id) }}" title="Assign Device">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    @endif
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.setup.machine.view',$machine->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.setup.machine.edit',$machine->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-xs btn-danger" href="{{ route('admin.setup.machine.delete',$machine->id) }}" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
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

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection