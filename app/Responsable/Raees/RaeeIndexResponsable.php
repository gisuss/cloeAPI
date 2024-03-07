<?php

namespace App\Responsable\Raees;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Raee;
use App\Repositories\Raees\RaeeRepository;
use Illuminate\Http\Response;
use App\Helpers\StandardResponse;
use App\Http\Resources\RaeeResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RaeeIndexResponsable implements Responsable
{
    use StandardResponse;
    protected RaeeRepository $repository;

    public function __construct(RaeeRepository $repository = null) {
        $this->repository = $repository ?? new RaeeRepository(new Raee());
    }

    public function toResponse($request) {
        $res = $this->repository->paginate(null, request()->has('limit') ? request('limit') : 20, $request->filters);
        return $this->indexResponse(RaeeResource::collection($res));
    }
}
