@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.quotation.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.quotations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $quotation->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $quotation->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $quotation->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.assets') }}
                                    </th>
                                    <td>
                                        @foreach($quotation->assets as $key => $assets)
                                            <span class="label label-info">{{ $assets->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.total') }}
                                    </th>
                                    <td>
                                        {{ $quotation->total }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.clauses') }}
                                    </th>
                                    <td>
                                        @foreach($quotation->clauses as $key => $clauses)
                                            <span class="label label-info">{{ $clauses->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.from') }}
                                    </th>
                                    <td>
                                        {{ $quotation->from }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.to') }}
                                    </th>
                                    <td>
                                        {{ $quotation->to }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quotation.fields.validity') }}
                                    </th>
                                    <td>
                                        {{ $quotation->validity }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.quotations.index') }}">
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