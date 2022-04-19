<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventDayRequest;
use App\Http\Requests\StoreEventDayRequest;
use App\Http\Requests\UpdateEventDayRequest;
use App\Models\Event;
use App\Models\EventDay;
use App\Models\Venue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventDayController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_day_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDays = EventDay::with(['event', 'venue'])->get();

        $events = Event::get();

        $venues = Venue::get();

        return view('frontend.eventDays.index', compact('eventDays', 'events', 'venues'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_day_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venues = Venue::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventDays.create', compact('events', 'venues'));
    }

    public function store(StoreEventDayRequest $request)
    {
        $eventDay = EventDay::create($request->all());

        return redirect()->route('frontend.event-days.index');
    }

    public function edit(EventDay $eventDay)
    {
        abort_if(Gate::denies('event_day_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venues = Venue::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventDay->load('event', 'venue');

        return view('frontend.eventDays.edit', compact('eventDay', 'events', 'venues'));
    }

    public function update(UpdateEventDayRequest $request, EventDay $eventDay)
    {
        $eventDay->update($request->all());

        return redirect()->route('frontend.event-days.index');
    }

    public function show(EventDay $eventDay)
    {
        abort_if(Gate::denies('event_day_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDay->load('event', 'venue');

        return view('frontend.eventDays.show', compact('eventDay'));
    }

    public function destroy(EventDay $eventDay)
    {
        abort_if(Gate::denies('event_day_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDay->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventDayRequest $request)
    {
        EventDay::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
