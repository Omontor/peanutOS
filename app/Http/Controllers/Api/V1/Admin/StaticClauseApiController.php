<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStaticClauseRequest;
use App\Http\Requests\UpdateStaticClauseRequest;
use App\Http\Resources\Admin\StaticClauseResource;
use App\Models\StaticClause;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaticClauseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('static_clause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaticClauseResource(StaticClause::all());
    }

    public function store(StoreStaticClauseRequest $request)
    {
        $staticClause = StaticClause::create($request->all());

        return (new StaticClauseResource($staticClause))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StaticClause $staticClause)
    {
        abort_if(Gate::denies('static_clause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaticClauseResource($staticClause);
    }

    public function update(UpdateStaticClauseRequest $request, StaticClause $staticClause)
    {
        $staticClause->update($request->all());

        return (new StaticClauseResource($staticClause))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StaticClause $staticClause)
    {
        abort_if(Gate::denies('static_clause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staticClause->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
