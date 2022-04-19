<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEpicStatusRequest;
use App\Http\Requests\UpdateEpicStatusRequest;
use App\Http\Resources\Admin\EpicStatusResource;
use App\Models\EpicStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EpicStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('epic_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EpicStatusResource(EpicStatus::all());
    }

    public function store(StoreEpicStatusRequest $request)
    {
        $epicStatus = EpicStatus::create($request->all());

        return (new EpicStatusResource($epicStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EpicStatus $epicStatus)
    {
        abort_if(Gate::denies('epic_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EpicStatusResource($epicStatus);
    }

    public function update(UpdateEpicStatusRequest $request, EpicStatus $epicStatus)
    {
        $epicStatus->update($request->all());

        return (new EpicStatusResource($epicStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EpicStatus $epicStatus)
    {
        abort_if(Gate::denies('epic_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epicStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
