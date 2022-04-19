<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBasicDataRequest;
use App\Http\Requests\StoreBasicDataRequest;
use App\Http\Requests\UpdateBasicDataRequest;
use App\Models\BasicData;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BasicDataController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('basic_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $basicDatas = BasicData::with(['media'])->get();

        return view('frontend.basicDatas.index', compact('basicDatas'));
    }

    public function create()
    {
        abort_if(Gate::denies('basic_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.basicDatas.create');
    }

    public function store(StoreBasicDataRequest $request)
    {
        $basicData = BasicData::create($request->all());

        if ($request->input('image', false)) {
            $basicData->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $basicData->id]);
        }

        return redirect()->route('frontend.basic-datas.index');
    }

    public function edit(BasicData $basicData)
    {
        abort_if(Gate::denies('basic_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.basicDatas.edit', compact('basicData'));
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

        return redirect()->route('frontend.basic-datas.index');
    }

    public function show(BasicData $basicData)
    {
        abort_if(Gate::denies('basic_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $basicData->load('fromContracts');

        return view('frontend.basicDatas.show', compact('basicData'));
    }

    public function destroy(BasicData $basicData)
    {
        abort_if(Gate::denies('basic_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $basicData->delete();

        return back();
    }

    public function massDestroy(MassDestroyBasicDataRequest $request)
    {
        BasicData::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('basic_data_create') && Gate::denies('basic_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BasicData();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
