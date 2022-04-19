<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEpicRequest;
use App\Http\Requests\UpdateEpicRequest;
use App\Http\Resources\Admin\EpicResource;
use App\Models\Epic;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EpicApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('epic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EpicResource(Epic::with(['asignees', 'reporter', 'status'])->get());
    }

    public function store(StoreEpicRequest $request)
    {
        $epic = Epic::create($request->all());
        $epic->asignees()->sync($request->input('asignees', []));

        return (new EpicResource($epic))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Epic $epic)
    {
        abort_if(Gate::denies('epic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EpicResource($epic->load(['asignees', 'reporter', 'status']));
    }

    public function update(UpdateEpicRequest $request, Epic $epic)
    {
        $epic->update($request->all());
        $epic->asignees()->sync($request->input('asignees', []));

        return (new EpicResource($epic))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Epic $epic)
    {
        abort_if(Gate::denies('epic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epic->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
