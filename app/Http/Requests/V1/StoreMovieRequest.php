<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create'); // 'movie:create'
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:1'],
            'genres' => ['required', 'array', 'min:1'],
            'genres.*' => ['required', 'string', 'distinct', 'min:1'],
            'country' => ['required', 'min:1'],
            'description' => ['required', 'min:25']
        ];
    }
}
