@extends('layouts.admin')
@section('content')
@can('setup')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.setup.location.create') }}">
                Add Location
            </a>
        </div>
    </div>
@endcan
@include('inc/message')
<div class="card">
    <div class="card-header">
        Location Management
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
                            Operating Time
                        </th>
                        <th>
                            Rest Time
                        </th>
                        <th>
                            Description
                        </th>
                        <th width="70px">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($locations))
                        @foreach($locations as $key => $location)
                            <tr data-entry-id="{{ $location->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $location->location_name ?? '' }}
                                </td>
                                <td>
                                    {{ $location->operating_time_start ?? '' }}
                                </td>
                                <td>
                                    {{ $location->rest_1_end ?? '' }}
                                </td>
                                <td>
                                    {{ $location->location_description ?? '' }}
                                </td>
                                
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.setup.location.view',$location->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.setup.location.edit',$location->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-xs btn-danger" href="{{ route('admin.setup.location.delete',$location->id) }}" onclick="return confirm('Are you sure?')">
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