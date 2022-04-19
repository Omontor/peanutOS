@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clientEvaluation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-evaluations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clientEvaluation.fields.id') }}
                        </th>
                        <td>
                            {{ $clientEvaluation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientEvaluation.fields.client') }}
                        </th>
                        <td>
                            {{ $clientEvaluation->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientEvaluation.fields.rating') }}
                        </th>
                        <td>
                            {{ $clientEvaluation->rating }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientEvaluation.fields.observations') }}
                        </th>
                        <td>
                            {!! $clientEvaluation->observations !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-evaluations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection