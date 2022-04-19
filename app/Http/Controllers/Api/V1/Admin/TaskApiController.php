<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\Admin\TaskResource;
use App\Models\Task;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskResource(Task::with(['asignee'])->get());
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());

        if ($request->input('image', false)) {
            $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('documentation', false)) {
            $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('documentation'))))->toMediaCollection('documentation');
        }

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskResource($task->load(['asignee']));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());

        if ($request->input('image', false)) {
            if (!$task->image || $request->input('image') !== $task->image->file_name) {
                if ($task->image) {
                    $task->image->delete();
                }
                $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($task->image) {
            $task->image->delete();
        }

        if ($request->input('documentation', false)) {
            if (!$task->documentation || $request->input('documentation') !== $task->documentation->file_name) {
                if ($task->documentation) {
                    $task->documentation->delete();
                }
                $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('documentation'))))->toMediaCollection('documentation');
            }
        } elseif ($task->documentation) {
            $task->documentation->delete();
        }

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
