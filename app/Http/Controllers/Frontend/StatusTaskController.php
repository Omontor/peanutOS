<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStatusTaskRequest;
use App\Http\Requests\StoreStatusTaskRequest;
use App\Http\Requests\UpdateStatusTaskRequest;
use App\Models\StatusTask;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusTaskController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('status_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statusTasks = StatusTask::all();

        return view('frontend.statusTasks.index', compact('statusTasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('status_task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.statusTasks.create');
    }

    public function store(StoreStatusTaskRequest $request)
    {
        $statusTask = StatusTask::create($request->all());

        return redirect()->route('frontend.status-tasks.index');
    }

    public function edit(StatusTask $statusTask)
    {
        abort_if(Gate::denies('status_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.statusTasks.edit', compact('statusTask'));
    }

    public function update(UpdateStatusTaskRequest $request, StatusTask $statusTask)
    {
        $statusTask->update($request->all());

        return redirect()->route('frontend.status-tasks.index');
    }

    public function show(StatusTask $statusTask)
    {
        abort_if(Gate::denies('status_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.statusTasks.show', compact('statusTask'));
    }

    public function destroy(StatusTask $statusTask)
    {
        abort_if(Gate::denies('status_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statusTask->delete();

        return back();
    }

    public function massDestroy(MassDestroyStatusTaskRequest $request)
    {
        StatusTask::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
