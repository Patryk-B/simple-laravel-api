<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\V1\Helpers\MovieRequestRules;

class MovieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // get user:
        $user = $this->user();

        // only author can update movies:
        $movie = $this->route('movie');
        $isAuthor = $user->id == $movie->uploaded_by;

        // exit:
        return $user != null && $user->tokenCan('update') && $isAuthor;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT')
        {
            return MovieRequestRules::put();
        }
        else if ($method == 'PATCH')
        {
            return MovieRequestRules::patch();
        }
        else
        {
            // TODO: throw error: unknown method / sanity check.
        }
    }
}
