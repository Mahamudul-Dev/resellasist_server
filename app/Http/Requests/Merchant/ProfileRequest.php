<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\FormRequest\CustomFormRequest;

class ProfileRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->check();
    }


    public function rules(): array
    {
        return [
            'email' => 'nullable|min:2|max:50|email|unique:merchants,email'.$this->route('id'),
            'password' => 'nullable|min:6|max:25',
            'owner_name' => 'nullable|string|min:1|max:191',
            'merchant_name' => 'nullable|string|min:1|max:191',
            'owner_pic' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'merchant_logo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'owner_contact' => 'nullable|string|min:1|max:191',
            'nid' => 'nullable|string|min:1|max:191',
        ];
    }
}
