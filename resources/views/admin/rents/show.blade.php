@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rent.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rent.fields.id') }}
                        </th>
                        <td>
                            {{ $rent->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rent.fields.client') }}
                        </th>
                        <td>
                            {{ $rent->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rent.fields.asset') }}
                        </th>
                        <td>
                            @foreach($rent->assets as $key => $asset)
                                <span class="label label-info">{{ $asset->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rent.fields.quotation') }}
                        </th>
                        <td>
                            {{ $rent->quotation->total ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rent.fields.identification') }}
                        </th>
                        <td>
                            @if($rent->identification)
                                <a href="{{ $rent->identification->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $rent->identification->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rent.fields.address_proof') }}
                        </th>
                        <td>
                            @if($rent->address_proof)
                                <a href="{{ $rent->address_proof->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $rent->address_proof->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rent.fields.from') }}
                        </th>
                        <td>
                            {{ $rent->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rent.fields.to') }}
                        </th>
                        <td>
                            {{ $rent->to }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection