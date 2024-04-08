<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserByRoleResource extends JsonResource
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
            'name' => explode(' ', $this->name)[0] . ' ' . explode(' ', $this->lastname)[0] . ' | ' . $this->cedula->type . '-' . $this->cedula->number,
        ];
    }
}
