@extends('layouts.admin')
@section('content')
@include('inc/message')
@can('setup')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.setup.item.create') }}">
                Add Item
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        Item Management
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable text-center">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Item Code
                        </th>
                        <th>
                            Item Name
                        </th>
                        <th width="70px">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($items))
                        @foreach($items as $key => $item)
                            <tr data-entry-id="{{ $item->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $item->item_code ?? '' }}
                                </td>
                                <td>
                                    {{ $item->item_name ?? '' }}
                                </td>
                                
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.setup.item.view',$item->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.setup.item.edit',$item->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-xs btn-danger" href="{{ route('admin.setup.item.delete',$item->id) }}" onclick="return confirm('Are you sure?')">
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