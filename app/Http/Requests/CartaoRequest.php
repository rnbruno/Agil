<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartaoRequest extends FormRequest
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
     *'cartao_id' => 'cartao_id',
    *    'tipo_cartao_id' => 'tipo_cartao_id',
     *   'codigo_barra' => 'codigo_barra',
      *  'numero' => 'numero',
      *  'creditos' => 'creditos',
      *  'inativo' => 'inativo',
      *  'tipo_leitura_id' => 'tipo_leitura_id',
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'cartao_id' => ['required', 'int'],
            'tipo_cartao_id' => ['nullable', 'int'],
            'codigo_barra' => ['nullable', 'string'],
            'numero' => ['nullable', 'string'],
            'creditos' => ['nullable', 'int'],
            'inativo' => ['nullable', 'int'],
            'tipo_leitura_id' => ['nullable', 'int'],
            'produto' => ['nullable', 'string'],
            'preco' => ['nullable', 'string'],
        ];
    }
}
