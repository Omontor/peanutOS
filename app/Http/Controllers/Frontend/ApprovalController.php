<?php

namespace App\Http\Controllers\Frontend;

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

class ApprovalController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approvals = Approval::with(['client', 'quotation', 'media'])->get();

        $users = User::get();

        $quotations = Quotation::get();

        return view('frontend.approvals.index', compact('approvals', 'quotations', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('approval_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quotations = Quotation::pluck('total', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.approvals.create', compact('clients', 'quotations'));
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

        return redirect()->route('frontend.approvals.index');
    }

    public function edit(Approval $approval)
    {
        abort_if(Gate::denies('approval_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quotations = Quotation::pluck('total', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approval->load('client', 'quotation');

        return view('frontend.approvals.edit', compact('approval', 'clients', 'quotations'));
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

        return redirect()->route('frontend.approvals.index');
    }

    public function show(Approval $approval)
    {
        abort_if(Gate::denies('approval_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approval->load('client', 'quotation');

        return view('frontend.approvals.show', compact('approval'));
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
