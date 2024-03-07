<?php

namespace App\Responsable\Raees;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Raee;
use Illuminate\Support\Facades\{Auth, DB};
use App\Helpers\StandardResponse;
use Illuminate\Http\Response;
use App\Repositories\Raees\RaeeRepository;

class RaeeDestroyResponsable implements Responsable
{
    use StandardResponse;
    private int $raee;
	private RaeeRepository $repository;

    public function __construct(int $raee_id, RaeeRepository $repository = null) {
		$this->repository = ($repository === null) ? new RaeeRepository(new Raee()) : $repository;
        $this->setRaee($raee_id);
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                if (Auth::user()->enabled) {
                    $res = $this->repository->eliminarRaee($this->raee);
                }else{
                    return response()->json([
                        'success' => false,
                        'code' =>  Response::HTTP_UNAUTHORIZED,
                        'message' => 'No estás habilitado para esta acción.',
                        'data' => []
                    ],Response::HTTP_UNAUTHORIZED);
                }
            DB::commit();
			return $this->destroyResponse($res ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    private function setRaee(int $raee_id) {
        $this->raee = $raee_id;
    }
}