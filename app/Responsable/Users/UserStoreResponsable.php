<?php

namespace App\Responsable\Users;

use Illuminate\Contracts\Support\Responsable;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\Users\UserRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;

class UserStoreResponsable implements Responsable
{
    use StandardResponse;
    private UserRepository $repository;
    private array $data;

    public function __construct(UserRepository $repository = null, UserStoreRequest $request) {
        $this->repository = ($repository === null) ? new UserRepository(new User()) : $repository;
        $this->data = $request->validated();
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $register = $this->repository->register($this->data);
            DB::commit();
            return $this->storeResponse(UserResource::make($register), isset($register) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No se pudo registrar el usuario.',
                'data' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}