<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyManagementRequest;
use App\Http\Requests\StoreManagementRequest;
use App\Http\Requests\UpdateManagementRequest;
use App\Models\Management;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ManagementController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managements = Management::with(['lead'])->get();

        $users = User::get();

        return view('frontend.managements.index', compact('managements', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leads = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.managements.create', compact('leads'));
    }

    public function store(StoreManagementRequest $request)
    {
        $management = Management::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $management->id]);
        }

        return redirect()->route('frontend.managements.index');
    }

    public function edit(Management $management)
    {
        abort_if(Gate::denies('management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leads = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $management->load('lead');

        return view('frontend.managements.edit', compact('leads', 'management'));
    }

    public function update(UpdateManagementRequest $request, Management $management)
    {
        $management->update($request->all());

        return redirect()->route('frontend.managements.index');
    }

    public function show(Management $management)
    {
        abort_if(Gate::denies('management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $management->load('lead');

        return view('frontend.managements.show', compact('management'));
    }

    public function destroy(Management $management)
    {
        abort_if(Gate::denies('management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $management->delete();

        return back();
    }

    public function massDestroy(MassDestroyManagementRequest $request)
    {
        Management::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('management_create') && Gate::denies('management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Management();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
