@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dynamicClause.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dynamic-clauses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dynamicClause.fields.id') }}
                        </th>
                        <td>
                            {{ $dynamicClause->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dynamicClause.fields.content') }}
                        </th>
                        <td>
                            {!! $dynamicClause->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dynamicClause.fields.title') }}
                        </th>
                        <td>
                            {{ $dynamicClause->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dynamic-clauses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection