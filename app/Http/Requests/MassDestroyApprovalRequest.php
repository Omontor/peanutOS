<?php

namespace App\Http\Requests;

use App\Models\Approval;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyApprovalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('approval_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:approvals,id',
        ];
    }
}
