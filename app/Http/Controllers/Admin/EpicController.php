<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class EpicController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('epic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Epic::with(['asignees', 'reporter', 'status'])->select(sprintf('%s.*', (new Epic())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'epic_show';
                $editGate = 'epic_edit';
                $deleteGate = 'epic_delete';
                $crudRoutePart = 'epics';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('asignees', function ($row) {
                $labels = [];
                foreach ($row->asignees as $asignee) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $asignee->name);
                }

                return implode(' ', $labels);
            });

            $table->addColumn('reporter_name', function ($row) {
                return $row->reporter ? $row->reporter->name : '';
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'asignees', 'reporter', 'status']);

            return $table->make(true);
        }

        $users         = User::get();
        $epic_statuses = EpicStatus::get();

        return view('admin.epics.index', compact('users', 'epic_statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('epic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignees = User::all()->pluck('name', 'id');

        $reporters = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = EpicStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.epics.create', compact('asignees', 'reporters', 'statuses'));
    }

    public function store(StoreEpicRequest $request)
    {
        $epic = Epic::create($request->all());
        $epic->asignees()->sync($request->input('asignees', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $epic->id]);
        }

        return redirect()->route('admin.epics.index');
    }

    public function edit(Epic $epic)
    {
        abort_if(Gate::denies('epic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignees = User::all()->pluck('name', 'id');

        $reporters = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = EpicStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $epic->load('asignees', 'reporter', 'status');

        return view('admin.epics.edit', compact('asignees', 'reporters', 'statuses', 'epic'));
    }

    public function update(UpdateEpicRequest $request, Epic $epic)
    {
        $epic->update($request->all());
        $epic->asignees()->sync($request->input('asignees', []));

        return redirect()->route('admin.epics.index');
    }

    public function show(Epic $epic)
    {
        abort_if(Gate::denies('epic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $epic->load('asignees', 'reporter', 'status');

        return view('admin.epics.show', compact('epic'));
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
