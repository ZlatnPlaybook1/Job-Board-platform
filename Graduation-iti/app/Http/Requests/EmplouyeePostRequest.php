<?php

namespace App\Http\Requests;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EmplouyeePostRequest extends FormRequest
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
            'title' => 'required|min:5|max:200',
            'employee_class_id' => 'required|exists:employeeclasses,id',
            'employment_type_id' => 'required|exists:employeetypes,id',
            'vacancy' => 'required|integer|min:1',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|min:3|max:75',
            'salary' => 'nullable|string|max:50',
            'benefits' => 'nullable|string',
            'responsibility' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'keywords' => 'nullable|string',
            'experience' => 'required|string',
            'company_location' => 'nullable|string|max:100',
            'company_website' => 'nullable',

        ];
    }
}