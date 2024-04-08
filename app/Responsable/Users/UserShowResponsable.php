<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\User;
use Illuminate\Http\Response;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserResource;
use App\Repositories\Users\UserRepository;

class UserShowResponsable implements Responsable
{
    use StandardResponse;
    protected $user;
    protected UserRepository $repository;

    public function __construct(int $user, UserRepository $repository = null) {
        $this->setUser($user);
        $this->repository = $repository ?? new UserRepository(new User());
    }

    public function toResponse($request) {
        try {
            $usuario = $this->repository->where('id', $this->user)->firstOrFail();
            return $this->showResponse(UserResource::make($usuario), isset($usuario) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'No se pudo encontar el usuario.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function setUser($user) {
        $this->user = $user;
    }
}