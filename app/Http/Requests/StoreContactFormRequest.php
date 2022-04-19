<?php

namespace App\Http\Requests;

use App\Models\ContactForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_form_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'subject' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'required',
            ],
            'message' => [
                'string',
                'required',
            ],
        ];
    }
}
