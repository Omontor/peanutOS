<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProjectCategoryRequest;
use App\Http\Requests\StoreProjectCategoryRequest;
use App\Http\Requests\UpdateProjectCategoryRequest;
use App\Models\ProjectCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('project_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projectCategories = ProjectCategory::all();

        return view('admin.projectCategories.index', compact('projectCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('project_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.projectCategories.create');
    }

    public function store(StoreProjectCategoryRequest $request)
    {
        $projectCategory = ProjectCategory::create($request->all());

        return redirect()->route('admin.project-categories.index');
    }

    public function edit(ProjectCategory $projectCategory)
    {
        abort_if(Gate::denies('project_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.projectCategories.edit', compact('projectCategory'));
    }

    public function update(UpdateProjectCategoryRequest $request, ProjectCategory $projectCategory)
    {
        $projectCategory->update($request->all());

        return redirect()->route('admin.project-categories.index');
    }

    public function show(ProjectCategory $projectCategory)
    {
        abort_if(Gate::denies('project_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.projectCategories.show', compact('projectCategory'));
    }

    public function destroy(ProjectCategory $projectCategory)
    {
        abort_if(Gate::denies('project_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projectCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyProjectCategoryRequest $request)
    {
        ProjectCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
