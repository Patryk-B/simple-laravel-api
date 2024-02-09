<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
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
            'title' => ['required', 'string', 'min:1'],
            'cover' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
            'genres' => ['required', 'array', 'min:1'],
            'genres.*' => ['required', 'string', Rule::in([
                'Action','Adventure', 'Animation', 'Biography', 'Comedy', 'Costume', 'Crime', 'Documentary', 'Drama', 'Family', 'Fantasy', 'History', 'Horror', 'Kung-fu', 'Musical', 'Mystery', 'Romance', 'Sci-Fi', 'Talk-Show', 'Thriller', 'War', 'Western'
            ])],
            'country' => ['required', 'string', 'min:1'],
            'description' => ['required', 'string', 'min:25']
        ];
    }
}
