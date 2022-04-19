<?php

namespace App\Http\Controllers\Frontend;

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

class QuotationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('quotation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quotations = Quotation::with(['client', 'assets', 'clauses'])->get();

        $users = User::get();

        $assets = Asset::get();

        $rental_clauses = RentalClause::get();

        return view('frontend.quotations.index', compact('assets', 'quotations', 'rental_clauses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('quotation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::pluck('name', 'id');

        $clauses = RentalClause::pluck('title', 'id');

        return view('frontend.quotations.create', compact('assets', 'clauses', 'clients'));
    }

    public function store(StoreQuotationRequest $request)
    {
        $quotation = Quotation::create($request->all());
        $quotation->assets()->sync($request->input('assets', []));
        $quotation->clauses()->sync($request->input('clauses', []));

        return redirect()->route('frontend.quotations.index');
    }

    public function edit(Quotation $quotation)
    {
        abort_if(Gate::denies('quotation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::pluck('name', 'id');

        $clauses = RentalClause::pluck('title', 'id');

        $quotation->load('client', 'assets', 'clauses');

        return view('frontend.quotations.edit', compact('assets', 'clauses', 'clients', 'quotation'));
    }

    public function update(UpdateQuotationRequest $request, Quotation $quotation)
    {
        $quotation->update($request->all());
        $quotation->assets()->sync($request->input('assets', []));
        $quotation->clauses()->sync($request->input('clauses', []));

        return redirect()->route('frontend.quotations.index');
    }

    public function show(Quotation $quotation)
    {
        abort_if(Gate::denies('quotation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quotation->load('client', 'assets', 'clauses', 'quotationRents');

        return view('frontend.quotations.show', compact('quotation'));
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
