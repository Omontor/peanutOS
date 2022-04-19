<?php

namespace App\Http\Requests;

use App\Models\Quotation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQuotationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('quotation_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'client_id' => [
                'required',
                'integer',
            ],
            'assets.*' => [
                'integer',
            ],
            'assets' => [
                'required',
                'array',
            ],
            'total' => [
                'required',
            ],
            'clauses.*' => [
                'integer',
            ],
            'clauses' => [
                'array',
            ],
            'from' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'to' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'validity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
