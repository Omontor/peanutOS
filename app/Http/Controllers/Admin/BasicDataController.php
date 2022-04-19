<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BasicDataController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('basic_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BasicData::query()->select(sprintf('%s.*', (new BasicData())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'basic_data_show';
                $editGate = 'basic_data_edit';
                $deleteGate = 'basic_data_delete';
                $crudRoutePart = 'basic-datas';

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
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('rfc', function ($row) {
                return $row->rfc ? $row->rfc : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        return view('admin.basicDatas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('basic_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.basicDatas.create');
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

        return redirect()->route('admin.basic-datas.index');
    }

    public function edit(BasicData $basicData)
    {
        abort_if(Gate::denies('basic_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.basicDatas.edit', compact('basicData'));
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

        return redirect()->route('admin.basic-datas.index');
    }

    public function show(BasicData $basicData)
    {
        abort_if(Gate::denies('basic_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $basicData->load('fromContracts');

        return view('admin.basicDatas.show', compact('basicData'));
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
