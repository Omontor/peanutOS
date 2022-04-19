<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ManagementController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Management::with(['lead'])->select(sprintf('%s.*', (new Management())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'management_show';
                $editGate = 'management_edit';
                $deleteGate = 'management_delete';
                $crudRoutePart = 'management';

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
            $table->addColumn('lead_name', function ($row) {
                return $row->lead ? $row->lead->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lead']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.management.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leads = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.management.create', compact('leads'));
    }

    public function store(StoreManagementRequest $request)
    {
        $management = Management::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $management->id]);
        }

        return redirect()->route('admin.management.index');
    }

    public function edit(Management $management)
    {
        abort_if(Gate::denies('management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leads = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $management->load('lead');

        return view('admin.management.edit', compact('leads', 'management'));
    }

    public function update(UpdateManagementRequest $request, Management $management)
    {
        $management->update($request->all());

        return redirect()->route('admin.management.index');
    }

    public function show(Management $management)
    {
        abort_if(Gate::denies('management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $management->load('lead');

        return view('admin.management.show', compact('management'));
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
