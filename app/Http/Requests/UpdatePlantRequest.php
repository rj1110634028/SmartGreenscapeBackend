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
            'mac_address' => ['Filled', 'mac_address'],
            'min_temperature' => ['Filled', 'numeric'],
            'min_humidity' => ['Filled', 'numeric'],
            'min_soil_humidity' => ['Filled', 'numeric'],
            'max_temperature' => ['Filled', 'numeric'],
            'max_humidity' => ['Filled', 'numeric'],
            'max_soil_humidity' => ['Filled', 'numeric'],
        ];
    }
}
