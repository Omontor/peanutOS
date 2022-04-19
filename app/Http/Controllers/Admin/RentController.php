<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRentRequest;
use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Models\Asset;
use App\Models\Quotation;
use App\Models\Rent;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RentController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('rent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Rent::with(['client', 'assets', 'quotation'])->select(sprintf('%s.*', (new Rent())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rent_show';
                $editGate = 'rent_edit';
                $deleteGate = 'rent_delete';
                $crudRoutePart = 'rents';

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

            $table->editColumn('asset', function ($row) {
                $labels = [];
                foreach ($row->assets as $asset) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $asset->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('quotation_title', function ($row) {
                return $row->quotation ? $row->quotation->title : '';
            });

            $table->editColumn('quotation.title', function ($row) {
                return $row->quotation ? (is_string($row->quotation) ? $row->quotation : $row->quotation->title) : '';
            });
            $table->editColumn('identification', function ($row) {
                if ($photo = $row->identification) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('address_proof', function ($row) {
                if ($photo = $row->address_proof) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'asset', 'quotation', 'identification', 'address_proof']);

            return $table->make(true);
        }

        $users      = User::get();
        $assets     = Asset::get();
        $quotations = Quotation::get();

        return view('admin.rents.index', compact('users', 'assets', 'quotations'));
    }

    public function create()
    {
        abort_if(Gate::denies('rent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::pluck('name', 'id');

        $quotations = Quotation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rents.create', compact('assets', 'clients', 'quotations'));
    }

    public function store(StoreRentRequest $request)
    {
        $rent = Rent::create($request->all());
        $rent->assets()->sync($request->input('assets', []));
        if ($request->input('identification', false)) {
            $rent->addMedia(storage_path('tmp/uploads/' . basename($request->input('identification'))))->toMediaCollection('identification');
        }

        if ($request->input('address_proof', false)) {
            $rent->addMedia(storage_path('tmp/uploads/' . basename($request->input('address_proof'))))->toMediaCollection('address_proof');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $rent->id]);
        }

        return redirect()->route('admin.rents.index');
    }

    public function edit(Rent $rent)
    {
        abort_if(Gate::denies('rent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::pluck('name', 'id');

        $quotations = Quotation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rent->load('client', 'assets', 'quotation');

        return view('admin.rents.edit', compact('assets', 'clients', 'quotations', 'rent'));
    }

    public function update(UpdateRentRequest $request, Rent $rent)
    {
        $rent->update($request->all());
        $rent->assets()->sync($request->input('assets', []));
        if ($request->input('identification', false)) {
            if (!$rent->identification || $request->input('identification') !== $rent->identification->file_name) {
                if ($rent->identification) {
                    $rent->identification->delete();
                }
                $rent->addMedia(storage_path('tmp/uploads/' . basename($request->input('identification'))))->toMediaCollection('identification');
            }
        } elseif ($rent->identification) {
            $rent->identification->delete();
        }

        if ($request->input('address_proof', false)) {
            if (!$rent->address_proof || $request->input('address_proof') !== $rent->address_proof->file_name) {
                if ($rent->address_proof) {
                    $rent->address_proof->delete();
                }
                $rent->addMedia(storage_path('tmp/uploads/' . basename($request->input('address_proof'))))->toMediaCollection('address_proof');
            }
        } elseif ($rent->address_proof) {
            $rent->address_proof->delete();
        }

        return redirect()->route('admin.rents.index');
    }

    public function show(Rent $rent)
    {
        abort_if(Gate::denies('rent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rent->load('client', 'assets', 'quotation');

        return view('admin.rents.show', compact('rent'));
    }

    public function destroy(Rent $rent)
    {
        abort_if(Gate::denies('rent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rent->delete();

        return back();
    }

    public function massDestroy(MassDestroyRentRequest $request)
    {
        Rent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('rent_create') && Gate::denies('rent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Rent();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
