<div class="m-3">
    @can('epic_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.epics.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.epic.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.epic.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-reporterEpics">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.epic.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.epic.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.epic.fields.asignees') }}
                            </th>
                            <th>
                                {{ trans('cruds.epic.fields.start_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.epic.fields.end_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.epic.fields.reporter') }}
                            </th>
                            <th>
                                {{ trans('cruds.epic.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($epics as $key => $epic)
                            <tr data-entry-id="{{ $epic->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $epic->id ?? '' }}
                                </td>
                                <td>
                                    {{ $epic->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($epic->asignees as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $epic->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $epic->end_date ?? '' }}
                                </td>
                                <td>
                                    {{ $epic->reporter->name ?? '' }}
                                </td>
                                <td>
                                    {{ $epic->status->name ?? '' }}
                                </td>
                                <td>
                                    @can('epic_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.epics.show', $epic->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('epic_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.epics.edit', $epic->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('epic_delete')
                                        <form action="{{ route('admin.epics.destroy', $epic->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('epic_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.epics.massDestroy') }}",
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
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-reporterEpics:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection