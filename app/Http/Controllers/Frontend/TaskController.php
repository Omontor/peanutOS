<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::with(['asignee', 'media'])->get();

        $users = User::get();

        return view('frontend.tasks.index', compact('tasks', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.tasks.create', compact('asignees'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $task->id]);
        }

        return redirect()->route('frontend.tasks.index');
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $task->load('asignee');

        return view('frontend.tasks.edit', compact('asignees', 'task'));
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

        return redirect()->route('frontend.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('asignee', 'taskTaskActions');

        return view('frontend.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        Task::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_create') && Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Task();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
