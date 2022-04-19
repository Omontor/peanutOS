@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.events.update", [$event->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start">{{ trans('cruds.event.fields.start') }}</label>
                            <input class="form-control date" type="text" name="start" id="start" value="{{ old('start', $event->start) }}">
                            @if($errors->has('start'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.start_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end">{{ trans('cruds.event.fields.end') }}</label>
                            <input class="form-control date" type="text" name="end" id="end" value="{{ old('end', $event->end) }}">
                            @if($errors->has('end'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.end_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="project_id">{{ trans('cruds.event.fields.project') }}</label>
                            <select class="form-control select2" name="project_id" id="project_id" required>
                                @foreach($projects as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('project_id') ? old('project_id') : $event->project->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('project') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.project_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection