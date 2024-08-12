<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'string'],
            'name' => ['required', 'string'],
            'breed' => ['nullable', 'string'],
            'type_animals_id' => ['required', 'string'],
            'age' => ['nullable', 'string'],
            'weight' => ['nullable', 'string'],
            'user_id' => ['required', 'string'],
            'type_name' => ['required', 'string'],
            'created_at' => ['required', 'string'],
        ];
    }
}
