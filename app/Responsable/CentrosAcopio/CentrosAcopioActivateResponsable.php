<?php

namespace App\Responsable\CentrosAcopio;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Repositories\CentrosAcopio\CentrosAcopioRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\BaseResource;
use App\Models\CentroAcopio;
use Illuminate\Support\Facades\DB;

class CentrosAcopioActivateResponsable implements Responsable
{
    use StandardResponse;
    private CentrosAcopioRepository $repository;
    private int $centro;

    public function __construct(int $centro_id, CentrosAcopioRepository $repository = null) {
        $this->repository = ($repository === null) ? new CentrosAcopioRepository(new CentroAcopio()) : $repository;
        $this->centro = $centro_id;
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $res = $this->repository->actualizar(['active' => true], $this->centro);
            DB::commit();
            return $this->updateResponse(BaseResource::make($res), isset($res) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No se pudo registrar el centro de acopio.',
                'data' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}