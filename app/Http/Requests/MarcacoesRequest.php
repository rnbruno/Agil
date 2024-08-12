<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcacoesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }
 
    public function rules()
    {
        return [
            'id' => ['required', 'string'],
            'animals_use_id' => ['required', 'string'],
            'medical_id' => ['nullable', 'string'],
            'marcacao_id' => ['nullable', 'string'],
            'marcacao_date' => ['nullable', 'string'],
            'reason' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'type_animal_name' => ['nullable', 'string'],
            'medical_name' => ['nullable', 'string'],
        ];
    }
}
