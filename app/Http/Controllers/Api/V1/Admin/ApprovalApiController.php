<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreApprovalRequest;
use App\Http\Requests\UpdateApprovalRequest;
use App\Http\Resources\Admin\ApprovalResource;
use App\Models\Approval;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovalApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApprovalResource(Approval::with(['client', 'quotation'])->get());
    }

    public function store(StoreApprovalRequest $request)
    {
        $approval = Approval::create($request->all());

        if ($request->input('signature', false)) {
            $approval->addMedia(storage_path('tmp/uploads/' . basename($request->input('signature'))))->toMediaCollection('signature');
        }

        return (new ApprovalResource($approval))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Approval $approval)
    {
        abort_if(Gate::denies('approval_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApprovalResource($approval->load(['client', 'quotation']));
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

        return (new ApprovalResource($approval))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Approval $approval)
    {
        abort_if(Gate::denies('approval_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approval->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
