<div class="m-3">
    @can('task_action_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.task-actions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.taskAction.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.taskAction.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-taskTaskActions">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.taskAction.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskAction.fields.task') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskAction.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskAction.fields.asignee') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskAction.fields.images') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskAction.fields.title') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taskActions as $key => $taskAction)
                            <tr data-entry-id="{{ $taskAction->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $taskAction->id ?? '' }}
                                </td>
                                <td>
                                    {{ $taskAction->task->name ?? '' }}
                                </td>
                                <td>
                                    {{ $taskAction->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $taskAction->asignee->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($taskAction->images as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $taskAction->title ?? '' }}
                                </td>
                                <td>
                                    @can('task_action_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.task-actions.show', $taskAction->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('task_action_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.task-actions.edit', $taskAction->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('task_action_delete')
                                        <form action="{{ route('admin.task-actions.destroy', $taskAction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('task_action_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.task-actions.massDestroy') }}",
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
  let table = $('.datatable-taskTaskActions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection