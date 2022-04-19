<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskMailRequest;
use App\Http\Requests\UpdateTaskMailRequest;
use App\Http\Resources\Admin\TaskMailResource;
use App\Models\TaskMail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskMailApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_mail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskMailResource(TaskMail::with(['title', 'team'])->get());
    }

    public function store(StoreTaskMailRequest $request)
    {
        $taskMail = TaskMail::create($request->all());

        return (new TaskMailResource($taskMail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TaskMail $taskMail)
    {
        abort_if(Gate::denies('task_mail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskMailResource($taskMail->load(['title', 'team']));
    }

    public function update(UpdateTaskMailRequest $request, TaskMail $taskMail)
    {
        $taskMail->update($request->all());

        return (new TaskMailResource($taskMail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TaskMail $taskMail)
    {
        abort_if(Gate::denies('task_mail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskMail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
