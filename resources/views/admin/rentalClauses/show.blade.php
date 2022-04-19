@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rentalClause.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rental-clauses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rentalClause.fields.id') }}
                        </th>
                        <td>
                            {{ $rentalClause->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentalClause.fields.title') }}
                        </th>
                        <td>
                            {{ $rentalClause->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentalClause.fields.content') }}
                        </th>
                        <td>
                            {!! $rentalClause->content !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rental-clauses.index') }}">
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
            <a class="nav-link" href="#clauses_quotations" role="tab" data-toggle="tab">
                {{ trans('cruds.quotation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="clauses_quotations">
            @includeIf('admin.rentalClauses.relationships.clausesQuotations', ['quotations' => $rentalClause->clausesQuotations])
        </div>
    </div>
</div>

@endsection