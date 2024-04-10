<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'model' => $this->model,
            'brand' => $this->marca->name,
            'linea' => $this->linea->name,
            'categoria' => $this->category->name,
            'clasificador' => $this->clasificador->name . ' ' . $this->clasificador->lastname,
            'information' => $this->information,
            'status' => $this->status,
        ];
    }
}
