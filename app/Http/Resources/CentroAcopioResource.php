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
            'encargado' => $this->encargado->name . ' ' . $this->encargado->lastname,
            'estado' => $this->estado->estado,
            'ciudad' => $this->ciudad->ciudad,
            'description' => $this->description ?? 'Sin descripción.' ,
            'address' => $this->address,
            'active' => $this->active ? 'Activo' : 'Inactivo',
        ];
    }
}
