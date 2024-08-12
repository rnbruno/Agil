<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcessoRequest extends FormRequest
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
            'acesso_id' => ['required', 'acesso_id'],
            'venda_produto_id' => ['nullable', 'venda_produto_id'],
            'cartao_id' => ['nullable','cartao_id'],
            'pessoa_id' => ['nullable','pessoa_id'],
            'tipo_acesso' => ['nullable','tipo_acesso'],
            'numero' => ['nullable','numero'],
            'codigo_barra' => ['nullable','codigo_barra'],
            'nome' => ['nullable','nome'],
            'data_acesso' => ['nullable','data_acesso'],
        ];
    }
}
