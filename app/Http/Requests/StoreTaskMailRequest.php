<?php

namespace App\Http\Requests;

use App\Models\TaskMail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaskMailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_mail_create');
    }

    public function rules()
    {
        return [
            'title_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
