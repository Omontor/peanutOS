<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Http\Resources\Admin\ContractResource;
use App\Models\Contract;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContractResource(Contract::with(['from', 'client', 'static_clauses', 'dynamic_clauses'])->get());
    }

    public function store(StoreContractRequest $request)
    {
        $contract = Contract::create($request->all());
        $contract->static_clauses()->sync($request->input('static_clauses', []));
        $contract->dynamic_clauses()->sync($request->input('dynamic_clauses', []));

        return (new ContractResource($contract))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Contract $contract)
    {
        abort_if(Gate::denies('contract_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContractResource($contract->load(['from', 'client', 'static_clauses', 'dynamic_clauses']));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update($request->all());
        $contract->static_clauses()->sync($request->input('static_clauses', []));
        $contract->dynamic_clauses()->sync($request->input('dynamic_clauses', []));

        return (new ContractResource($contract))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Contract $contract)
    {
        abort_if(Gate::denies('contract_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
