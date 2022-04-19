<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEpicRequest;
use App\Http\Requests\StoreEpicRequest;
use App\Http\Requests\UpdateEpicRequest;
use App\Models\Epic;
use App\Models\EpicStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EpicController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('epic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epics = Epic::with(['asignees', 'reporter', 'status'])->get();

        $users = User::get();

        $epic_statuses = EpicStatus::get();

        return view('frontend.epics.index', compact('epic_statuses', 'epics', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('epic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignees = User::pluck('name', 'id');

        $reporters = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = EpicStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.epics.create', compact('asignees', 'reporters', 'statuses'));
    }

    public function store(StoreEpicRequest $request)
    {
        $epic = Epic::create($request->all());
        $epic->asignees()->sync($request->input('asignees', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $epic->id]);
        }

        return redirect()->route('frontend.epics.index');
    }

    public function edit(Epic $epic)
    {
        abort_if(Gate::denies('epic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignees = User::pluck('name', 'id');

        $reporters = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = EpicStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $epic->load('asignees', 'reporter', 'status');

        return view('frontend.epics.edit', compact('asignees', 'epic', 'reporters', 'statuses'));
    }

    public function update(UpdateEpicRequest $request, Epic $epic)
    {
        $epic->update($request->all());
        $epic->asignees()->sync($request->input('asignees', []));

        return redirect()->route('frontend.epics.index');
    }

    public function show(Epic $epic)
    {
        abort_if(Gate::denies('epic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epic->load('asignees', 'reporter', 'status');

        return view('frontend.epics.show', compact('epic'));
    }

    public function destroy(Epic $epic)
    {
        abort_if(Gate::denies('epic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epic->delete();

        return back();
    }

    public function massDestroy(MassDestroyEpicRequest $request)
    {
        Epic::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('epic_create') && Gate::denies('epic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Epic();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
