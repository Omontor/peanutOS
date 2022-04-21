<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssetReturnRequest;
use App\Http\Requests\StoreAssetReturnRequest;
use App\Http\Requests\UpdateAssetReturnRequest;
use App\Models\AssetReturn;
use App\Models\Rent;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AssetReturnController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_return_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetReturns = AssetReturn::with(['rent', 'team', 'media'])->get();

        return view('frontend.assetReturns.index', compact('assetReturns'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_return_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rents = Rent::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.assetReturns.create', compact('rents'));
    }

    public function store(StoreAssetReturnRequest $request)
    {
        $assetReturn = AssetReturn::create($request->all());

        foreach ($request->input('witness', []) as $file) {
            $assetReturn->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('witness');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $assetReturn->id]);
        }

        return redirect()->route('frontend.asset-returns.index');
    }

    public function edit(AssetReturn $assetReturn)
    {
        abort_if(Gate::denies('asset_return_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rents = Rent::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assetReturn->load('rent', 'team');

        return view('frontend.assetReturns.edit', compact('assetReturn', 'rents'));
    }

    public function update(UpdateAssetReturnRequest $request, AssetReturn $assetReturn)
    {
        $assetReturn->update($request->all());

        if (count($assetReturn->witness) > 0) {
            foreach ($assetReturn->witness as $media) {
                if (!in_array($media->file_name, $request->input('witness', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assetReturn->witness->pluck('file_name')->toArray();
        foreach ($request->input('witness', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assetReturn->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('witness');
            }
        }

        return redirect()->route('frontend.asset-returns.index');
    }

    public function show(AssetReturn $assetReturn)
    {
        abort_if(Gate::denies('asset_return_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetReturn->load('rent', 'team');

        return view('frontend.assetReturns.show', compact('assetReturn'));
    }

    public function destroy(AssetReturn $assetReturn)
    {
        abort_if(Gate::denies('asset_return_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetReturn->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetReturnRequest $request)
    {
        AssetReturn::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('asset_return_create') && Gate::denies('asset_return_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AssetReturn();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
