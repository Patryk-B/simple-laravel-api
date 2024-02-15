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
            'id' => ['prohibited'],
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:250', Rule::unique('users', 'email')],
            'email_verified_at' => ['prohibited'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'remember_token' => ['prohibited'],
            'created_at' => ['prohibited'],
            'updated_at' => ['prohibited'],
        ];
    }

    /**
     * Get list of validation rules for `/login`:
     */
    public static function login(): array
    {
        return [
            'id' => ['prohibited'],
            'name' => ['prohibited'],
            'email' => ['required', 'string', 'email'],
            'email_verified_at' => ['prohibited'],
            'password' => ['required', 'string'],
            'remember_token' => ['prohibited'],
            'created_at' => ['prohibited'],
            'updated_at' => ['prohibited'],
        ];
    }
}
