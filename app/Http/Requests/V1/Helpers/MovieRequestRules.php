<?php

namespace App\Http\Requests\V1\Helpers;

use App\Helpers\ValidGenres;
use Illuminate\Validation\Rule;

Class MovieRequestRules {

    /**
     * Get base list of validation rules for `Movie` model.
     */
    protected static function base(): array
    {
        return [
            'id' => ['prohibited'],
            'title' => ['required', 'string', 'min:1'],
            'cover' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
            'genres' => ['required', 'array', 'min:1'],
            'genres.*' => ['required', 'string', Rule::in(ValidGenres::get())],
            'country' => ['required', 'string', 'min:1'],
            'description' => ['required', 'string', 'min:25'],
            'uploaded_by' => ['prohibited'],
            'created_at' => ['prohibited'],
            'updated_at' => ['prohibited'],
        ];
    }

    /**
     * Get list of validation rules for `Movie` model, for `POST` request.
     */
    public static function post(): array
    {
        return MovieRequestRules::base();
    }

    /**
     * Get list of validation rules for `Movie` model, for `PUT` request.
     */
    public static function put(): array
    {
        return MovieRequestRules::base();
    }

    /**
     * Get list of validation rules for `Movie` model, for `PATCH` request.
     */
    public static function patch(): array
    {
        $rules = MovieRequestRules::base();
        foreach ($rules as &$rule) {
            array_unshift($rule, 'sometimes');
        }

        return $rules;
    }

}
