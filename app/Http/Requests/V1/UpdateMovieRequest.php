<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('update'); // 'movie:update'
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'title' => ['required', 'min:1'],
                'genre' => ['required', 'string', 'min:1'],
                'country' => ['required', 'min:1'],
                'description' => ['required', 'min:25']
            ];
        } else if ($method == 'PATCH') {
            return [
                'title' => ['sometimes', 'required', 'min:1'],
                'genre' => ['sometimes', 'required', 'string', 'min:1'],
                'country' => ['sometimes', 'required', 'min:1'],
                'description' => ['sometimes', 'required', 'min:25']
            ];
        } else {
            // TODO: throw error.
        }
    }
}
