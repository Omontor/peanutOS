<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaskActionRequest;
use App\Http\Requests\StoreTaskActionRequest;
use App\Http\Requests\UpdateTaskActionRequest;
use App\Models\Task;
use App\Models\TaskAction;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaskActionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('task_action_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskActions = TaskAction::with(['task', 'user', 'asignee', 'team', 'media'])->get();

        $tasks = Task::get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.taskActions.index', compact('taskActions', 'tasks', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_action_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asignees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.taskActions.create', compact('asignees', 'tasks', 'users'));
    }

    public function store(StoreTaskActionRequest $request)
    {
        $taskAction = TaskAction::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $taskAction->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taskAction->id]);
        }

        return redirect()->route('frontend.task-actions.index');
    }

    public function edit(TaskAction $taskAction)
    {
        abort_if(Gate::denies('task_action_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asignees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taskAction->load('task', 'user', 'asignee', 'team');

        return view('frontend.taskActions.edit', compact('asignees', 'taskAction', 'tasks', 'users'));
    }

    public function update(UpdateTaskActionRequest $request, TaskAction $taskAction)
    {
        $taskAction->update($request->all());

        if (count($taskAction->images) > 0) {
            foreach ($taskAction->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $taskAction->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $taskAction->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('frontend.task-actions.index');
    }

    public function show(TaskAction $taskAction)
    {
        abort_if(Gate::denies('task_action_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskAction->load('task', 'user', 'asignee', 'team', 'titleTaskMails');

        return view('frontend.taskActions.show', compact('taskAction'));
    }

    public function destroy(TaskAction $taskAction)
    {
        abort_if(Gate::denies('task_action_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskAction->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskActionRequest $request)
    {
        TaskAction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_action_create') && Gate::denies('task_action_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaskAction();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
