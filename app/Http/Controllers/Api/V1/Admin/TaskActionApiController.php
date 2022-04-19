<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTaskActionRequest;
use App\Http\Requests\UpdateTaskActionRequest;
use App\Http\Resources\Admin\TaskActionResource;
use App\Models\TaskAction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskActionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('task_action_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskActionResource(TaskAction::with(['task', 'user', 'asignee', 'team'])->get());
    }

    public function store(StoreTaskActionRequest $request)
    {
        $taskAction = TaskAction::create($request->all());

        if ($request->input('images', false)) {
            $taskAction->addMedia(storage_path('tmp/uploads/' . basename($request->input('images'))))->toMediaCollection('images');
        }

        return (new TaskActionResource($taskAction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TaskAction $taskAction)
    {
        abort_if(Gate::denies('task_action_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskActionResource($taskAction->load(['task', 'user', 'asignee', 'team']));
    }

    public function update(UpdateTaskActionRequest $request, TaskAction $taskAction)
    {
        $taskAction->update($request->all());

        if ($request->input('images', false)) {
            if (!$taskAction->images || $request->input('images') !== $taskAction->images->file_name) {
                if ($taskAction->images) {
                    $taskAction->images->delete();
                }
                $taskAction->addMedia(storage_path('tmp/uploads/' . basename($request->input('images'))))->toMediaCollection('images');
            }
        } elseif ($taskAction->images) {
            $taskAction->images->delete();
        }

        return (new TaskActionResource($taskAction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TaskAction $taskAction)
    {
        abort_if(Gate::denies('task_action_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskAction->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
