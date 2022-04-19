@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.asset.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.assets.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $asset->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $asset->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.serial_number') }}
                                    </th>
                                    <td>
                                        {{ $asset->serial_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.front_photo') }}
                                    </th>
                                    <td>
                                        @if($asset->front_photo)
                                            <a href="{{ $asset->front_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $asset->front_photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.side_photo') }}
                                    </th>
                                    <td>
                                        @if($asset->side_photo)
                                            <a href="{{ $asset->side_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $asset->side_photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.quarter_photo') }}
                                    </th>
                                    <td>
                                        @if($asset->quarter_photo)
                                            <a href="{{ $asset->quarter_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $asset->quarter_photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.invoice') }}
                                    </th>
                                    <td>
                                        @if($asset->invoice)
                                            <a href="{{ $asset->invoice->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.cost') }}
                                    </th>
                                    <td>
                                        {{ $asset->cost }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.day_price') }}
                                    </th>
                                    <td>
                                        {{ $asset->day_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.week_price') }}
                                    </th>
                                    <td>
                                        {{ $asset->week_price }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.assets.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection