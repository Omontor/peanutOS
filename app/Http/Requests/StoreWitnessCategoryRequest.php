<?php

namespace App\Http\Requests;

use App\Models\WitnessCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWitnessCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('witness_category_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'required',
            ],
        ];
    }
}
