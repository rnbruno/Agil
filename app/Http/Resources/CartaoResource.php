<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
        
    // }

    public function toArray($request)
    {
        // dd($request);
        return [
            'produto' => $this->produto,
            'cartao_id' => $this->cartao_id,
            'tipo_cartao_id' => $this->tipo_cartao_id,
            'codigo_barra' => $this->codigo_barra,
            'numero' => $this->numero,
            'creditos' => $this->creditos,
            'inativo' => $this->inativo,
            'tipo_leitura_id' => $this->tipo_leitura_id,
            'preco' => $this->preco,
        ];
    }
}
