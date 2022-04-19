<?php

namespace App\Http\Requests;

use App\Models\BasicData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBasicDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('basic_data_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'rfc' => [
                'string',
                'required',
            ],
        ];
    }
}
