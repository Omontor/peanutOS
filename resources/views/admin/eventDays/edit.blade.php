@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.eventDay.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.event-days.update", [$eventDay->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.eventDay.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $eventDay->date) }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDay.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_id">{{ trans('cruds.eventDay.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id" required>
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $eventDay->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <span class="text-danger">{{ $errors->first('event') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDay.fields.event_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="venue_id">{{ trans('cruds.eventDay.fields.venue') }}</label>
                <select class="form-control select2 {{ $errors->has('venue') ? 'is-invalid' : '' }}" name="venue_id" id="venue_id">
                    @foreach($venues as $id => $entry)
                        <option value="{{ $id }}" {{ (old('venue_id') ? old('venue_id') : $eventDay->venue->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('venue'))
                    <span class="text-danger">{{ $errors->first('venue') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDay.fields.venue_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.eventDay.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $eventDay->title) }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDay.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection