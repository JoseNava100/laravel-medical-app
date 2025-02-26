<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePatientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string',
            'birthdate' => 'required|date',
            'weight' => 'required|string',
            'height' => 'required|string',
            'allergies' => 'required|string',
            'Nationality' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
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
            'name.required' => 'The patients name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email',
            'email.unique' => 'This email is already registered',
            'phone.required' => 'The telephone number is required',
            'birthdate.required' => 'The date of birth is mandatory',
            'weight.required' => 'Weight is mandatory',
            'height.required' => 'Height is mandatory',
            'allergies.required' => 'Allergies are mandatory',
            'Nationality.required' => 'Nationality is mandatory',
            'gender.required' => 'Gender is mandatory',
            'gender.in' => 'The gender must be Male, Female or Other',
        ];
    }
}
