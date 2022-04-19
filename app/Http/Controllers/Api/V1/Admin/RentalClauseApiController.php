<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRentalClauseRequest;
use App\Http\Requests\UpdateRentalClauseRequest;
use App\Http\Resources\Admin\RentalClauseResource;
use App\Models\RentalClause;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RentalClauseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('rental_clause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RentalClauseResource(RentalClause::all());
    }

    public function store(StoreRentalClauseRequest $request)
    {
        $rentalClause = RentalClause::create($request->all());

        return (new RentalClauseResource($rentalClause))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RentalClause $rentalClause)
    {
        abort_if(Gate::denies('rental_clause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RentalClauseResource($rentalClause);
    }

    public function update(UpdateRentalClauseRequest $request, RentalClause $rentalClause)
    {
        $rentalClause->update($request->all());

        return (new RentalClauseResource($rentalClause))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RentalClause $rentalClause)
    {
        abort_if(Gate::denies('rental_clause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rentalClause->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
