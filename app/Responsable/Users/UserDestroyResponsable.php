<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\User;
use Illuminate\Support\Facades\{Auth, DB};
use App\Helpers\StandardResponse;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use App\Repositories\Users\UserRepository;

class UserDestroyResponsable implements Responsable
{
    use StandardResponse;
    private int $user;
	private UserRepository $repository;

    public function __construct(int $user, UserRepository $repository = null) {
		$this->repository = ($repository === null) ? new UserRepository(new User()) : $repository;
        $this->setUser($user);
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $res = $this->repository->eliminarUser($this->user);
            DB::commit();
			return $this->destroyResponse($res ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    private function setUser(int $user) {
        $this->user = $user;
    }
}