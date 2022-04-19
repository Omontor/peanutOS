<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreManagementRequest;
use App\Http\Requests\UpdateManagementRequest;
use App\Http\Resources\Admin\ManagementResource;
use App\Models\Management;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagementApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManagementResource(Management::with(['lead'])->get());
    }

    public function store(StoreManagementRequest $request)
    {
        $management = Management::create($request->all());

        return (new ManagementResource($management))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Management $management)
    {
        abort_if(Gate::denies('management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManagementResource($management->load(['lead']));
    }

    public function update(UpdateManagementRequest $request, Management $management)
    {
        $management->update($request->all());

        return (new ManagementResource($management))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Management $management)
    {
        abort_if(Gate::denies('management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $management->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
