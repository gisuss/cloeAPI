<?php

namespace App\Responsable\Componentes;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Helpers\StandardResponse;
use App\Http\Resources\RaeeShowResource;
use App\Models\Raee;
use App\Repositories\Raees\RaeeRepository;

class ComponentShowResponsable implements Responsable
{
    use StandardResponse;
    protected $raee;
    protected RaeeRepository $repository;

    public function __construct(int $raee_id, RaeeRepository $repository = null) {
        $this->setRaee($raee_id);
        $this->repository = $repository ?? new RaeeRepository(new Raee());
    }

    public function toResponse($request) {
        try {
            $res = $this->repository->where('id', $this->raee)->firstOrFail();
            return $this->showResponse(RaeeShowResource::make($res), isset($res) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'No se pudo encontrar el componente.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function setRaee($raee_id) {
        $this->raee = $raee_id;
    }
}