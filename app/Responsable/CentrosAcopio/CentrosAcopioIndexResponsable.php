<?php

namespace App\Responsable\CentrosAcopio;

use Illuminate\Contracts\Support\Responsable;
use App\Models\{CentroAcopio};
use Illuminate\Http\{Request};
use App\Helpers\StandardResponse;
use App\Http\Resources\BaseResource;
use App\Repositories\CentrosAcopio\CentrosAcopioRepository;

class CentrosAcopioIndexResponsable implements Responsable
{
    use StandardResponse;
    protected CentrosAcopioRepository $repository;
    protected Request $request;

    public function __construct(Request $request, CentrosAcopioRepository $repository = null) {
        $this->repository = $repository ?? new CentrosAcopioRepository(new CentroAcopio());
        $this->request = $request;
    }

    public function toResponse($request) {
        $res = $this->repository->paginate(null, request()->has('limit') ? request('limit') : 20, $this->request->filters);
        return $this->indexResponse(BaseResource::collection($res));
    }
}
