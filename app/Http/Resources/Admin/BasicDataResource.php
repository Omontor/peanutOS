<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class BasicDataResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
