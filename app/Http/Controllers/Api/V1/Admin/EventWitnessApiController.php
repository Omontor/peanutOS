<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEventWitnessRequest;
use App\Http\Requests\UpdateEventWitnessRequest;
use App\Http\Resources\Admin\EventWitnessResource;
use App\Models\EventWitness;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventWitnessApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_witness_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventWitnessResource(EventWitness::with(['type', 'team'])->get());
    }

    public function store(StoreEventWitnessRequest $request)
    {
        $eventWitness = EventWitness::create($request->all());

        if ($request->input('image', false)) {
            $eventWitness->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new EventWitnessResource($eventWitness))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EventWitness $eventWitness)
    {
        abort_if(Gate::denies('event_witness_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventWitnessResource($eventWitness->load(['type', 'team']));
    }

    public function update(UpdateEventWitnessRequest $request, EventWitness $eventWitness)
    {
        $eventWitness->update($request->all());

        if ($request->input('image', false)) {
            if (!$eventWitness->image || $request->input('image') !== $eventWitness->image->file_name) {
                if ($eventWitness->image) {
                    $eventWitness->image->delete();
                }
                $eventWitness->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($eventWitness->image) {
            $eventWitness->image->delete();
        }

        return (new EventWitnessResource($eventWitness))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EventWitness $eventWitness)
    {
        abort_if(Gate::denies('event_witness_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventWitness->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
