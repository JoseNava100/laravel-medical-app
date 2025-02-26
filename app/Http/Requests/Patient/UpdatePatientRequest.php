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

    /**
     * Get the custom messages for the validator.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.string' => 'The name must be a text string',
            'name.max' => 'The name must not exceed 255 characters',
            'email.email' => 'Please enter a valid email',
            'email.unique' => 'This email is already registered',
            'phone.string' => 'The phone must be a text string',
            'birthdate.date' => 'Date of birth must be valid',
            'weight.string' => 'The weight must be a text string',
            'height.string' => 'The height must be a text string',
            'allergies.string' => 'Allergies must be a text string',
            'Nationality.string' => 'Nationality must be a text string',
            'gender.in' => 'Gender must be Male, Female or Other',
        ];
    }
}
