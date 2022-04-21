<div class="m-3">
    @can('rent_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.rents.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.rent.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.rent.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-quotationRents">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.asset') }}
                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.quotation') }}
                            </th>
                            <th>
                                {{ trans('cruds.quotation.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.identification') }}
                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.address_proof') }}
                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.from') }}
                            </th>
                            <th>
                                {{ trans('cruds.rent.fields.to') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rents as $key => $rent)
                            <tr data-entry-id="{{ $rent->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $rent->id ?? '' }}
                                </td>
                                <td>
                                    {{ $rent->title ?? '' }}
                                </td>
                                <td>
                                    {{ $rent->client->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($rent->assets as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $rent->quotation->title ?? '' }}
                                </td>
                                <td>
                                    {{ $rent->quotation->title ?? '' }}
                                </td>
                                <td>
                                    @if($rent->identification)
                                        <a href="{{ $rent->identification->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $rent->identification->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($rent->address_proof)
                                        <a href="{{ $rent->address_proof->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $rent->address_proof->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $rent->from ?? '' }}
                                </td>
                                <td>
                                    {{ $rent->to ?? '' }}
                                </td>
                                <td>
                                    @can('rent_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.rents.show', $rent->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('rent_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.rents.edit', $rent->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('rent_delete')
                                        <form action="{{ route('admin.rents.destroy', $rent->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('rent_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rents.massDestroy') }}",
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
  let table = $('.datatable-quotationRents:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection