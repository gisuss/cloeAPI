<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{Identification, User};
use Illuminate\Http\Response;
use App\Repositories\Users\UserRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\{Auth, DB};

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
                if (Auth::user()->enabled) {
                    $usuario = $this->repository->where('id', $this->user)->firstOrfail();
                    $cedula = Identification::find($usuario->ci_id);
                    $res = true;
                    
                    if ($cedula->type <> $this->request['ci_type'] || $cedula->number <> $this->request['ci_number']) {
                        $cedula->update([
                            'type' => $this->request['ci_type'],
                            'number' => $this->request['ci_number'],
                        ]);
                    }

                    if (isset($this->request['active'])) {
                        if ($this->request['active'] === 1) {
                            $res = $this->repository->activar($this->user);
                        }else{
                            $res = $this->repository->desactivar($this->user);
                        }
                    }

                    if ($res) {
                        $update = $usuario->update(array_merge($this->request, [
                            'ci_id' => $cedula->id,
                            'enabled' => isset($this->request['centro_id']) ? true : false
                        ]));
                    }else{
                        return response()->json([
                            'message' => 'No se puede actualizar el usuario.',
                            'success' => false,
                            'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                            'data' => [],
                        ], Response::HTTP_INTERNAL_SERVER_ERROR);
                    }
                }else{
                    return response()->json([
                        'message' => 'No estás habilitado para esta acción.',
                        'success' => false,
                        'code' =>  Response::HTTP_UNAUTHORIZED,
                        'data' => []
                    ],Response::HTTP_UNAUTHORIZED);
                }
            DB::commit();
            return $this->updateResponse(UserResource::make($usuario), $update ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'No se puede actualizar el usuario.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function setUser($user) {
        $this->user = $user;
    }
}