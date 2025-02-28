<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\User;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserByRoleResource;
use App\Repositories\Users\UserRepository;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Response;

class UserGetByRoleResponsable implements Responsable
{
    use StandardResponse;
    protected UserRepository $repository;
    protected array $data;

    public function __construct(UserRepository $repository = null, RoleRequest $request) {
        $this->repository = $repository ?? new UserRepository(new User());
        $this->data = $request->validated();
    }

    public function toResponse($request) {
        $users = User::role($this->data['roleName'])
                ->where('active', true)
                ->where('enabled', true)
                ->where('estado_id', $this->data['estado_id'])
                ->get();
        return $this->indexResponse(UserByRoleResource::collection($users), isset($users) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
