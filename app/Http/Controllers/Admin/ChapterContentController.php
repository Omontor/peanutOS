<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyChapterContentRequest;
use App\Http\Requests\StoreChapterContentRequest;
use App\Http\Requests\UpdateChapterContentRequest;
use App\Models\ChapterContent;
use App\Models\DocumenationChapter;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ChapterContentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('chapter_content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapterContents = ChapterContent::with(['chapter'])->get();

        return view('admin.chapterContents.index', compact('chapterContents'));
    }

    public function create()
    {
        abort_if(Gate::denies('chapter_content_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapters = DocumenationChapter::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.chapterContents.create', compact('chapters'));
    }

    public function store(StoreChapterContentRequest $request)
    {
        $chapterContent = ChapterContent::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $chapterContent->id]);
        }

        return redirect()->route('admin.chapter-contents.index');
    }

    public function edit(ChapterContent $chapterContent)
    {
        abort_if(Gate::denies('chapter_content_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapters = DocumenationChapter::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $chapterContent->load('chapter');

        return view('admin.chapterContents.edit', compact('chapterContent', 'chapters'));
    }

    public function update(UpdateChapterContentRequest $request, ChapterContent $chapterContent)
    {
        $chapterContent->update($request->all());

        return redirect()->route('admin.chapter-contents.index');
    }

    public function show(ChapterContent $chapterContent)
    {
        abort_if(Gate::denies('chapter_content_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapterContent->load('chapter');

        return view('admin.chapterContents.show', compact('chapterContent'));
    }

    public function destroy(ChapterContent $chapterContent)
    {
        abort_if(Gate::denies('chapter_content_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapterContent->delete();

        return back();
    }

    public function massDestroy(MassDestroyChapterContentRequest $request)
    {
        ChapterContent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('chapter_content_create') && Gate::denies('chapter_content_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ChapterContent();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
