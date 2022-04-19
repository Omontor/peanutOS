<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWitnessCategoryRequest;
use App\Http\Requests\StoreWitnessCategoryRequest;
use App\Http\Requests\UpdateWitnessCategoryRequest;
use App\Models\WitnessCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WitnessCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('witness_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $witnessCategories = WitnessCategory::all();

        return view('frontend.witnessCategories.index', compact('witnessCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('witness_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.witnessCategories.create');
    }

    public function store(StoreWitnessCategoryRequest $request)
    {
        $witnessCategory = WitnessCategory::create($request->all());

        return redirect()->route('frontend.witness-categories.index');
    }

    public function edit(WitnessCategory $witnessCategory)
    {
        abort_if(Gate::denies('witness_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.witnessCategories.edit', compact('witnessCategory'));
    }

    public function update(UpdateWitnessCategoryRequest $request, WitnessCategory $witnessCategory)
    {
        $witnessCategory->update($request->all());

        return redirect()->route('frontend.witness-categories.index');
    }

    public function show(WitnessCategory $witnessCategory)
    {
        abort_if(Gate::denies('witness_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $witnessCategory->load('typeEventWitnesses');

        return view('frontend.witnessCategories.show', compact('witnessCategory'));
    }

    public function destroy(WitnessCategory $witnessCategory)
    {
        abort_if(Gate::denies('witness_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $witnessCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyWitnessCategoryRequest $request)
    {
        WitnessCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
