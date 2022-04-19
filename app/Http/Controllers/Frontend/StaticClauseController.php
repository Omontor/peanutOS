<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStaticClauseRequest;
use App\Http\Requests\StoreStaticClauseRequest;
use App\Http\Requests\UpdateStaticClauseRequest;
use App\Models\StaticClause;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class StaticClauseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('static_clause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staticClauses = StaticClause::all();

        return view('frontend.staticClauses.index', compact('staticClauses'));
    }

    public function create()
    {
        abort_if(Gate::denies('static_clause_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.staticClauses.create');
    }

    public function store(StoreStaticClauseRequest $request)
    {
        $staticClause = StaticClause::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $staticClause->id]);
        }

        return redirect()->route('frontend.static-clauses.index');
    }

    public function edit(StaticClause $staticClause)
    {
        abort_if(Gate::denies('static_clause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.staticClauses.edit', compact('staticClause'));
    }

    public function update(UpdateStaticClauseRequest $request, StaticClause $staticClause)
    {
        $staticClause->update($request->all());

        return redirect()->route('frontend.static-clauses.index');
    }

    public function show(StaticClause $staticClause)
    {
        abort_if(Gate::denies('static_clause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.staticClauses.show', compact('staticClause'));
    }

    public function destroy(StaticClause $staticClause)
    {
        abort_if(Gate::denies('static_clause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staticClause->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaticClauseRequest $request)
    {
        StaticClause::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('static_clause_create') && Gate::denies('static_clause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StaticClause();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
