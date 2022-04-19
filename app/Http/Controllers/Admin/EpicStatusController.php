<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEpicStatusRequest;
use App\Http\Requests\StoreEpicStatusRequest;
use App\Http\Requests\UpdateEpicStatusRequest;
use App\Models\EpicStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EpicStatusController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('epic_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EpicStatus::query()->select(sprintf('%s.*', (new EpicStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'epic_status_show';
                $editGate = 'epic_status_edit';
                $deleteGate = 'epic_status_delete';
                $crudRoutePart = 'epic-statuses';

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

        return view('admin.epicStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('epic_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.epicStatuses.create');
    }

    public function store(StoreEpicStatusRequest $request)
    {
        $epicStatus = EpicStatus::create($request->all());

        return redirect()->route('admin.epic-statuses.index');
    }

    public function edit(EpicStatus $epicStatus)
    {
        abort_if(Gate::denies('epic_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.epicStatuses.edit', compact('epicStatus'));
    }

    public function update(UpdateEpicStatusRequest $request, EpicStatus $epicStatus)
    {
        $epicStatus->update($request->all());

        return redirect()->route('admin.epic-statuses.index');
    }

    public function show(EpicStatus $epicStatus)
    {
        abort_if(Gate::denies('epic_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epicStatus->load('statusEpics');

        return view('admin.epicStatuses.show', compact('epicStatus'));
    }

    public function destroy(EpicStatus $epicStatus)
    {
        abort_if(Gate::denies('epic_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epicStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyEpicStatusRequest $request)
    {
        EpicStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
