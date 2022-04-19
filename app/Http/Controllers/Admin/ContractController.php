<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Contract::with(['from', 'client', 'static_clauses', 'dynamic_clauses'])->select(sprintf('%s.*', (new Contract())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'contract_show';
                $editGate = 'contract_edit';
                $deleteGate = 'contract_delete';
                $crudRoutePart = 'contracts';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->addColumn('from_name', function ($row) {
                return $row->from ? $row->from->name : '';
            });

            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('static_clauses', function ($row) {
                $labels = [];
                foreach ($row->static_clauses as $static_clause) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $static_clause->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('dynamic_clauses', function ($row) {
                $labels = [];
                foreach ($row->dynamic_clauses as $dynamic_clause) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $dynamic_clause->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'from', 'client', 'static_clauses', 'dynamic_clauses']);

            return $table->make(true);
        }

        $basic_datas     = BasicData::get();
        $clients         = Client::get();
        $static_clauses  = StaticClause::get();
        $dynamic_clauses = DynamicClause::get();

        return view('admin.contracts.index', compact('basic_datas', 'clients', 'static_clauses', 'dynamic_clauses'));
    }

    public function create()
    {
        abort_if(Gate::denies('contract_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BasicData::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $static_clauses = StaticClause::pluck('title', 'id');

        $dynamic_clauses = DynamicClause::pluck('title', 'id');

        return view('admin.contracts.create', compact('clients', 'dynamic_clauses', 'froms', 'static_clauses'));
    }

    public function store(StoreContractRequest $request)
    {
        $contract = Contract::create($request->all());
        $contract->static_clauses()->sync($request->input('static_clauses', []));
        $contract->dynamic_clauses()->sync($request->input('dynamic_clauses', []));

        return redirect()->route('admin.contracts.index');
    }

    public function edit(Contract $contract)
    {
        abort_if(Gate::denies('contract_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BasicData::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $static_clauses = StaticClause::pluck('title', 'id');

        $dynamic_clauses = DynamicClause::pluck('title', 'id');

        $contract->load('from', 'client', 'static_clauses', 'dynamic_clauses');

        return view('admin.contracts.edit', compact('clients', 'contract', 'dynamic_clauses', 'froms', 'static_clauses'));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update($request->all());
        $contract->static_clauses()->sync($request->input('static_clauses', []));
        $contract->dynamic_clauses()->sync($request->input('dynamic_clauses', []));

        return redirect()->route('admin.contracts.index');
    }

    public function show(Contract $contract)
    {
        abort_if(Gate::denies('contract_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->load('from', 'client', 'static_clauses', 'dynamic_clauses');

        return view('admin.contracts.show', compact('contract'));
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
