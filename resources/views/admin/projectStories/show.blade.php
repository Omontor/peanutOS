@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.projectStory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.project-stories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.id') }}
                        </th>
                        <td>
                            {{ $projectStory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.project') }}
                        </th>
                        <td>
                            {{ $projectStory->project->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.description') }}
                        </th>
                        <td>
                            {!! $projectStory->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.solution') }}
                        </th>
                        <td>
                            {!! $projectStory->solution !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.results') }}
                        </th>
                        <td>
                            {!! $projectStory->results !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.gallery') }}
                        </th>
                        <td>
                            @foreach($projectStory->gallery as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.thumb_image') }}
                        </th>
                        <td>
                            @if($projectStory->thumb_image)
                                <a href="{{ $projectStory->thumb_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $projectStory->thumb_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.bg_image') }}
                        </th>
                        <td>
                            @if($projectStory->bg_image)
                                <a href="{{ $projectStory->bg_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $projectStory->bg_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.projectStory.fields.youtube_url') }}
                        </th>
                        <td>
                            {{ $projectStory->youtube_url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.project-stories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection