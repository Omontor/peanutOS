<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContractRequest;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\BasicData;
use App\Models\Client;
use App\Models\Contract;
use App\Models\DynamicClause;
use App\Models\StaticClause;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contracts = Contract::with(['from', 'client', 'static_clauses', 'dynamic_clauses'])->get();

        $basic_datas = BasicData::get();

        $clients = Client::get();

        $static_clauses = StaticClause::get();

        $dynamic_clauses = DynamicClause::get();

        return view('frontend.contracts.index', compact('basic_datas', 'clients', 'contracts', 'dynamic_clauses', 'static_clauses'));
    }

    public function create()
    {
        abort_if(Gate::denies('contract_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BasicData::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $static_clauses = StaticClause::pluck('title', 'id');

        $dynamic_clauses = DynamicClause::pluck('title', 'id');

        return view('frontend.contracts.create', compact('clients', 'dynamic_clauses', 'froms', 'static_clauses'));
    }

    public function store(StoreContractRequest $request)
    {
        $contract = Contract::create($request->all());
        $contract->static_clauses()->sync($request->input('static_clauses', []));
        $contract->dynamic_clauses()->sync($request->input('dynamic_clauses', []));

        return redirect()->route('frontend.contracts.index');
    }

    public function edit(Contract $contract)
    {
        abort_if(Gate::denies('contract_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BasicData::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $static_clauses = StaticClause::pluck('title', 'id');

        $dynamic_clauses = DynamicClause::pluck('title', 'id');

        $contract->load('from', 'client', 'static_clauses', 'dynamic_clauses');

        return view('frontend.contracts.edit', compact('clients', 'contract', 'dynamic_clauses', 'froms', 'static_clauses'));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update($request->all());
        $contract->static_clauses()->sync($request->input('static_clauses', []));
        $contract->dynamic_clauses()->sync($request->input('dynamic_clauses', []));

        return redirect()->route('frontend.contracts.index');
    }

    public function show(Contract $contract)
    {
        abort_if(Gate::denies('contract_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->load('from', 'client', 'static_clauses', 'dynamic_clauses');

        return view('frontend.contracts.show', compact('contract'));
    }

    public function destroy(Contract $contract)
    {
        abort_if(Gate::denies('contract_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->delete();

        return back();
    }

    public function massDestroy(MassDestroyContractRequest $request)
    {
        Contract::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
