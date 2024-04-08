<?php

namespace App\Responsable\CentrosAcopio;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Http\Requests\CentroAcopioStoreRequest;
use App\Repositories\CentrosAcopio\CentrosAcopioRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\BaseResource;
use App\Models\CentroAcopio;
use Illuminate\Support\Facades\DB;

class CentrosAcopioStoreResponsable implements Responsable
{
    use StandardResponse;
    private CentrosAcopioRepository $repository;
    private array $data;

    public function __construct(CentrosAcopioRepository $repository = null, CentroAcopioStoreRequest $request) {
        $this->repository = ($repository === null) ? new CentrosAcopioRepository(new CentroAcopio()) : $repository;
        $this->data = $request->validated();
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $res = $this->repository->register($this->data);
            DB::commit();

            if (isset($res)) {
                return $this->storeResponse(BaseResource::make($res), isset($res) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
            }else{
                return response()->json([
                    'message' => 'No se pudo registrar el centro de acopio.',
                    'success' => false,
                    'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => []
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
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