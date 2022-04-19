<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProjectDocumentationRequest;
use App\Http\Requests\StoreProjectDocumentationRequest;
use App\Http\Requests\UpdateProjectDocumentationRequest;
use App\Models\Project;
use App\Models\ProjectDocumentation;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProjectDocumentationController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('project_documentation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projectDocumentations = ProjectDocumentation::with(['project'])->get();

        return view('frontend.projectDocumentations.index', compact('projectDocumentations'));
    }

    public function create()
    {
        abort_if(Gate::denies('project_documentation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.projectDocumentations.create', compact('projects'));
    }

    public function store(StoreProjectDocumentationRequest $request)
    {
        $projectDocumentation = ProjectDocumentation::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $projectDocumentation->id]);
        }

        return redirect()->route('frontend.project-documentations.index');
    }

    public function edit(ProjectDocumentation $projectDocumentation)
    {
        abort_if(Gate::denies('project_documentation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projectDocumentation->load('project');

        return view('frontend.projectDocumentations.edit', compact('projectDocumentation', 'projects'));
    }

    public function update(UpdateProjectDocumentationRequest $request, ProjectDocumentation $projectDocumentation)
    {
        $projectDocumentation->update($request->all());

        return redirect()->route('frontend.project-documentations.index');
    }

    public function show(ProjectDocumentation $projectDocumentation)
    {
        abort_if(Gate::denies('project_documentation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projectDocumentation->load('project');

        return view('frontend.projectDocumentations.show', compact('projectDocumentation'));
    }

    public function destroy(ProjectDocumentation $projectDocumentation)
    {
        abort_if(Gate::denies('project_documentation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projectDocumentation->delete();

        return back();
    }

    public function massDestroy(MassDestroyProjectDocumentationRequest $request)
    {
        ProjectDocumentation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('project_documentation_create') && Gate::denies('project_documentation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProjectDocumentation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
