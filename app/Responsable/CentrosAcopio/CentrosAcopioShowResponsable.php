<?php

namespace App\Responsable\CentrosAcopio;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{CentroAcopio};
use Illuminate\Http\{Response, Request};
use App\Helpers\StandardResponse;
use App\Http\Resources\CentroAcopioResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
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
            $res = $this->repository->find($this->centro);
            return $this->showResponse(CentroAcopioResource::make($res));
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No se pudo encontar el centro de acopio.',
                'data' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
