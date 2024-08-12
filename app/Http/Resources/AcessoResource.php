<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcessoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'acesso_id' => $this->acesso_id,
            'venda_produto_id' => $this->venda_produto_id,
            'cartao_id' => $this->cartao_id, 
            'pessoa_id' => $this->pessoa_id,
            'tipo_acesso' => $this->tipo_acesso,
            'numero' => $this->numero,
            'codigo_barra' => $this->codigo_barra,
            'nome' => $this->nome,
            'data_acesso' => $this->data_acesso,
        ];
    }
}
