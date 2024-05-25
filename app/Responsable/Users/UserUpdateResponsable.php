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

                    if (isset($this->request['active'])) {
                        if ($this->request['active'] === 1) {
                            $res = $this->repository->activar($this->user);
                        }else{
                            $res = $this->repository->desactivar($this->user);
                        }
                    }else{
                        $cedula = Identification::find($usuario->ci_id);

                        if (isset($this->request['ci_type']) || isset($this->request['ci_number'])) {
                            if (isset($this->request['ci_type'])) {
                                if ($cedula->type <> $this->request['ci_type']) {
                                    $cedula->update([
                                        'type' => $this->request['ci_type']
                                    ]);
                                }
                            }
                            
                            if (isset($this->request['ci_number'])) {
                                if ($cedula->number <> $this->request['ci_number']) {
                                    $cedula->update([
                                        'number' => $this->request['ci_number'],
                                    ]);
                                }
                            }
                        }

                        $update = $usuario->update($this->request);
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

            if (isset($res)) {
                if ($res) {
                    return response()->json([
                        'message' => 'Usuario actualizado correctamente.',
                        'success' => true,
                        'code' =>  Response::HTTP_OK,
                        'data' => [],
                    ], Response::HTTP_OK);
                }else{
                    return response()->json([
                        'message' => 'No se puede actualizar el usuario.',
                        'success' => false,
                        'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                        'data' => [],
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }

            if (isset($update)) {
                if ($update) {
                    return $this->updateResponse(UserResource::make($usuario), $update ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
                }else{
                    return response()->json([
                        'message' => 'No se puede actualizar el usuario.',
                        'success' => false,
                        'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                        'data' => [],
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
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