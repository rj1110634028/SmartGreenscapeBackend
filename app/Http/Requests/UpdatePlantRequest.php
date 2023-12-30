<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantRequest extends FormRequest
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
            'min_temperature' => ['required', 'numeric', 'decimal:0,4', 'between:0,100'],
            'min_humidity' => ['required', 'numeric', 'decimal:0,4', 'between:0,100'],
            'min_soil_humidity' => ['required', 'numeric', 'decimal:0,4', 'between:0,100'],
            'max_temperature' => ['required', 'numeric', 'decimal:0,4', 'between:0,100'],
            'max_humidity' => ['required', 'numeric', 'decimal:0,4', 'between:0,100'],
            'max_soil_humidity' => ['required', 'numeric', 'decimal:0,4', 'between:0,100'],
        ];
    }
}
