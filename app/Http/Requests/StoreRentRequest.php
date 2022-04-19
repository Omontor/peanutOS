<?php

namespace App\Http\Requests;

use App\Models\Rent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rent_create');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'assets.*' => [
                'integer',
            ],
            'assets' => [
                'array',
            ],
            'from' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'to' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
