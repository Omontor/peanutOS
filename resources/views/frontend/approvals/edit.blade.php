@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.approval.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.approvals.update", [$approval->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="client_id">{{ trans('cruds.approval.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id" required>
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $approval->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.approval.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="quotation_id">{{ trans('cruds.approval.fields.quotation') }}</label>
                            <select class="form-control select2" name="quotation_id" id="quotation_id" required>
                                @foreach($quotations as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('quotation_id') ? old('quotation_id') : $approval->quotation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('quotation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quotation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.approval.fields.quotation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.approval.fields.status') }}</label>
                            <input class="form-control" type="number" name="status" id="status" value="{{ old('status', $approval->status) }}" step="1">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.approval.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="signature">{{ trans('cruds.approval.fields.signature') }}</label>
                            <div class="needsclick dropzone" id="signature-dropzone">
                            </div>
                            @if($errors->has('signature'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('signature') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.approval.fields.signature_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.signatureDropzone = {
    url: '{{ route('frontend.approvals.storeMedia') }}',
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
      $('form').find('input[name="signature"]').remove()
      $('form').append('<input type="hidden" name="signature" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="signature"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($approval) && $approval->signature)
      var file = {!! json_encode($approval->signature) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="signature" value="' + file.file_name + '">')
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