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
    protected array $data;

    public function __construct(UserRepository $repository = null, RoleRequest $request) {
        $this->repository = $repository ?? new UserRepository(new User());
        $this->data = $request->validated();
    }

    public function toResponse($request) {
        $users = User::role($this->data['roleName'])
                ->where('active', true)
                ->where('estado_id', Auth::user()->estado_id)
                ->get();
        return $this->indexResponse(UserByRoleResource::collection($users));
    }
}
