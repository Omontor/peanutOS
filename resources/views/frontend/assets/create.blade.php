@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.asset.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.assets.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="serial_number">{{ trans('cruds.asset.fields.serial_number') }}</label>
                            <input class="form-control" type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', '') }}" required>
                            @if($errors->has('serial_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('serial_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.serial_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="front_photo">{{ trans('cruds.asset.fields.front_photo') }}</label>
                            <div class="needsclick dropzone" id="front_photo-dropzone">
                            </div>
                            @if($errors->has('front_photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('front_photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.front_photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="side_photo">{{ trans('cruds.asset.fields.side_photo') }}</label>
                            <div class="needsclick dropzone" id="side_photo-dropzone">
                            </div>
                            @if($errors->has('side_photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('side_photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.side_photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="quarter_photo">{{ trans('cruds.asset.fields.quarter_photo') }}</label>
                            <div class="needsclick dropzone" id="quarter_photo-dropzone">
                            </div>
                            @if($errors->has('quarter_photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quarter_photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.quarter_photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="invoice">{{ trans('cruds.asset.fields.invoice') }}</label>
                            <div class="needsclick dropzone" id="invoice-dropzone">
                            </div>
                            @if($errors->has('invoice'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoice') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.invoice_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cost">{{ trans('cruds.asset.fields.cost') }}</label>
                            <input class="form-control" type="number" name="cost" id="cost" value="{{ old('cost', '') }}" step="0.01">
                            @if($errors->has('cost'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cost') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.cost_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="day_price">{{ trans('cruds.asset.fields.day_price') }}</label>
                            <input class="form-control" type="number" name="day_price" id="day_price" value="{{ old('day_price', '') }}" step="0.01" required>
                            @if($errors->has('day_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('day_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.day_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="week_price">{{ trans('cruds.asset.fields.week_price') }}</label>
                            <input class="form-control" type="number" name="week_price" id="week_price" value="{{ old('week_price', '') }}" step="0.01">
                            @if($errors->has('week_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('week_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.week_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.asset.fields.status') }}</label>
                            <input class="form-control" type="number" name="status" id="status" value="{{ old('status', '1') }}" step="1">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.status_helper') }}</span>
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
    Dropzone.options.frontPhotoDropzone = {
    url: '{{ route('frontend.assets.storeMedia') }}',
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
      $('form').find('input[name="front_photo"]').remove()
      $('form').append('<input type="hidden" name="front_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="front_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($asset) && $asset->front_photo)
      var file = {!! json_encode($asset->front_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="front_photo" value="' + file.file_name + '">')
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
    Dropzone.options.sidePhotoDropzone = {
    url: '{{ route('frontend.assets.storeMedia') }}',
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
      $('form').find('input[name="side_photo"]').remove()
      $('form').append('<input type="hidden" name="side_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="side_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($asset) && $asset->side_photo)
      var file = {!! json_encode($asset->side_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="side_photo" value="' + file.file_name + '">')
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
    Dropzone.options.quarterPhotoDropzone = {
    url: '{{ route('frontend.assets.storeMedia') }}',
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
      $('form').find('input[name="quarter_photo"]').remove()
      $('form').append('<input type="hidden" name="quarter_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="quarter_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($asset) && $asset->quarter_photo)
      var file = {!! json_encode($asset->quarter_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="quarter_photo" value="' + file.file_name + '">')
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
    Dropzone.options.invoiceDropzone = {
    url: '{{ route('frontend.assets.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="invoice"]').remove()
      $('form').append('<input type="hidden" name="invoice" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="invoice"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($asset) && $asset->invoice)
      var file = {!! json_encode($asset->invoice) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="invoice" value="' + file.file_name + '">')
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