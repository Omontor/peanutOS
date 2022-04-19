<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatusTaskRequest;
use App\Http\Requests\UpdateStatusTaskRequest;
use App\Http\Resources\Admin\StatusTaskResource;
use App\Models\StatusTask;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusTaskApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('status_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StatusTaskResource(StatusTask::all());
    }

    public function store(StoreStatusTaskRequest $request)
    {
        $statusTask = StatusTask::create($request->all());

        return (new StatusTaskResource($statusTask))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StatusTask $statusTask)
    {
        abort_if(Gate::denies('status_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StatusTaskResource($statusTask);
    }

    public function update(UpdateStatusTaskRequest $request, StatusTask $statusTask)
    {
        $statusTask->update($request->all());

        return (new StatusTaskResource($statusTask))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StatusTask $statusTask)
    {
        abort_if(Gate::denies('status_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statusTask->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
