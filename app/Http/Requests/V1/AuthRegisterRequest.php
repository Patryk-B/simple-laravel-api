<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // you don't need to be logged in order to register new user.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:250' /*, Rule::unique('users', 'name') */],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:250', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }
}
