<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEpicStatusRequest;
use App\Http\Requests\StoreEpicStatusRequest;
use App\Http\Requests\UpdateEpicStatusRequest;
use App\Models\EpicStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EpicStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('epic_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epicStatuses = EpicStatus::all();

        return view('frontend.epicStatuses.index', compact('epicStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('epic_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.epicStatuses.create');
    }

    public function store(StoreEpicStatusRequest $request)
    {
        $epicStatus = EpicStatus::create($request->all());

        return redirect()->route('frontend.epic-statuses.index');
    }

    public function edit(EpicStatus $epicStatus)
    {
        abort_if(Gate::denies('epic_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.epicStatuses.edit', compact('epicStatus'));
    }

    public function update(UpdateEpicStatusRequest $request, EpicStatus $epicStatus)
    {
        $epicStatus->update($request->all());

        return redirect()->route('frontend.epic-statuses.index');
    }

    public function show(EpicStatus $epicStatus)
    {
        abort_if(Gate::denies('epic_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epicStatus->load('statusEpics');

        return view('frontend.epicStatuses.show', compact('epicStatus'));
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
