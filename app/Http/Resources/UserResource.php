<?php

namespace App\Http\Resources;

use App\Models\User;
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
        // return parent::toArray($request);
        $user = User::find($this->id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'cedula_type' => $this->cedula->type,
            'cedula_number' => $this->cedula->number,
            'email' => $this->email,
            'username' => $this->username,
            'estado' => $this->estado->estado,
            'ciudad' => $this->ciudad->ciudad,
            'address' => $this->address,
            // 'enabled' => $this->enabled,
            'active' => $this->active ? 1 : 0,
            'role' => $user->getRoleNames()[0],
            'centro_id' => $user->getRoleNames()[0] === 'Admin' ? null : $user->centro_id,
            'centro_name' => $user->getRoleNames()[0] === 'Admin' ? null : $user->centro->name,
        ];
    }
}
