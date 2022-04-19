<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventWitnessRequest;
use App\Http\Requests\StoreEventWitnessRequest;
use App\Http\Requests\UpdateEventWitnessRequest;
use App\Models\EventWitness;
use App\Models\Team;
use App\Models\WitnessCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventWitnessController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_witness_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventWitnesses = EventWitness::with(['type', 'team', 'media'])->get();

        $witness_categories = WitnessCategory::get();

        $teams = Team::get();

        return view('frontend.eventWitnesses.index', compact('eventWitnesses', 'teams', 'witness_categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_witness_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = WitnessCategory::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventWitnesses.create', compact('types'));
    }

    public function store(StoreEventWitnessRequest $request)
    {
        $eventWitness = EventWitness::create($request->all());

        if ($request->input('image', false)) {
            $eventWitness->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $eventWitness->id]);
        }

        return redirect()->route('frontend.event-witnesses.index');
    }

    public function edit(EventWitness $eventWitness)
    {
        abort_if(Gate::denies('event_witness_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = WitnessCategory::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventWitness->load('type', 'team');

        return view('frontend.eventWitnesses.edit', compact('eventWitness', 'types'));
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

        return redirect()->route('frontend.event-witnesses.index');
    }

    public function show(EventWitness $eventWitness)
    {
        abort_if(Gate::denies('event_witness_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventWitness->load('type', 'team');

        return view('frontend.eventWitnesses.show', compact('eventWitness'));
    }

    public function destroy(EventWitness $eventWitness)
    {
        abort_if(Gate::denies('event_witness_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventWitness->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventWitnessRequest $request)
    {
        EventWitness::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_witness_create') && Gate::denies('event_witness_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new EventWitness();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
