@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.eventDay.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.event-days.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="date">{{ trans('cruds.eventDay.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date') }}">
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventDay.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="event_id">{{ trans('cruds.eventDay.fields.event') }}</label>
                            <select class="form-control select2" name="event_id" id="event_id" required>
                                @foreach($events as $id => $entry)
                                    <option value="{{ $id }}" {{ old('event_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('event'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventDay.fields.event_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="venue_id">{{ trans('cruds.eventDay.fields.venue') }}</label>
                            <select class="form-control select2" name="venue_id" id="venue_id">
                                @foreach($venues as $id => $entry)
                                    <option value="{{ $id }}" {{ old('venue_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('venue'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('venue') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventDay.fields.venue_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title">{{ trans('cruds.eventDay.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection