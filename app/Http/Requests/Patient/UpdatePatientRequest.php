<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
            'name' => 'string|max:255',
            'email' => [
                'email',
                Rule::unique('patients', 'email')->ignore($this->patient->id),
            ],
            'phone' => 'string',
            'birthdate' => 'date',
            'weight' => 'string',
            'height' => 'string',
            'allergies' => 'string',
            'Nationality' => 'string',
            'gender' => 'in:Male,Female,Other',
        ];
    }
}
