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
            'title' => ['required', 'string', 'min:1'],
            'cover' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
            'genres' => ['required', 'array', 'min:1'],
            'genres.*' => ['required', 'string', Rule::in(ValidGenres::get())],
            'country' => ['required', 'string', 'min:1'],
            'description' => ['required', 'string', 'min:25']
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
        $restrictions = MovieRequestRules::base();
        foreach ($restrictions as $$restriction) {
            array_unshift($restriction , 'sometimes');
        }

        return $restrictions;
    }

}
