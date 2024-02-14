<?php

namespace App\Http\Requests\V1\Helpers;

use Illuminate\Validation\Rule;

Class AuthRequestRules {

    /**
     * Get list of validation rules for `/register`:
     */
    public static function register(): array
    {
        return [
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:250', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }

    /**
     * Get list of validation rules for `/login`:
     */
    public static function login(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ];
    }
}
