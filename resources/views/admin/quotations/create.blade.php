@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.quotation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.quotations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.quotation.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quotation.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.quotation.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quotation.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="assets">{{ trans('cruds.quotation.fields.assets') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('assets') ? 'is-invalid' : '' }}" name="assets[]" id="assets" multiple required>
                    @foreach($assets as $id => $assets)
                        <option value="{{ $id }}" {{ in_array($id, old('assets', [])) ? 'selected' : '' }}>{{ $assets }}</option>
                    @endforeach
                </select>
                @if($errors->has('assets'))
                    <span class="text-danger">{{ $errors->first('assets') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quotation.fields.assets_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total">{{ trans('cruds.quotation.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" name="total" id="total" value="{{ old('total', '') }}" step="0.01" required>
                @if($errors->has('total'))
                    <span class="text-danger">{{ $errors->first('total') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quotation.fields.total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="clauses">{{ trans('cruds.quotation.fields.clauses') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('clauses') ? 'is-invalid' : '' }}" name="clauses[]" id="clauses" multiple>
                    @foreach($clauses as $id => $clauses)
                        <option value="{{ $id }}" {{ in_array($id, old('clauses', [])) ? 'selected' : '' }}>{{ $clauses }}</option>
                    @endforeach
                </select>
                @if($errors->has('clauses'))
                    <span class="text-danger">{{ $errors->first('clauses') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quotation.fields.clauses_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from">{{ trans('cruds.quotation.fields.from') }}</label>
                <input class="form-control date {{ $errors->has('from') ? 'is-invalid' : '' }}" type="text" name="from" id="from" value="{{ old('from') }}">
                @if($errors->has('from'))
                    <span class="text-danger">{{ $errors->first('from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quotation.fields.from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="to">{{ trans('cruds.quotation.fields.to') }}</label>
                <input class="form-control date {{ $errors->has('to') ? 'is-invalid' : '' }}" type="text" name="to" id="to" value="{{ old('to') }}">
                @if($errors->has('to'))
                    <span class="text-danger">{{ $errors->first('to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quotation.fields.to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="validity">{{ trans('cruds.quotation.fields.validity') }}</label>
                <input class="form-control {{ $errors->has('validity') ? 'is-invalid' : '' }}" type="number" name="validity" id="validity" value="{{ old('validity', '30') }}" step="1">
                @if($errors->has('validity'))
                    <span class="text-danger">{{ $errors->first('validity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quotation.fields.validity_helper') }}</span>
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