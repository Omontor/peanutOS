@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.basicData.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.basic-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.basicData.fields.id') }}
                        </th>
                        <td>
                            {{ $basicData->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.basicData.fields.name') }}
                        </th>
                        <td>
                            {{ $basicData->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.basicData.fields.image') }}
                        </th>
                        <td>
                            @if($basicData->image)
                                <a href="{{ $basicData->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $basicData->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.basicData.fields.address') }}
                        </th>
                        <td>
                            {{ $basicData->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.basicData.fields.email') }}
                        </th>
                        <td>
                            {{ $basicData->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.basicData.fields.rfc') }}
                        </th>
                        <td>
                            {{ $basicData->rfc }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.basic-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#from_contracts" role="tab" data-toggle="tab">
                {{ trans('cruds.contract.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="from_contracts">
            @includeIf('admin.basicDatas.relationships.fromContracts', ['contracts' => $basicData->fromContracts])
        </div>
    </div>
</div>

@endsection