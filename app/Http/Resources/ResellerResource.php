<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reseller_name' => $this->reseller_name,
            'profile_pic' => $this->profile_pic,
            'contact' => $this->contact,
            'nid' => $this->nid,
            'email' => $this->email,
        ];
    }
}
