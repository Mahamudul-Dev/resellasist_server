<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\FormRequest\CustomFormRequest;

class RegistrationRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|min:2|max:50|email|unique:merchants',
            'password' => 'required|min:6|max:25',
            'owner_name' => 'required|string|min:1|max:191',
            'merchant_name' => 'required|string|min:1|max:191',
            'owner_pic' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'merchant_logo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'owner_contact' => 'required|string|min:1|max:191',
            'nid' => 'required|string|min:1|max:191',
        ];
    }
}
