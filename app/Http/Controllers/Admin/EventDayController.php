<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class EventDayController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('event_day_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EventDay::with(['event', 'venue'])->select(sprintf('%s.*', (new EventDay())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'event_day_show';
                $editGate = 'event_day_edit';
                $deleteGate = 'event_day_delete';
                $crudRoutePart = 'event-days';

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

            $table->addColumn('event_title', function ($row) {
                return $row->event ? $row->event->title : '';
            });

            $table->addColumn('venue_name', function ($row) {
                return $row->venue ? $row->venue->name : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event', 'venue']);

            return $table->make(true);
        }

        $events = Event::get();
        $venues = Venue::get();

        return view('admin.eventDays.index', compact('events', 'venues'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_day_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venues = Venue::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventDays.create', compact('events', 'venues'));
    }

    public function store(StoreEventDayRequest $request)
    {
        $eventDay = EventDay::create($request->all());

        return redirect()->route('admin.event-days.index');
    }

    public function edit(EventDay $eventDay)
    {
        abort_if(Gate::denies('event_day_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venues = Venue::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventDay->load('event', 'venue');

        return view('admin.eventDays.edit', compact('eventDay', 'events', 'venues'));
    }

    public function update(UpdateEventDayRequest $request, EventDay $eventDay)
    {
        $eventDay->update($request->all());

        return redirect()->route('admin.event-days.index');
    }

    public function show(EventDay $eventDay)
    {
        abort_if(Gate::denies('event_day_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDay->load('event', 'venue');

        return view('admin.eventDays.show', compact('eventDay'));
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
