<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMemberRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:225'],
            'last_name' => ['nullable', 'string', 'max:225'],
            'contact_1' => ['nullable', 'string', 'max:225', 'regex:/^\+\d{6,15}$/'],
            'contact_2' => ['nullable', 'string', 'max:225', 'regex:/^\+\d{6,15}$/'],
            'location' => ['nullable', 'string', 'max:225'],
            'department' => ['nullable', 'string', 'max:225'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5048'],
        ];
    }
}
