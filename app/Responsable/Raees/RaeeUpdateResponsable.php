<?php

namespace App\Responsable\Raees;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{Raee};
use Illuminate\Http\Response;
use App\Repositories\Raees\RaeeRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\RaeeResource;
use Illuminate\Support\Facades\{DB};

class RaeeUpdateResponsable implements Responsable
{
    use StandardResponse;
    private RaeeRepository $repository;
    private array $data;
    protected int $raee;

    public function __construct(int $raee_id, array $data, RaeeRepository $repository = null) {
        $this->repository = $repository ?? new RaeeRepository(new Raee());
        $this->data = $data;
        $this->setRaee($raee_id);
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $raee = $this->repository->find($this->raee);
                $update = $raee->update($this->data);
            DB::commit();
            return $this->updateResponse(RaeeResource::make($raee), $update ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No se puede actualizar el RAEE.',
                'data' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function setRaee($raee_id) {
        $this->raee = $raee_id;
    }
}