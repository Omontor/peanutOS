@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#user_clients" role="tab" data-toggle="tab">
                {{ trans('cruds.client.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_rents" role="tab" data-toggle="tab">
                {{ trans('cruds.rent.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_quotations" role="tab" data-toggle="tab">
                {{ trans('cruds.quotation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_approvals" role="tab" data-toggle="tab">
                {{ trans('cruds.approval.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#lead_managements" role="tab" data-toggle="tab">
                {{ trans('cruds.management.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#reporter_epics" role="tab" data-toggle="tab">
                {{ trans('cruds.epic.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#asignee_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#asignees_epics" role="tab" data-toggle="tab">
                {{ trans('cruds.epic.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_clients">
            @includeIf('admin.users.relationships.userClients', ['clients' => $user->userClients])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_rents">
            @includeIf('admin.users.relationships.clientRents', ['rents' => $user->clientRents])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_quotations">
            @includeIf('admin.users.relationships.clientQuotations', ['quotations' => $user->clientQuotations])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_approvals">
            @includeIf('admin.users.relationships.clientApprovals', ['approvals' => $user->clientApprovals])
        </div>
        <div class="tab-pane" role="tabpanel" id="lead_managements">
            @includeIf('admin.users.relationships.leadManagements', ['managements' => $user->leadManagements])
        </div>
        <div class="tab-pane" role="tabpanel" id="reporter_epics">
            @includeIf('admin.users.relationships.reporterEpics', ['epics' => $user->reporterEpics])
        </div>
        <div class="tab-pane" role="tabpanel" id="asignee_tasks">
            @includeIf('admin.users.relationships.asigneeTasks', ['tasks' => $user->asigneeTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="asignees_epics">
            @includeIf('admin.users.relationships.asigneesEpics', ['epics' => $user->asigneesEpics])
        </div>
    </div>
</div>

@endsection