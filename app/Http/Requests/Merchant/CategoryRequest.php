<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\FormRequest\CustomFormRequest;

class CategoryRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_name' => 'required|min:2|max:255',
            'type' => 'required|min:2|max:255',
        ];
    }
}
