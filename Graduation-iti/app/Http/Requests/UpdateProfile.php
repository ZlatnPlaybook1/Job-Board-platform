<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
        $id = $this->route('id'); // Assuming 'id' is passed as a route parameter

        return [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'nullable|numeric',
            'designation' => 'nullable|string'
        ];
    }

    /**
     * Get the custom error messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 5 characters.',
            'name.max' => 'The name may not be greater than 20 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'mobile.numeric' => 'The mobile number must be a valid number.',
            'designation.string' => 'The designation must be a string.',
        ];
    }
}
