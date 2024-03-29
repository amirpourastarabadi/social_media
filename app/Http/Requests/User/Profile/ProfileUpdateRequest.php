<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'   => ['required', 'string'],
            'email'  => ['required', 'email', 'unique:users,email,except,id'],
            'bio'    => ['nullable', 'string', 'max:256'],
            'image'  => ['nullable', 'image', 'mimes:png,jpg,jpeg']
        ];
    }
}
