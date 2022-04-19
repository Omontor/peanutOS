<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventDayRequest;
use App\Http\Requests\UpdateEventDayRequest;
use App\Http\Resources\Admin\EventDayResource;
use App\Models\EventDay;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventDayApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_day_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventDayResource(EventDay::with(['event', 'venue'])->get());
    }

    public function store(StoreEventDayRequest $request)
    {
        $eventDay = EventDay::create($request->all());

        return (new EventDayResource($eventDay))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EventDay $eventDay)
    {
        abort_if(Gate::denies('event_day_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventDayResource($eventDay->load(['event', 'venue']));
    }

    public function update(UpdateEventDayRequest $request, EventDay $eventDay)
    {
        $eventDay->update($request->all());

        return (new EventDayResource($eventDay))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EventDay $eventDay)
    {
        abort_if(Gate::denies('event_day_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDay->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
