<?php

namespace App\SCM\Admin\Factories\ProductionScheduling\Requests;

use App\SCM\Base\Requests\ApiRequest;

class CreateSchedule extends ApiRequest
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
            'name' => 'required|min:3|unique:products',
            'description' => 'nullable|min:3',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ];
    }
}
