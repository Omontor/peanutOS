<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDynamicClauseRequest;
use App\Http\Requests\StoreDynamicClauseRequest;
use App\Http\Requests\UpdateDynamicClauseRequest;
use App\Models\DynamicClause;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DynamicClauseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('dynamic_clause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dynamicClauses = DynamicClause::all();

        return view('admin.dynamicClauses.index', compact('dynamicClauses'));
    }

    public function create()
    {
        abort_if(Gate::denies('dynamic_clause_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dynamicClauses.create');
    }

    public function store(StoreDynamicClauseRequest $request)
    {
        $dynamicClause = DynamicClause::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dynamicClause->id]);
        }

        return redirect()->route('admin.dynamic-clauses.index');
    }

    public function edit(DynamicClause $dynamicClause)
    {
        abort_if(Gate::denies('dynamic_clause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dynamicClauses.edit', compact('dynamicClause'));
    }

    public function update(UpdateDynamicClauseRequest $request, DynamicClause $dynamicClause)
    {
        $dynamicClause->update($request->all());

        return redirect()->route('admin.dynamic-clauses.index');
    }

    public function show(DynamicClause $dynamicClause)
    {
        abort_if(Gate::denies('dynamic_clause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dynamicClauses.show', compact('dynamicClause'));
    }

    public function destroy(DynamicClause $dynamicClause)
    {
        abort_if(Gate::denies('dynamic_clause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dynamicClause->delete();

        return back();
    }

    public function massDestroy(MassDestroyDynamicClauseRequest $request)
    {
        DynamicClause::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('dynamic_clause_create') && Gate::denies('dynamic_clause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DynamicClause();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
