<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProjectStoryRequest;
use App\Http\Requests\StoreProjectStoryRequest;
use App\Http\Requests\UpdateProjectStoryRequest;
use App\Models\Project;
use App\Models\ProjectStory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProjectStoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('project_story_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projectStories = ProjectStory::with(['project', 'media'])->get();

        return view('admin.projectStories.index', compact('projectStories'));
    }

    public function create()
    {
        abort_if(Gate::denies('project_story_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.projectStories.create', compact('projects'));
    }

    public function store(StoreProjectStoryRequest $request)
    {
        $projectStory = ProjectStory::create($request->all());

        foreach ($request->input('gallery', []) as $file) {
            $projectStory->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
        }

        if ($request->input('thumb_image', false)) {
            $projectStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb_image'))))->toMediaCollection('thumb_image');
        }

        if ($request->input('bg_image', false)) {
            $projectStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('bg_image'))))->toMediaCollection('bg_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $projectStory->id]);
        }

        return redirect()->route('admin.project-stories.index');
    }

    public function edit(ProjectStory $projectStory)
    {
        abort_if(Gate::denies('project_story_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projectStory->load('project');

        return view('admin.projectStories.edit', compact('projectStory', 'projects'));
    }

    public function update(UpdateProjectStoryRequest $request, ProjectStory $projectStory)
    {
        $projectStory->update($request->all());

        if (count($projectStory->gallery) > 0) {
            foreach ($projectStory->gallery as $media) {
                if (!in_array($media->file_name, $request->input('gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $projectStory->gallery->pluck('file_name')->toArray();
        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $projectStory->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
            }
        }

        if ($request->input('thumb_image', false)) {
            if (!$projectStory->thumb_image || $request->input('thumb_image') !== $projectStory->thumb_image->file_name) {
                if ($projectStory->thumb_image) {
                    $projectStory->thumb_image->delete();
                }
                $projectStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb_image'))))->toMediaCollection('thumb_image');
            }
        } elseif ($projectStory->thumb_image) {
            $projectStory->thumb_image->delete();
        }

        if ($request->input('bg_image', false)) {
            if (!$projectStory->bg_image || $request->input('bg_image') !== $projectStory->bg_image->file_name) {
                if ($projectStory->bg_image) {
                    $projectStory->bg_image->delete();
                }
                $projectStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('bg_image'))))->toMediaCollection('bg_image');
            }
        } elseif ($projectStory->bg_image) {
            $projectStory->bg_image->delete();
        }

        return redirect()->route('admin.project-stories.index');
    }

    public function show(ProjectStory $projectStory)
    {
        abort_if(Gate::denies('project_story_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projectStory->load('project');

        return view('admin.projectStories.show', compact('projectStory'));
    }

    public function destroy(ProjectStory $projectStory)
    {
        abort_if(Gate::denies('project_story_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projectStory->delete();

        return back();
    }

    public function massDestroy(MassDestroyProjectStoryRequest $request)
    {
        ProjectStory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('project_story_create') && Gate::denies('project_story_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProjectStory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
