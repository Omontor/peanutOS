@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eventDay.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-days.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDay.fields.id') }}
                        </th>
                        <td>
                            {{ $eventDay->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDay.fields.date') }}
                        </th>
                        <td>
                            {{ $eventDay->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDay.fields.event') }}
                        </th>
                        <td>
                            {{ $eventDay->event->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDay.fields.venue') }}
                        </th>
                        <td>
                            {{ $eventDay->venue->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDay.fields.title') }}
                        </th>
                        <td>
                            {{ $eventDay->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-days.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection