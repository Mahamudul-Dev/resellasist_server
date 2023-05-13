<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MerchantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nid' => $this->nid,
            'owner_contact' => $this->owner_contact,
            'owner_name' => $this->owner_name,
            'owner_pic' => $this->owner_pic ? config('app.url') . Storage::url($this->owner_pic) : null,
            'merchant_name' => $this->merchant_name,
            'email' => $this->email,
            'merchant_logo' => $this->merchant_logo ? config('app.url') . Storage::url($this->merchant_logo) : null
        ];
    }
}
