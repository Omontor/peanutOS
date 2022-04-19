<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaskMailRequest;
use App\Http\Requests\StoreTaskMailRequest;
use App\Http\Requests\UpdateTaskMailRequest;
use App\Models\TaskAction;
use App\Models\TaskMail;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskMailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_mail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskMails = TaskMail::with(['title', 'team'])->get();

        $task_actions = TaskAction::get();

        $teams = Team::get();

        return view('frontend.taskMails.index', compact('taskMails', 'task_actions', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_mail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $titles = TaskAction::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.taskMails.create', compact('titles'));
    }

    public function store(StoreTaskMailRequest $request)
    {
        $taskMail = TaskMail::create($request->all());

        return redirect()->route('frontend.task-mails.index');
    }

    public function edit(TaskMail $taskMail)
    {
        abort_if(Gate::denies('task_mail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $titles = TaskAction::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taskMail->load('title', 'team');

        return view('frontend.taskMails.edit', compact('taskMail', 'titles'));
    }

    public function update(UpdateTaskMailRequest $request, TaskMail $taskMail)
    {
        $taskMail->update($request->all());

        return redirect()->route('frontend.task-mails.index');
    }

    public function show(TaskMail $taskMail)
    {
        abort_if(Gate::denies('task_mail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskMail->load('title', 'team');

        return view('frontend.taskMails.show', compact('taskMail'));
    }

    public function destroy(TaskMail $taskMail)
    {
        abort_if(Gate::denies('task_mail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskMail->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskMailRequest $request)
    {
        TaskMail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
