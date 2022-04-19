@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.appointments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="title">{{ trans('cruds.appointment.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="project_id">{{ trans('cruds.appointment.fields.project') }}</label>
                            <select class="form-control select2" name="project_id" id="project_id" required>
                                @foreach($projects as $id => $entry)
                                    <option value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('project') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.project_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="invitees">{{ trans('cruds.appointment.fields.invitees') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="invitees[]" id="invitees" multiple required>
                                @foreach($invitees as $id => $invitee)
                                    <option value="{{ $id }}" {{ in_array($id, old('invitees', [])) ? 'selected' : '' }}>{{ $invitee }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('invitees'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invitees') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.invitees_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="from">{{ trans('cruds.appointment.fields.from') }}</label>
                            <input class="form-control datetime" type="text" name="from" id="from" value="{{ old('from') }}" required>
                            @if($errors->has('from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.from_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="to">{{ trans('cruds.appointment.fields.to') }}</label>
                            <input class="form-control datetime" type="text" name="to" id="to" value="{{ old('to') }}" required>
                            @if($errors->has('to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.appointment.fields.platform') }}</label>
                            <select class="form-control" name="platform" id="platform" required>
                                <option value disabled {{ old('platform', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Appointment::PLATFORM_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('platform', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('platform'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('platform') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.platform_helper') }}</span>
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