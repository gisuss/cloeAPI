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
        $usuario = $this->repository->find($this->user);
        return $this->showResponse(UserResource::make($usuario), isset($usuario) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    private function setUser($user) {
        $this->user = $user;
    }
}