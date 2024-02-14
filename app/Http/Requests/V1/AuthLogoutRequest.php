<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\V1\Helpers\AuthRequestRules;

class AuthLogoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // get user:
        $user = $this->user();

        // exit:
        return $user != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
    }
}
