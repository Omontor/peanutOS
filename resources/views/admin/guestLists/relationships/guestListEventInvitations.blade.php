<div class="m-3">
    @can('event_invitation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.event-invitations.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.eventInvitation.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.eventInvitation.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-guestListEventInvitations">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.eventInvitation.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.eventInvitation.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.eventInvitation.fields.image') }}
                            </th>
                            <th>
                                {{ trans('cruds.eventInvitation.fields.guest_list') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventInvitations as $key => $eventInvitation)
                            <tr data-entry-id="{{ $eventInvitation->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $eventInvitation->id ?? '' }}
                                </td>
                                <td>
                                    {{ $eventInvitation->title ?? '' }}
                                </td>
                                <td>
                                    @if($eventInvitation->image)
                                        <a href="{{ $eventInvitation->image->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $eventInvitation->image->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $eventInvitation->guest_list->title ?? '' }}
                                </td>
                                <td>
                                    @can('event_invitation_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.event-invitations.show', $eventInvitation->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('event_invitation_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.event-invitations.edit', $eventInvitation->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('event_invitation_delete')
                                        <form action="{{ route('admin.event-invitations.destroy', $eventInvitation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('event_invitation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.event-invitations.massDestroy') }}",
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
  let table = $('.datatable-guestListEventInvitations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection