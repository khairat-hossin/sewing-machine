@extends('layouts.admin')
@section('content')
@include('inc/message')
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('daily.total.target.create') }}">
                Add Target
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        Day Wise Whole Company's Total Target
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <td></td>
                        <td>Date</td>
                        <td>Target Value</td>
                        <td>Achievement Value</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyTotalTargetList as $daily)
                    
                        <tr data-entry-id="">
                            <td>
                            </td>
                            <td>
                                {{ $daily->target_date }}
                            </td>
                            <td>
                                {{ $daily->target_value }}
                            </td>
                            <td>
                                {{ $daily->achievement_value }}
                            </td>
                            <td>
                                #
                            </td>
                        </tr>
                    @endforeach
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