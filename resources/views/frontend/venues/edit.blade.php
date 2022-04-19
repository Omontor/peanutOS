@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.venue.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.venues.update", [$venue->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.venue.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $venue->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.venue.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="lat">{{ trans('cruds.venue.fields.lat') }}</label>
                            <input class="form-control" type="text" name="lat" id="lat" value="{{ old('lat', $venue->lat) }}" required>
                            @if($errors->has('lat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.venue.fields.lat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="lng">{{ trans('cruds.venue.fields.lng') }}</label>
                            <input class="form-control" type="text" name="lng" id="lng" value="{{ old('lng', $venue->lng) }}" required>
                            @if($errors->has('lng'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lng') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.venue.fields.lng_helper') }}</span>
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