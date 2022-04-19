<?php

namespace App\Http\Controllers\Frontend;

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

class RentalClauseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('rental_clause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rentalClauses = RentalClause::all();

        return view('frontend.rentalClauses.index', compact('rentalClauses'));
    }

    public function create()
    {
        abort_if(Gate::denies('rental_clause_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.rentalClauses.create');
    }

    public function store(StoreRentalClauseRequest $request)
    {
        $rentalClause = RentalClause::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $rentalClause->id]);
        }

        return redirect()->route('frontend.rental-clauses.index');
    }

    public function edit(RentalClause $rentalClause)
    {
        abort_if(Gate::denies('rental_clause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.rentalClauses.edit', compact('rentalClause'));
    }

    public function update(UpdateRentalClauseRequest $request, RentalClause $rentalClause)
    {
        $rentalClause->update($request->all());

        return redirect()->route('frontend.rental-clauses.index');
    }

    public function show(RentalClause $rentalClause)
    {
        abort_if(Gate::denies('rental_clause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rentalClause->load('clausesQuotations');

        return view('frontend.rentalClauses.show', compact('rentalClause'));
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
