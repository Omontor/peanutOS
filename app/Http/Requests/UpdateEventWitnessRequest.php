<?php

namespace App\Http\Requests;

use App\Models\EventWitness;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventWitnessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_witness_edit');
    }

    public function rules()
    {
        return [];
    }
}
