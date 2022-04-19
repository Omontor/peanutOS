<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssetRequest;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('asset_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Asset::query()->select(sprintf('%s.*', (new Asset())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'asset_show';
                $editGate = 'asset_edit';
                $deleteGate = 'asset_delete';
                $crudRoutePart = 'assets';

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
            $table->editColumn('serial_number', function ($row) {
                return $row->serial_number ? $row->serial_number : '';
            });
            $table->editColumn('front_photo', function ($row) {
                if ($photo = $row->front_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('side_photo', function ($row) {
                if ($photo = $row->side_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('quarter_photo', function ($row) {
                if ($photo = $row->quarter_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('invoice', function ($row) {
                return $row->invoice ? '<a href="' . $row->invoice->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('cost', function ($row) {
                return $row->cost ? $row->cost : '';
            });
            $table->editColumn('day_price', function ($row) {
                return $row->day_price ? $row->day_price : '';
            });
            $table->editColumn('week_price', function ($row) {
                return $row->week_price ? $row->week_price : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'front_photo', 'side_photo', 'quarter_photo', 'invoice']);

            return $table->make(true);
        }

        return view('admin.assets.index');
    }

    public function create()
    {
        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assets.create');
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $asset->id]);
        }

        return redirect()->route('admin.assets.index');
    }

    public function edit(Asset $asset)
    {
        abort_if(Gate::denies('asset_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assets.edit', compact('asset'));
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

        return redirect()->route('admin.assets.index');
    }

    public function show(Asset $asset)
    {
        abort_if(Gate::denies('asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->load('assetRents');

        return view('admin.assets.show', compact('asset'));
    }

    public function destroy(Asset $asset)
    {
        abort_if(Gate::denies('asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetRequest $request)
    {
        Asset::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('asset_create') && Gate::denies('asset_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Asset();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
