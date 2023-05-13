<?php

namespace App\Http\Requests\Reseller;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'nullable|min:2|max:50|email|unique:resellers,email' . $this->route('id'),
            'password' => 'nullable|min:6|max:25',
            'reseller_name' => 'nullable|string|min:1|max:191',
            'profile_pic' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'contact' => 'nullable|string|min:1|max:191',
            'nid' => 'nullable|string|min:1|max:191',
        ];
    }
}
