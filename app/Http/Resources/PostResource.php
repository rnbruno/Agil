<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResourse extends JsonResource
{
    /**
    *@param \Illuminate\Http\Request $request
    *@return array |Illuminate\Contracts\Support\Arrayable\JsonSeriazable
     */
    public function toArray($request)
    {
        return [
                'id' => $this->id,
                'title' => $this->title,
                'content' => substr($this->content, 0, 50). '...',
                'create_at' => $this->created_at->toDateString(),
        ];
    }

}