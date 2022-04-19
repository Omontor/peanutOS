<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStatusTaskRequest;
use App\Http\Requests\StoreStatusTaskRequest;
use App\Http\Requests\UpdateStatusTaskRequest;
use App\Models\StatusTask;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StatusTaskController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('status_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StatusTask::query()->select(sprintf('%s.*', (new StatusTask())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'status_task_show';
                $editGate = 'status_task_edit';
                $deleteGate = 'status_task_delete';
                $crudRoutePart = 'status-tasks';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.statusTasks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('status_task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusTasks.create');
    }

    public function store(StoreStatusTaskRequest $request)
    {
        $statusTask = StatusTask::create($request->all());

        return redirect()->route('admin.status-tasks.index');
    }

    public function edit(StatusTask $statusTask)
    {
        abort_if(Gate::denies('status_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusTasks.edit', compact('statusTask'));
    }

    public function update(UpdateStatusTaskRequest $request, StatusTask $statusTask)
    {
        $statusTask->update($request->all());

        return redirect()->route('admin.status-tasks.index');
    }

    public function show(StatusTask $statusTask)
    {
        abort_if(Gate::denies('status_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusTasks.show', compact('statusTask'));
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
