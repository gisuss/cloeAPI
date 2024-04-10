<?php

namespace App\Responsable\Raees;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Raee;
use Illuminate\Http\Response;
use App\Helpers\StandardResponse;
use App\Http\Resources\RaeeResource;
use App\Repositories\Raees\RaeeRepository;

class RaeeShowResponsable implements Responsable
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
            return $this->showResponse(RaeeResource::make($res), isset($res) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'No se pudo encontrar el RAEE.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function setRaee($raee_id) {
        $this->raee = $raee_id;
    }
}