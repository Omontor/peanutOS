<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBasicDataRequest;
use App\Http\Requests\UpdateBasicDataRequest;
use App\Http\Resources\Admin\BasicDataResource;
use App\Models\BasicData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicDataApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('basic_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BasicDataResource(BasicData::all());
    }

    public function store(StoreBasicDataRequest $request)
    {
        $basicData = BasicData::create($request->all());

        if ($request->input('image', false)) {
            $basicData->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new BasicDataResource($basicData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BasicData $basicData)
    {
        abort_if(Gate::denies('basic_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BasicDataResource($basicData);
    }

    public function update(UpdateBasicDataRequest $request, BasicData $basicData)
    {
        $basicData->update($request->all());

        if ($request->input('image', false)) {
            if (!$basicData->image || $request->input('image') !== $basicData->image->file_name) {
                if ($basicData->image) {
                    $basicData->image->delete();
                }
                $basicData->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($basicData->image) {
            $basicData->image->delete();
        }

        return (new BasicDataResource($basicData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BasicData $basicData)
    {
        abort_if(Gate::denies('basic_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $basicData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
