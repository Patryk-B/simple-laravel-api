<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('update'); // 'cover:update'
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
                'movieId' => ['required', 'uuid'],
                'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
            ];
        } else if ($method == 'PATCH') {
            return [
                'movieId' => ['sometimes', 'required', 'uuid'],
                'image' => ['sometimes', 'required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
            ];
        } else {
            // TODO: throw error.
        }
    }

    /**
     *
     */
    protected function prepareForValidation() {
        $this->merge([
            'movie_id' => $this->movieId,
        ]);
    }
}
