<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class TaskMailController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('task_mail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TaskMail::with(['title', 'team'])->select(sprintf('%s.*', (new TaskMail())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'task_mail_show';
                $editGate = 'task_mail_edit';
                $deleteGate = 'task_mail_delete';
                $crudRoutePart = 'task-mails';

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
            $table->addColumn('title_title', function ($row) {
                return $row->title ? $row->title->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'title']);

            return $table->make(true);
        }

        $task_actions = TaskAction::get();
        $teams        = Team::get();

        return view('admin.taskMails.index', compact('task_actions', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_mail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $titles = TaskAction::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.taskMails.create', compact('titles'));
    }

    public function store(StoreTaskMailRequest $request)
    {
        $taskMail = TaskMail::create($request->all());

        return redirect()->route('admin.task-mails.index');
    }

    public function edit(TaskMail $taskMail)
    {
        abort_if(Gate::denies('task_mail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $titles = TaskAction::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taskMail->load('title', 'team');

        return view('admin.taskMails.edit', compact('titles', 'taskMail'));
    }

    public function update(UpdateTaskMailRequest $request, TaskMail $taskMail)
    {
        $taskMail->update($request->all());

        return redirect()->route('admin.task-mails.index');
    }

    public function show(TaskMail $taskMail)
    {
        abort_if(Gate::denies('task_mail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskMail->load('title', 'team');

        return view('admin.taskMails.show', compact('taskMail'));
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
