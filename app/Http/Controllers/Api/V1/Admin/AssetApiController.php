<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Http\Resources\Admin\AssetResource;
use App\Models\Asset;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetResource(Asset::all());
    }

    public function store(StoreAssetRequest $request)
    {
        $asset = Asset::create($request->all());

        if ($request->input('front_photo', false)) {
            $asset->addMedia(storage_path('tmp/uploads/' . basename($request->input('front_photo'))))->toMediaCollection('front_photo');
        }

        if ($request->input('side_photo', false)) {
            $asset->addMedia(storage_path('tmp/uploads/' . basename($request->input('side_photo'))))->toMediaCollection('side_photo');
        }

        if ($request->input('quarter_photo', false)) {
            $asset->addMedia(storage_path('tmp/uploads/' . basename($request->input('quarter_photo'))))->toMediaCollection('quarter_photo');
        }

        if ($request->input('invoice', false)) {
            $asset->addMedia(storage_path('tmp/uploads/' . basename($request->input('invoice'))))->toMediaCollection('invoice');
        }

        return (new AssetResource($asset))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Asset $asset)
    {
        abort_if(Gate::denies('asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetResource($asset);
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->all());

        if ($request->input('front_photo', false)) {
            if (!$asset->front_photo || $request->input('front_photo') !== $asset->front_photo->file_name) {
                if ($asset->front_photo) {
                    $asset->front_photo->delete();
                }
                $asset->addMedia(storage_path('tmp/uploads/' . basename($request->input('front_photo'))))->toMediaCollection('front_photo');
            }
        } elseif ($asset->front_photo) {
            $asset->front_photo->delete();
        }

        if ($request->input('side_photo', false)) {
            if (!$asset->side_photo || $request->input('side_photo') !== $asset->side_photo->file_name) {
                if ($asset->side_photo) {
                    $asset->side_photo->delete();
                }
                $asset->addMedia(storage_path('tmp/uploads/' . basename($request->input('side_photo'))))->toMediaCollection('side_photo');
            }
        } elseif ($asset->side_photo) {
            $asset->side_photo->delete();
        }

        if ($request->input('quarter_photo', false)) {
            if (!$asset->quarter_photo || $request->input('quarter_photo') !== $asset->quarter_photo->file_name) {
                if ($asset->quarter_photo) {
                    $asset->quarter_photo->delete();
                }
                $asset->addMedia(storage_path('tmp/uploads/' . basename($request->input('quarter_photo'))))->toMediaCollection('quarter_photo');
            }
        } elseif ($asset->quarter_photo) {
            $asset->quarter_photo->delete();
        }

        if ($request->input('invoice', false)) {
            if (!$asset->invoice || $request->input('invoice') !== $asset->invoice->file_name) {
                if ($asset->invoice) {
                    $asset->invoice->delete();
                }
                $asset->addMedia(storage_path('tmp/uploads/' . basename($request->input('invoice'))))->toMediaCollection('invoice');
            }
        } elseif ($asset->invoice) {
            $asset->invoice->delete();
        }

        return (new AssetResource($asset))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Asset $asset)
    {
        abort_if(Gate::denies('asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
