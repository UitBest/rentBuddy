<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Weap\Junction\Http\Controllers\Resources\BaseResource;

class AddressResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
