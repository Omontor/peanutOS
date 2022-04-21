@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.assetReturn.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.asset-returns.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="rent_id">{{ trans('cruds.assetReturn.fields.rent') }}</label>
                <select class="form-control select2 {{ $errors->has('rent') ? 'is-invalid' : '' }}" name="rent_id" id="rent_id">
                    @foreach($rents as $id => $entry)
                        <option value="{{ $id }}" {{ old('rent_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('rent'))
                    <span class="text-danger">{{ $errors->first('rent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetReturn.fields.rent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.assetReturn.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetReturn.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="witness">{{ trans('cruds.assetReturn.fields.witness') }}</label>
                <div class="needsclick dropzone {{ $errors->has('witness') ? 'is-invalid' : '' }}" id="witness-dropzone">
                </div>
                @if($errors->has('witness'))
                    <span class="text-danger">{{ $errors->first('witness') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetReturn.fields.witness_helper') }}</span>
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
    var uploadedWitnessMap = {}
Dropzone.options.witnessDropzone = {
    url: '{{ route('admin.asset-returns.storeMedia') }}',
    maxFilesize: 6, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 6,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="witness[]" value="' + response.name + '">')
      uploadedWitnessMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedWitnessMap[file.name]
      }
      $('form').find('input[name="witness[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($assetReturn) && $assetReturn->witness)
      var files = {!! json_encode($assetReturn->witness) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="witness[]" value="' + file.file_name + '">')
        }
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