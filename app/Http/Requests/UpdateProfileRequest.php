<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:workers,email,'. auth()->guard('worker')->id(),
            'password' => 'nullable|string|min:6',
            'phone' => 'required|string|max:17',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'location' => 'required|string',
        ];
    }
}
