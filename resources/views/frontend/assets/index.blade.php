@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('asset_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.assets.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.asset.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.asset.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.serial_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.front_photo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.side_photo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.quarter_photo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.invoice') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.cost') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.day_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.week_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $key => $asset)
                                    <tr data-entry-id="{{ $asset->id }}">
                                        <td>
                                            {{ $asset->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->serial_number ?? '' }}
                                        </td>
                                        <td>
                                            @if($asset->front_photo)
                                                <a href="{{ $asset->front_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $asset->front_photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($asset->side_photo)
                                                <a href="{{ $asset->side_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $asset->side_photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($asset->quarter_photo)
                                                <a href="{{ $asset->quarter_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $asset->quarter_photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($asset->invoice)
                                                <a href="{{ $asset->invoice->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $asset->cost ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->day_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->week_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->status ?? '' }}
                                        </td>
                                        <td>
                                            @can('asset_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.assets.show', $asset->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('asset_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.assets.edit', $asset->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('asset_delete')
                                                <form action="{{ route('frontend.assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('asset_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.assets.massDestroy') }}",
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
  let table = $('.datatable-Asset:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection