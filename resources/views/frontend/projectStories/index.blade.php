@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('project_story_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.project-stories.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.projectStory.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.projectStory.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ProjectStory">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.projectStory.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.projectStory.fields.project') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.projectStory.fields.gallery') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.projectStory.fields.thumb_image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.projectStory.fields.bg_image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.projectStory.fields.youtube_url') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projectStories as $key => $projectStory)
                                    <tr data-entry-id="{{ $projectStory->id }}">
                                        <td>
                                            {{ $projectStory->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $projectStory->project->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($projectStory->gallery as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $media->getUrl('thumb') }}">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($projectStory->thumb_image)
                                                <a href="{{ $projectStory->thumb_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $projectStory->thumb_image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($projectStory->bg_image)
                                                <a href="{{ $projectStory->bg_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $projectStory->bg_image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $projectStory->youtube_url ?? '' }}
                                        </td>
                                        <td>
                                            @can('project_story_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.project-stories.show', $projectStory->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('project_story_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.project-stories.edit', $projectStory->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('project_story_delete')
                                                <form action="{{ route('frontend.project-stories.destroy', $projectStory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('project_story_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.project-stories.massDestroy') }}",
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
  let table = $('.datatable-ProjectStory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection