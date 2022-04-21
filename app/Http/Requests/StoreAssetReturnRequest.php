<?php

namespace App\Http\Requests;

use App\Models\AssetReturn;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAssetReturnRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asset_return_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'witness' => [
                'array',
            ],
        ];
    }
}
