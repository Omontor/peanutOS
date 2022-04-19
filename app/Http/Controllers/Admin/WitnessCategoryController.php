<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWitnessCategoryRequest;
use App\Http\Requests\StoreWitnessCategoryRequest;
use App\Http\Requests\UpdateWitnessCategoryRequest;
use App\Models\WitnessCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WitnessCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('witness_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WitnessCategory::query()->select(sprintf('%s.*', (new WitnessCategory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'witness_category_show';
                $editGate = 'witness_category_edit';
                $deleteGate = 'witness_category_delete';
                $crudRoutePart = 'witness-categories';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.witnessCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('witness_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.witnessCategories.create');
    }

    public function store(StoreWitnessCategoryRequest $request)
    {
        $witnessCategory = WitnessCategory::create($request->all());

        return redirect()->route('admin.witness-categories.index');
    }

    public function edit(WitnessCategory $witnessCategory)
    {
        abort_if(Gate::denies('witness_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.witnessCategories.edit', compact('witnessCategory'));
    }

    public function update(UpdateWitnessCategoryRequest $request, WitnessCategory $witnessCategory)
    {
        $witnessCategory->update($request->all());

        return redirect()->route('admin.witness-categories.index');
    }

    public function show(WitnessCategory $witnessCategory)
    {
        abort_if(Gate::denies('witness_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $witnessCategory->load('typeEventWitnesses');

        return view('admin.witnessCategories.show', compact('witnessCategory'));
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
