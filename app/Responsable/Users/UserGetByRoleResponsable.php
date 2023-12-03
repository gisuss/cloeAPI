<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\User;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserByRoleResource;
use App\Repositories\Users\UserRepository;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Auth;

class UserGetByRoleResponsable implements Responsable
{
    use StandardResponse;
    protected UserRepository $repository;
    protected array $request;

    public function __construct(UserRepository $repository = null, RoleRequest $request) {
        $this->repository = $repository ?? new UserRepository(new User());
        $this->request = $request->validated();
    }

    public function toResponse($request) {
        $users = User::role($this->request['roleName'])->where('active', true)->get();
        return $this->indexResponse(UserByRoleResource::collection($users));
    }
}
