<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\User;
use Illuminate\Http\Response;
use App\Repositories\Users\UserRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserResource;
use App\Services\Users\UserService;
use Illuminate\Support\Facades\DB;

class UserDesactivateResponsable implements Responsable
{
    use StandardResponse;
    private UserService $service;
    private UserRepository $repository;
    private int $user;

    public function __construct(int $user, UserService $service = null, UserRepository $repository = null) {
        $this->user = $user;
        $this->service = $service ?? new UserService(new User());
        $this->repository = $repository ?? new UserRepository(new User());
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $desactivado = $this->service->desactivarUser($this->user);
            DB::commit();

            if ($desactivado) {
                return $this->updateResponse(UserResource::make($this->repository->find($this->user)), Response::HTTP_OK);
            }else{
                return response()->json([
                    'message' => 'Usuario inválido.',
                    'success' => false,
                    'data' => [],
                    'code' => Response::HTTP_BAD_REQUEST,
                ], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'No se puede desactivar el usuario.',
                'success' => false,
                'code' =>  Response::HTTP_NOT_FOUND,
                'data' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }
}