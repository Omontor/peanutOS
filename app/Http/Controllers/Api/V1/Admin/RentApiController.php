<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Http\Resources\Admin\RentResource;
use App\Models\Rent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('rent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RentResource(Rent::with(['client', 'assets', 'quotation'])->get());
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

        return (new RentResource($rent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Rent $rent)
    {
        abort_if(Gate::denies('rent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RentResource($rent->load(['client', 'assets', 'quotation']));
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

        return (new RentResource($rent))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Rent $rent)
    {
        abort_if(Gate::denies('rent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rent->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
