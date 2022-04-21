<?php

namespace App\Http\Requests;

use App\Models\AssetReturn;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAssetReturnRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('asset_return_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:asset_returns,id',
        ];
    }
}
