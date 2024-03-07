<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{User};
use Illuminate\Http\Response;
use App\Repositories\Users\UserRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\{Auth, DB, Hash};

class UserUpdatePasswordResponsable implements Responsable
{
    use StandardResponse;
    private UserRepository $repository;
    private array $data;
    protected int $user;

    public function __construct(int $user, array $data, UserRepository $repository = null) {
        $this->repository = $repository ?? new UserRepository(new User());
        $this->data = $data;
        $this->setUser($user);
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                if (Auth::user()->enabled) {
                    $usuario = $this->repository->find($this->user);
                    $update = $usuario->update([
                        'password' => Hash::make($this->data['password'])
                    ]);
                }else{
                    return response()->json([
                        'success' => false,
                        'code' =>  Response::HTTP_UNAUTHORIZED,
                        'message' => 'No estás habilitado para esta acción.',
                        'data' => []
                    ],Response::HTTP_UNAUTHORIZED);
                }
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