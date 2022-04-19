<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'from',
            'field'      => 'platform',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.appointments.edit',
        ],
        [
            'model'      => '\App\Models\EventDay',
            'date_field' => 'date',
            'field'      => 'title',
            'prefix'     => 'Evento',
            'suffix'     => '',
            'route'      => 'admin.event-days.edit',
        ],
        [
            'model'      => '\App\Models\Rent',
            'date_field' => 'from',
            'field'      => 'id',
            'prefix'     => 'Inicio Renta',
            'suffix'     => '',
            'route'      => 'admin.rents.edit',
        ],
        [
            'model'      => '\App\Models\Rent',
            'date_field' => 'to',
            'field'      => 'id',
            'prefix'     => 'Deadline Renta',
            'suffix'     => '',
            'route'      => 'admin.rents.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
