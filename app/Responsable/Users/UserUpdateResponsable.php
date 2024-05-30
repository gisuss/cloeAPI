<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{Identification, User};
use Illuminate\Http\Response;
use App\Repositories\Users\UserRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\{Auth, DB, Hash};

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
                    $usuario = $this->repository->where('id', $this->user)->firstOrFail();
                    $userAuth = $this->repository->where('id', Auth::user()->id)->firstOrFail();

                    if (isset($this->request['active'])) {
                        if ($this->request['active'] === 1) {
                            $res = $this->repository->activar($this->user);
                        }else{
                            $res = $this->repository->desactivar($this->user);
                        }
                    }else{
                        if (isset($this->request['ci_type']) || isset($this->request['ci_number'])) {
                            $cedula = Identification::find($usuario->ci_id);
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

                        if (isset($this->request['password'])) {
                            $update = $usuario->update([
                                'password' => Hash::make($this->request['password'])
                            ]);
                        }else{
                            $update = $usuario->update([
                                'name' => isset($this->request['name']) ? $this->request['name'] : $usuario->name,
                                'lastname' => isset($this->request['lastname']) ? $this->request['lastname'] : $usuario->lastname,
                                'ci_id' => $cedula->id,
                                'email' => isset($this->request['email']) ? $this->request['email'] : $usuario->email,
                                'estado_id' => isset($this->request['estado_id']) ? $this->request['estado_id'] : $usuario->estado_id,
                                'ciudad_id' => isset($this->request['ciudad_id']) ? $this->request['ciudad_id'] : $usuario->ciudad_id,
                                'address' => isset($this->request['address']) ? $this->request['address'] : $usuario->address,
                            ]);

                            if ($userAuth->hasRole('Admin') && isset($this->request['role']) && isset($update)) {
                                $usuario->syncRoles([$this->request['role']]);

                                if ($this->request['role'] === 'Admin') {
                                    $usuario->update([
                                        'centro_id' => null
                                    ]);
                                }
                            }
                        }
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
                    $usuario2 = $this->repository->where('id', $usuario->id)->firstOrfail();
                    return $this->updateResponse(UserResource::make($usuario2), $update ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
                }else{
                    return response()->json([
                        'message' => 'No se puede actualizar el usuario.',
                        'success' => false,
                        'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                        'data' => [],
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Usuario no encontrado.',
                'success' => false,
                'code' =>  Response::HTTP_NOT_FOUND,
                'data' => [],
            ], Response::HTTP_NOT_FOUND);
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