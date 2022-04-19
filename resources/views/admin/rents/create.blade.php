@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.rent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.rent.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rent.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assets">{{ trans('cruds.rent.fields.asset') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('assets') ? 'is-invalid' : '' }}" name="assets[]" id="assets" multiple>
                    @foreach($assets as $id => $asset)
                        <option value="{{ $id }}" {{ in_array($id, old('assets', [])) ? 'selected' : '' }}>{{ $asset }}</option>
                    @endforeach
                </select>
                @if($errors->has('assets'))
                    <span class="text-danger">{{ $errors->first('assets') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rent.fields.asset_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quotation_id">{{ trans('cruds.rent.fields.quotation') }}</label>
                <select class="form-control select2 {{ $errors->has('quotation') ? 'is-invalid' : '' }}" name="quotation_id" id="quotation_id">
                    @foreach($quotations as $id => $entry)
                        <option value="{{ $id }}" {{ old('quotation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('quotation'))
                    <span class="text-danger">{{ $errors->first('quotation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rent.fields.quotation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="identification">{{ trans('cruds.rent.fields.identification') }}</label>
                <div class="needsclick dropzone {{ $errors->has('identification') ? 'is-invalid' : '' }}" id="identification-dropzone">
                </div>
                @if($errors->has('identification'))
                    <span class="text-danger">{{ $errors->first('identification') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rent.fields.identification_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_proof">{{ trans('cruds.rent.fields.address_proof') }}</label>
                <div class="needsclick dropzone {{ $errors->has('address_proof') ? 'is-invalid' : '' }}" id="address_proof-dropzone">
                </div>
                @if($errors->has('address_proof'))
                    <span class="text-danger">{{ $errors->first('address_proof') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rent.fields.address_proof_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="from">{{ trans('cruds.rent.fields.from') }}</label>
                <input class="form-control datetime {{ $errors->has('from') ? 'is-invalid' : '' }}" type="text" name="from" id="from" value="{{ old('from') }}" required>
                @if($errors->has('from'))
                    <span class="text-danger">{{ $errors->first('from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rent.fields.from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="to">{{ trans('cruds.rent.fields.to') }}</label>
                <input class="form-control datetime {{ $errors->has('to') ? 'is-invalid' : '' }}" type="text" name="to" id="to" value="{{ old('to') }}" required>
                @if($errors->has('to'))
                    <span class="text-danger">{{ $errors->first('to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rent.fields.to_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.identificationDropzone = {
    url: '{{ route('admin.rents.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="identification"]').remove()
      $('form').append('<input type="hidden" name="identification" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="identification"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($rent) && $rent->identification)
      var file = {!! json_encode($rent->identification) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="identification" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    Dropzone.options.addressProofDropzone = {
    url: '{{ route('admin.rents.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="address_proof"]').remove()
      $('form').append('<input type="hidden" name="address_proof" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="address_proof"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($rent) && $rent->address_proof)
      var file = {!! json_encode($rent->address_proof) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="address_proof" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection