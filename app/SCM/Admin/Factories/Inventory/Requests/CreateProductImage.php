<?php

namespace App\SCM\Admin\Factories\Inventory\Requests;

use App\SCM\Base\Requests\ApiRequest;

class CreateProductImage extends ApiRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8048',
        ];
    }
}
