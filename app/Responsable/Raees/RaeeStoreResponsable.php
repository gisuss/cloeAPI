<?php

namespace App\Responsable\Raees;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Raee;
use Illuminate\Http\Response;
use App\Http\Requests\RaeeStoreRequest;
use App\Repositories\Raees\RaeeRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\RaeeResource;
use Illuminate\Support\Facades\DB;

class RaeeStoreResponsable implements Responsable
{
    use StandardResponse;
    private RaeeRepository $repository;
    private array $data;

    public function __construct(RaeeRepository $repository = null, RaeeStoreRequest $request) {
        $this->repository = ($repository === null) ? new RaeeRepository(new Raee()) : $repository;
        $this->data = $request->validated();
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $raee = $this->repository->store($this->data);
            DB::commit();
            return $this->storeResponse(RaeeResource::make($raee), isset($raee) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No se pudo registrar el RAEE.',
                'data' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}