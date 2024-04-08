<?php

namespace App\Responsable\CentrosAcopio;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Repositories\CentrosAcopio\CentrosAcopioRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\BaseResource;
use App\Models\CentroAcopio;
use Illuminate\Support\Facades\DB;

class CentrosAcopioDesactivateResponsable implements Responsable
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
                $res = $this->repository->actualizar(['active' => false], $this->centro);
            DB::commit();
            
            if ($res) {
                $centro = $this->repository->find($this->centro);
                return $this->updateResponse(BaseResource::make($centro), $res ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
            }else{
                return response()->json([
                    'message' => 'No se pudo desactivar el centro de acopio.',
                    'success' => false,
                    'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => []
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'No se pudo desactivar el centro de acopio.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}