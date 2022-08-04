@extends('layouts.admin')
@section('content')
@include('inc/message')
@can('setup')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.setup.target.create') }}">
                Add Target
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        Target Management
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Machine Name
                        </th>
                        <th>
                            Operator Name
                        </th>
                        <th>
                            Item Name
                        </th>
                        <th>
                            Process Name
                        </th>
                        <th>
                            Target From
                        </th>
                        <th>
                            Targert To
                        </th>
                        <th>
                            Target
                        </th>
                        <th width="70px">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($targets))
                        @foreach($targets as $key => $target)
                            <tr data-entry-id="{{ $target->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $target->machine_name ?? '' }}
                                </td>
                                <td>
                                    {{ $target->operator_name ?? '' }}
                                </td>
                                <td>
                                    {{ $target->item_name ?? '' }}
                                </td>
                                <td>
                                    {{ $target->process_name ?? '' }}
                                </td>
                                <td>
                                    {{ $target->target_date ?? '' }}
                                </td>
                                <td>
                                    {{ $target->target_date_end ?? '' }}
                                </td>
                                <td>
                                    {{ $target->target_value ?? '' }}
                                </td>
                                
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.setup.target.view', $target->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.setup.target.edit', $target->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-xs btn-danger" href="{{ route('admin.setup.target.delete', $target->id) }}"  onclick="return confirm('Are you sure?')">
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