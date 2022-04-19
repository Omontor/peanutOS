<?php

namespace App\Http\Requests;

use App\Models\Approval;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreApprovalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('approval_create');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'quotation_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
