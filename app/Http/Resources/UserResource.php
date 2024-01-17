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
        return [
            'name' => $this->name . ' ' . $this->lastname,
            'cedula' => $this->cedula->type . '-' . $this->cedula->number,
            'email' => $this->email,
            'username' => $this->username,
            'address' => $this->address
        ];
    }
}
