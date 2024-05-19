<?php

namespace App\Services\Users;

use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Auth};
use App\Models\{User};

class UserService
{
    private User $userModel;

    public function __construct(User $user) {
        $this->userModel = $user;
    }

    /**
     * Metodo desactivar un usuario.
     * 
     * @param int $user
     * @return bool
     */
    public function desactivarUser(int $user) : bool {
        $band = false;
        $usuario = $this->userModel->where('id', $user)->first();
        if (isset($usuario) && ($usuario->id <> Auth::user()->id)) {
            $usuario->update([
                'active' => false,
                'remember_token' => NULL,
            ]);
            $usuario->tokens()->delete();
            $band = true;
        }
        return $band;
    }
}