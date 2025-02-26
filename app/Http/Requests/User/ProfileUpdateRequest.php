<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = Auth::user();

        return [
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:255',
            'photo_path' => 'nullable|string|max:2048',
            'specialty' => 'nullable|string|max:255',
            'license_number' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'license_number')->ignore($user->id),
            ],
            'address' => 'nullable|string|max:65535',
            'gender' => ['nullable', Rule::in(['Male', 'Female', 'Other'])],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name must not exceed 255 characters.',

            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a valid string.',
            'username.max' => 'The username must not exceed 255 characters.',
            'username.unique' => 'The username is already in use.',

            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a valid string.',
            'email.email' => 'The email format is invalid.',
            'email.max' => 'The email must not exceed 255 characters.',
            'email.unique' => 'The email is already in use.',

            'phone.string' => 'The phone number must be a valid string.',
            'phone.max' => 'The phone number must not exceed 255 characters.',

            'photo_path.string' => 'The photo path must be a valid string.',
            'photo_path.max' => 'The photo path must not exceed 2048 characters.',

            'specialty.string' => 'The specialty must be a valid string.',
            'specialty.max' => 'The specialty must not exceed 255 characters.',

            'license_number.string' => 'The license number must be a valid string.',
            'license_number.max' => 'The license number must not exceed 255 characters.',
            'license_number.unique' => 'The license number is already in use.',

            'address.string' => 'The address must be a valid string.',
            'address.max' => 'The address must not exceed 65,535 characters.',

            'gender.in' => 'The gender must be either Male, Female, or Other.',
        ];
    }
}
