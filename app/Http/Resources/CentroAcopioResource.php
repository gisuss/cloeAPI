<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CentroAcopioResource extends JsonResource
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
            'centro_id' => $this->id,
            'estado' => $this->estado->estado,
            'municipio' => $this->municipio->municipio,
            'address' => $this->address,
            'description' => $this->description,
            'active' => $this->active ? 'Activo' : 'Inactivo',
        ];
    }
}
