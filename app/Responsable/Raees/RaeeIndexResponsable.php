<?php

namespace App\Responsable\Raees;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Raee;
use App\Repositories\Raees\RaeeRepository;
use Illuminate\Http\Response;
use App\Helpers\StandardResponse;
use App\Http\Resources\RaeeResource;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class RaeeIndexResponsable implements Responsable
{
    use StandardResponse;
    protected RaeeRepository $repository;
    protected Request $request;

    public function __construct(Request $request, RaeeRepository $repository = null) {
        $this->repository = $repository ?? new RaeeRepository(new Raee());
        $this->request = $request;
    }

    public function toResponse($request) {
        $res = $this->repository->paginate(null, request()->has('limit') ? request('limit') : 20, $this->request->filters);
        return $this->indexResponse(RaeeResource::collection($res));
    }
}
