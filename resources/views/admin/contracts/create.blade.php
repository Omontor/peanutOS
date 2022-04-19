@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contract.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contracts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="contract_date">{{ trans('cruds.contract.fields.contract_date') }}</label>
                <input class="form-control date {{ $errors->has('contract_date') ? 'is-invalid' : '' }}" type="text" name="contract_date" id="contract_date" value="{{ old('contract_date') }}" required>
                @if($errors->has('contract_date'))
                    <span class="text-danger">{{ $errors->first('contract_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.contract_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contract_deadline">{{ trans('cruds.contract.fields.contract_deadline') }}</label>
                <input class="form-control date {{ $errors->has('contract_deadline') ? 'is-invalid' : '' }}" type="text" name="contract_deadline" id="contract_deadline" value="{{ old('contract_deadline') }}">
                @if($errors->has('contract_deadline'))
                    <span class="text-danger">{{ $errors->first('contract_deadline') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.contract_deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="from_id">{{ trans('cruds.contract.fields.from') }}</label>
                <select class="form-control select2 {{ $errors->has('from') ? 'is-invalid' : '' }}" name="from_id" id="from_id" required>
                    @foreach($froms as $id => $entry)
                        <option value="{{ $id }}" {{ old('from_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('from'))
                    <span class="text-danger">{{ $errors->first('from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.contract.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="static_clauses">{{ trans('cruds.contract.fields.static_clauses') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('static_clauses') ? 'is-invalid' : '' }}" name="static_clauses[]" id="static_clauses" multiple>
                    @foreach($static_clauses as $id => $static_clause)
                        <option value="{{ $id }}" {{ in_array($id, old('static_clauses', [])) ? 'selected' : '' }}>{{ $static_clause }}</option>
                    @endforeach
                </select>
                @if($errors->has('static_clauses'))
                    <span class="text-danger">{{ $errors->first('static_clauses') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.static_clauses_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dynamic_clauses">{{ trans('cruds.contract.fields.dynamic_clauses') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('dynamic_clauses') ? 'is-invalid' : '' }}" name="dynamic_clauses[]" id="dynamic_clauses" multiple>
                    @foreach($dynamic_clauses as $id => $dynamic_clause)
                        <option value="{{ $id }}" {{ in_array($id, old('dynamic_clauses', [])) ? 'selected' : '' }}>{{ $dynamic_clause }}</option>
                    @endforeach
                </select>
                @if($errors->has('dynamic_clauses'))
                    <span class="text-danger">{{ $errors->first('dynamic_clauses') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.dynamic_clauses_helper') }}</span>
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