<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarcacoesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'animals_user_id' => $this->animals_user_id,
            'medical_id' => $this->medical_id,
            'marcacao_date' => $this->marcacao_date,
            'reason' => $this->reason,
            'notes' => $this->notes,
            'type_animal_name' => $this->type_animal_name,
            'medical_name' => $this->medical_name,
            'excluido' => $this->excluido,
            // 'conta' => $this->conta,
            // 'inativo' => $this->inativo,
        ];
    }
}
