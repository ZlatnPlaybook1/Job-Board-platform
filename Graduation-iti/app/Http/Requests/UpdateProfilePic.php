<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePic extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    /**
     * Get custom validation messages for the request.
     */
    public function messages(): array
    {
        return [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image may not be greater than 2MB.',
        ];
    }
}