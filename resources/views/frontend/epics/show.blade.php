@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.epic.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.epics.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.epic.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $epic->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.epic.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $epic->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.epic.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $epic->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.epic.fields.asignees') }}
                                    </th>
                                    <td>
                                        @foreach($epic->asignees as $key => $asignees)
                                            <span class="label label-info">{{ $asignees->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.epic.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $epic->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.epic.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $epic->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.epic.fields.reporter') }}
                                    </th>
                                    <td>
                                        {{ $epic->reporter->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.epic.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $epic->status->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.epics.index') }}">
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