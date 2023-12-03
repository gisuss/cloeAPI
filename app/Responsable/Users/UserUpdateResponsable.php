<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{User, Cargo};
use Illuminate\Http\Response;
use App\Repositories\Users\UserRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\{DB, Auth, Mail};
use App\Mail\{UserUpdateMail, UserBossUpdateMail};

class UserUpdateResponsable implements Responsable
{
    use StandardResponse;
    private UserRepository $repository;
    private array $request;
    protected int $user;

    public function __construct(int $user, array $data, UserRepository $repository = null) {
        $this->repository = $repository ?? new UserRepository(new User());
        $this->request = $data;
        $this->setUser($user);
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $usuario = $this->repository->find($this->user);

                if (isset($this->request['role'])) {
					$usuario->syncRoles([$this->request['role']]);
                }

                $update = $usuario->update($this->request);
            DB::commit();
            return $this->updateResponse(UserResource::make($usuario), $update ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No se puede actualizar el usuario.',
                'data' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function setUser($user) {
        $this->user = $user;
    }
}