<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Certifique-se de que $this->resource é um Model ou Array
    return $this->resource instanceof Model ? $this->resource->toArray() : (array) $this->resource;

    }
}
