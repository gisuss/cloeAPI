<?php

namespace App\Responsable\Raees;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{Raee};
use Illuminate\Http\Response;
use App\Repositories\Raees\RaeeRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\RaeeResource;
use Illuminate\Support\Facades\{Auth, DB};

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
                if (Auth::user()->enabled) {
                    $raee = $this->repository->where('id', $this->raee)->firstOrFail();
                    $update = $raee->update($this->data);
                }else{
                    return response()->json([
                        'message' => 'No estás habilitado para esta acción.',
                        'success' => false,
                        'code' =>  Response::HTTP_UNAUTHORIZED,
                        'data' => []
                    ],Response::HTTP_UNAUTHORIZED);
                }
            DB::commit();
            return $this->updateResponse(RaeeResource::make($this->repository->find($this->raee)), $update ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'No se puede actualizar el RAEE.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function setRaee($raee_id) {
        $this->raee = $raee_id;
    }
}