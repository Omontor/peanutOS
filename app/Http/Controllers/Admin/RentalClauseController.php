<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRentalClauseRequest;
use App\Http\Requests\StoreRentalClauseRequest;
use App\Http\Requests\UpdateRentalClauseRequest;
use App\Models\RentalClause;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RentalClauseController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('rental_clause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RentalClause::query()->select(sprintf('%s.*', (new RentalClause())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rental_clause_show';
                $editGate = 'rental_clause_edit';
                $deleteGate = 'rental_clause_delete';
                $crudRoutePart = 'rental-clauses';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.rentalClauses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('rental_clause_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rentalClauses.create');
    }

    public function store(StoreRentalClauseRequest $request)
    {
        $rentalClause = RentalClause::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $rentalClause->id]);
        }

        return redirect()->route('admin.rental-clauses.index');
    }

    public function edit(RentalClause $rentalClause)
    {
        abort_if(Gate::denies('rental_clause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rentalClauses.edit', compact('rentalClause'));
    }

    public function update(UpdateRentalClauseRequest $request, RentalClause $rentalClause)
    {
        $rentalClause->update($request->all());

        return redirect()->route('admin.rental-clauses.index');
    }

    public function show(RentalClause $rentalClause)
    {
        abort_if(Gate::denies('rental_clause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rentalClause->load('clausesQuotations');

        return view('admin.rentalClauses.show', compact('rentalClause'));
    }

    public function destroy(RentalClause $rentalClause)
    {
        abort_if(Gate::denies('rental_clause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rentalClause->delete();

        return back();
    }

    public function massDestroy(MassDestroyRentalClauseRequest $request)
    {
        RentalClause::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('rental_clause_create') && Gate::denies('rental_clause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RentalClause();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
