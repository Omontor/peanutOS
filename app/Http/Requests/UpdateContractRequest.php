<?php

namespace App\Http\Requests;

use App\Models\Contract;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContractRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_edit');
    }

    public function rules()
    {
        return [
            'contract_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'contract_deadline' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'from_id' => [
                'required',
                'integer',
            ],
            'static_clauses.*' => [
                'integer',
            ],
            'static_clauses' => [
                'array',
            ],
            'dynamic_clauses.*' => [
                'integer',
            ],
            'dynamic_clauses' => [
                'array',
            ],
        ];
    }
}
