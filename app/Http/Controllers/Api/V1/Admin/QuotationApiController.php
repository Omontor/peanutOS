<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;
use App\Http\Resources\Admin\QuotationResource;
use App\Models\Quotation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuotationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('quotation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuotationResource(Quotation::with(['client', 'assets', 'clauses'])->get());
    }

    public function store(StoreQuotationRequest $request)
    {
        $quotation = Quotation::create($request->all());
        $quotation->assets()->sync($request->input('assets', []));
        $quotation->clauses()->sync($request->input('clauses', []));

        return (new QuotationResource($quotation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Quotation $quotation)
    {
        abort_if(Gate::denies('quotation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuotationResource($quotation->load(['client', 'assets', 'clauses']));
    }

    public function update(UpdateQuotationRequest $request, Quotation $quotation)
    {
        $quotation->update($request->all());
        $quotation->assets()->sync($request->input('assets', []));
        $quotation->clauses()->sync($request->input('clauses', []));

        return (new QuotationResource($quotation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Quotation $quotation)
    {
        abort_if(Gate::denies('quotation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quotation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
