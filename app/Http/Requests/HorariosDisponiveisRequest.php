<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorariosDisponiveisRequest extends FormRequest
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
            'data' => ['required', 'string'],
            'hora_inicio' => ['required', 'string'],
            'hora_fim' => ['nullable', 'string'],
            'disponivel' => ['nullable', 'string'],
        ];
    }
}
