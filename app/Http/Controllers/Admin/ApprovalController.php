<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyApprovalRequest;
use App\Http\Requests\StoreApprovalRequest;
use App\Http\Requests\UpdateApprovalRequest;
use App\Models\Approval;
use App\Models\Quotation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ApprovalController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Approval::with(['client', 'quotation'])->select(sprintf('%s.*', (new Approval())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'approval_show';
                $editGate = 'approval_edit';
                $deleteGate = 'approval_delete';
                $crudRoutePart = 'approvals';

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
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('quotation_title', function ($row) {
                return $row->quotation ? $row->quotation->title : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('signature', function ($row) {
                if ($photo = $row->signature) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'quotation', 'signature']);

            return $table->make(true);
        }

        $users      = User::get();
        $quotations = Quotation::get();

        return view('admin.approvals.index', compact('users', 'quotations'));
    }

    public function create()
    {
        abort_if(Gate::denies('approval_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quotations = Quotation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.approvals.create', compact('clients', 'quotations'));
    }

    public function store(StoreApprovalRequest $request)
    {
        $approval = Approval::create($request->all());

        if ($request->input('signature', false)) {
            $approval->addMedia(storage_path('tmp/uploads/' . basename($request->input('signature'))))->toMediaCollection('signature');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $approval->id]);
        }

        return redirect()->route('admin.approvals.index');
    }

    public function edit(Approval $approval)
    {
        abort_if(Gate::denies('approval_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quotations = Quotation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approval->load('client', 'quotation');

        return view('admin.approvals.edit', compact('approval', 'clients', 'quotations'));
    }

    public function update(UpdateApprovalRequest $request, Approval $approval)
    {
        $approval->update($request->all());

        if ($request->input('signature', false)) {
            if (!$approval->signature || $request->input('signature') !== $approval->signature->file_name) {
                if ($approval->signature) {
                    $approval->signature->delete();
                }
                $approval->addMedia(storage_path('tmp/uploads/' . basename($request->input('signature'))))->toMediaCollection('signature');
            }
        } elseif ($approval->signature) {
            $approval->signature->delete();
        }

        return redirect()->route('admin.approvals.index');
    }

    public function show(Approval $approval)
    {
        abort_if(Gate::denies('approval_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approval->load('client', 'quotation');

        return view('admin.approvals.show', compact('approval'));
    }

    public function destroy(Approval $approval)
    {
        abort_if(Gate::denies('approval_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approval->delete();

        return back();
    }

    public function massDestroy(MassDestroyApprovalRequest $request)
    {
        Approval::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('approval_create') && Gate::denies('approval_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Approval();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
