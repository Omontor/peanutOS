<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQuotationRequest;
use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;
use App\Models\Asset;
use App\Models\Quotation;
use App\Models\RentalClause;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('quotation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Quotation::with(['client', 'assets', 'clauses'])->select(sprintf('%s.*', (new Quotation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'quotation_show';
                $editGate = 'quotation_edit';
                $deleteGate = 'quotation_delete';
                $crudRoutePart = 'quotations';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.email', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->email) : '';
            });
            $table->editColumn('assets', function ($row) {
                $labels = [];
                foreach ($row->assets as $asset) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $asset->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });
            $table->editColumn('clauses', function ($row) {
                $labels = [];
                foreach ($row->clauses as $clause) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $clause->title);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('validity', function ($row) {
                return $row->validity ? $row->validity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'assets', 'clauses']);

            return $table->make(true);
        }

        $users          = User::get();
        $assets         = Asset::get();
        $rental_clauses = RentalClause::get();

        return view('admin.quotations.index', compact('users', 'assets', 'rental_clauses'));
    }

    public function create()
    {
        abort_if(Gate::denies('quotation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::pluck('name', 'id');

        $clauses = RentalClause::pluck('title', 'id');

        return view('admin.quotations.create', compact('assets', 'clauses', 'clients'));
    }

    public function store(StoreQuotationRequest $request)
    {
        $quotation = Quotation::create($request->all());
        $quotation->assets()->sync($request->input('assets', []));
        $quotation->clauses()->sync($request->input('clauses', []));

        return redirect()->route('admin.quotations.index');
    }

    public function edit(Quotation $quotation)
    {
        abort_if(Gate::denies('quotation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::pluck('name', 'id');

        $clauses = RentalClause::pluck('title', 'id');

        $quotation->load('client', 'assets', 'clauses');

        return view('admin.quotations.edit', compact('assets', 'clauses', 'clients', 'quotation'));
    }

    public function update(UpdateQuotationRequest $request, Quotation $quotation)
    {
        $quotation->update($request->all());
        $quotation->assets()->sync($request->input('assets', []));
        $quotation->clauses()->sync($request->input('clauses', []));

        return redirect()->route('admin.quotations.index');
    }

    public function show(Quotation $quotation)
    {
        abort_if(Gate::denies('quotation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quotation->load('client', 'assets', 'clauses', 'quotationRents');

        return view('admin.quotations.show', compact('quotation'));
    }

    public function destroy(Quotation $quotation)
    {
        abort_if(Gate::denies('quotation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quotation->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuotationRequest $request)
    {
        Quotation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
