<?php

namespace App\Http\Requests;

use App\Models\ClientEvaluation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientEvaluationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_evaluation_edit');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'rating' => [
                'numeric',
                'required',
                'min:0',
                'max:10',
            ],
        ];
    }
}
