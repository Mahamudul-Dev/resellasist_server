<?php

namespace App\Http\Requests\Reseller;

use App\Http\Requests\FormRequest\CustomFormRequest;

class LoginRequest extends CustomFormRequest
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
            'email' => 'required|min:2|max:50|email',
            'password' => 'required|min:6|max:25',
        ];
    }
}
