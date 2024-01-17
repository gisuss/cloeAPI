<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{Identification, User};
use Illuminate\Http\Response;
use App\Repositories\Users\UserRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\{DB};

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

                $cedula = Identification::find($usuario->ci_id);
                
                if ($cedula->type <> $this->request['ci_type'] || $cedula->number <> $this->request['ci_number']) {
                    $cedula->update([
                        'type' => $this->request['ci_type'],
                        'number' => $this->request['ci_number'],
                    ]);
                }

                $update = $usuario->update(array_merge($this->request, ['ci_id' => $cedula->id]));
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