@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taskAction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.task-actions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taskAction.fields.id') }}
                        </th>
                        <td>
                            {{ $taskAction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskAction.fields.task') }}
                        </th>
                        <td>
                            {{ $taskAction->task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskAction.fields.user') }}
                        </th>
                        <td>
                            {{ $taskAction->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskAction.fields.asignee') }}
                        </th>
                        <td>
                            {{ $taskAction->asignee->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskAction.fields.content') }}
                        </th>
                        <td>
                            {!! $taskAction->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskAction.fields.images') }}
                        </th>
                        <td>
                            @foreach($taskAction->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskAction.fields.title') }}
                        </th>
                        <td>
                            {{ $taskAction->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.task-actions.index') }}">
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
            <a class="nav-link" href="#title_task_mails" role="tab" data-toggle="tab">
                {{ trans('cruds.taskMail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="title_task_mails">
            @includeIf('admin.taskActions.relationships.titleTaskMails', ['taskMails' => $taskAction->titleTaskMails])
        </div>
    </div>
</div>

@endsection