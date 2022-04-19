@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.staticClause.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.static-clauses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.staticClause.fields.id') }}
                        </th>
                        <td>
                            {{ $staticClause->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticClause.fields.content') }}
                        </th>
                        <td>
                            {!! $staticClause->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticClause.fields.title') }}
                        </th>
                        <td>
                            {{ $staticClause->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.static-clauses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection