@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.quotation.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.quotations.update", [$quotation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="title">{{ trans('cruds.quotation.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $quotation->title) }}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.quotation.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="client_id">{{ trans('cruds.quotation.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id" required>
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $quotation->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.quotation.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="assets">{{ trans('cruds.quotation.fields.assets') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="assets[]" id="assets" multiple required>
                                @foreach($assets as $id => $asset)
                                    <option value="{{ $id }}" {{ (in_array($id, old('assets', [])) || $quotation->assets->contains($id)) ? 'selected' : '' }}>{{ $asset }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assets'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assets') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.quotation.fields.assets_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="total">{{ trans('cruds.quotation.fields.total') }}</label>
                            <input class="form-control" type="number" name="total" id="total" value="{{ old('total', $quotation->total) }}" step="0.01" required>
                            @if($errors->has('total'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.quotation.fields.total_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="clauses">{{ trans('cruds.quotation.fields.clauses') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="clauses[]" id="clauses" multiple>
                                @foreach($clauses as $id => $clause)
                                    <option value="{{ $id }}" {{ (in_array($id, old('clauses', [])) || $quotation->clauses->contains($id)) ? 'selected' : '' }}>{{ $clause }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('clauses'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clauses') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.quotation.fields.clauses_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="from">{{ trans('cruds.quotation.fields.from') }}</label>
                            <input class="form-control date" type="text" name="from" id="from" value="{{ old('from', $quotation->from) }}">
                            @if($errors->has('from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.quotation.fields.from_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="to">{{ trans('cruds.quotation.fields.to') }}</label>
                            <input class="form-control date" type="text" name="to" id="to" value="{{ old('to', $quotation->to) }}">
                            @if($errors->has('to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.quotation.fields.to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="validity">{{ trans('cruds.quotation.fields.validity') }}</label>
                            <input class="form-control" type="number" name="validity" id="validity" value="{{ old('validity', $quotation->validity) }}" step="1">
                            @if($errors->has('validity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('validity') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection