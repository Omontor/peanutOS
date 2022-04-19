<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class TaskActionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('task_action_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TaskAction::with(['task', 'user', 'asignee', 'team'])->select(sprintf('%s.*', (new TaskAction())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'task_action_show';
                $editGate = 'task_action_edit';
                $deleteGate = 'task_action_delete';
                $crudRoutePart = 'task-actions';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('task_name', function ($row) {
                return $row->task ? $row->task->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('asignee_name', function ($row) {
                return $row->asignee ? $row->asignee->name : '';
            });

            $table->editColumn('images', function ($row) {
                if (!$row->images) {
                    return '';
                }
                $links = [];
                foreach ($row->images as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'task', 'user', 'asignee', 'images']);

            return $table->make(true);
        }

        $tasks = Task::get();
        $users = User::get();
        $teams = Team::get();

        return view('admin.taskActions.index', compact('tasks', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_action_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asignees = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.taskActions.create', compact('tasks', 'users', 'asignees'));
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

        return redirect()->route('admin.task-actions.index');
    }

    public function edit(TaskAction $taskAction)
    {
        abort_if(Gate::denies('task_action_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asignees = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taskAction->load('task', 'user', 'asignee', 'team');

        return view('admin.taskActions.edit', compact('tasks', 'users', 'asignees', 'taskAction'));
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

        return redirect()->route('admin.task-actions.index');
    }

    public function show(TaskAction $taskAction)
    {
        abort_if(Gate::denies('task_action_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskAction->load('task', 'user', 'asignee', 'team', 'titleTaskMails');

        return view('admin.taskActions.show', compact('taskAction'));
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
