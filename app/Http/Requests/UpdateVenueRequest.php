<?php

namespace App\Http\Requests;

use App\Models\Venue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVenueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('venue_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'lat' => [
                'string',
                'required',
            ],
            'lng' => [
                'string',
                'required',
            ],
        ];
    }
}
