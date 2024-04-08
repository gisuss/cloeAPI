<?php

namespace App\Responsable\CentrosAcopio;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{CentroAcopio};
use Illuminate\Http\{Response, Request};
use App\Helpers\StandardResponse;
use App\Http\Resources\BaseResource;
use App\Repositories\CentrosAcopio\CentrosAcopioRepository;

class CentrosAcopioShowResponsable implements Responsable
{
    use StandardResponse;
    protected CentrosAcopioRepository $repository;
    protected int $centro;

    public function __construct(int $centro_id, CentrosAcopioRepository $repository = null) {
        $this->repository = $repository ?? new CentrosAcopioRepository(new CentroAcopio());
        $this->centro = $centro_id;
    }

    public function toResponse($request) {
        try {
            $res = $this->repository->where('id', $this->centro)->firstOrFail();
            return $this->showResponse(BaseResource::make($res), isset($res) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'No se pudo encontar el centro de acopio.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
