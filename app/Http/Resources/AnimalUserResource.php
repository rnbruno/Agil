<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalUserResource extends JsonResource
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
            'name' => $this->name,
            'breed' => $this->breed,
            'type_animals_id' => $this->type_animals_id,
            'age' => $this->age,
            'weight' => $this->id,
            'user_id' => $this->id,
            'type_name' => $this->type_name,
            'created_at' => $this->id,
        ];
    }
}
