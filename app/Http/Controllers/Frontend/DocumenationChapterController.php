<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDocumenationChapterRequest;
use App\Http\Requests\StoreDocumenationChapterRequest;
use App\Http\Requests\UpdateDocumenationChapterRequest;
use App\Models\DocumenationChapter;
use App\Models\ProjectDocumentation;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DocumenationChapterController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('documenation_chapter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documenationChapters = DocumenationChapter::with(['project_documentation'])->get();

        return view('frontend.documenationChapters.index', compact('documenationChapters'));
    }

    public function create()
    {
        abort_if(Gate::denies('documenation_chapter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project_documentations = ProjectDocumentation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.documenationChapters.create', compact('project_documentations'));
    }

    public function store(StoreDocumenationChapterRequest $request)
    {
        $documenationChapter = DocumenationChapter::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $documenationChapter->id]);
        }

        return redirect()->route('frontend.documenation-chapters.index');
    }

    public function edit(DocumenationChapter $documenationChapter)
    {
        abort_if(Gate::denies('documenation_chapter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project_documentations = ProjectDocumentation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $documenationChapter->load('project_documentation');

        return view('frontend.documenationChapters.edit', compact('documenationChapter', 'project_documentations'));
    }

    public function update(UpdateDocumenationChapterRequest $request, DocumenationChapter $documenationChapter)
    {
        $documenationChapter->update($request->all());

        return redirect()->route('frontend.documenation-chapters.index');
    }

    public function show(DocumenationChapter $documenationChapter)
    {
        abort_if(Gate::denies('documenation_chapter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documenationChapter->load('project_documentation', 'chapterChapterContents');

        return view('frontend.documenationChapters.show', compact('documenationChapter'));
    }

    public function destroy(DocumenationChapter $documenationChapter)
    {
        abort_if(Gate::denies('documenation_chapter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documenationChapter->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumenationChapterRequest $request)
    {
        DocumenationChapter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('documenation_chapter_create') && Gate::denies('documenation_chapter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DocumenationChapter();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
