<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDynamicClauseRequest;
use App\Http\Requests\UpdateDynamicClauseRequest;
use App\Http\Resources\Admin\DynamicClauseResource;
use App\Models\DynamicClause;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DynamicClauseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('dynamic_clause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DynamicClauseResource(DynamicClause::all());
    }

    public function store(StoreDynamicClauseRequest $request)
    {
        $dynamicClause = DynamicClause::create($request->all());

        return (new DynamicClauseResource($dynamicClause))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DynamicClause $dynamicClause)
    {
        abort_if(Gate::denies('dynamic_clause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DynamicClauseResource($dynamicClause);
    }

    public function update(UpdateDynamicClauseRequest $request, DynamicClause $dynamicClause)
    {
        $dynamicClause->update($request->all());

        return (new DynamicClauseResource($dynamicClause))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DynamicClause $dynamicClause)
    {
        abort_if(Gate::denies('dynamic_clause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dynamicClause->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
