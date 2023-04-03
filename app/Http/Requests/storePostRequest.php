<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'unique:posts'],
            'description' => ['required', 'min:5'],
            'user_id' => [
                'required',
                'exists:users,id'
            ],
            'image' => 'file|mimes:jpg,png|image|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'title can\'t be blank'
        ];
    }
}
