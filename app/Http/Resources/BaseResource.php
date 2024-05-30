<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
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
            'encargado' => [
                'user_id' => $this->encargado->id,
                'name' => $this->encargado->name . ' ' . $this->encargado->lastname,
                'cedula' => $this->encargado->cedula->type . '-' . $this->encargado->cedula->number,
            ],
            'estado' => $this->estado->estado,
            'ciudad' => $this->ciudad->ciudad,
            'address' => $this->address,
            'name' => $this->name,
            'description' => $this->description,
            'active' => $this->active ? 1 : 0,
        ];
    }
}
