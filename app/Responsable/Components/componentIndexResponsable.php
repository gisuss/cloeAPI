<?php

namespace App\Responsable\Components;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Repositories\Components\ComponentRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\{ComponentResource, RaeeResource};
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};

class ComponentIndexResponsable implements Responsable
{
    use StandardResponse;
    protected ComponentRepository $repository;
    public Request $request;

    public function __construct(Request $request, ComponentRepository $repository = null) {
        $this->repository = $repository ?? new ComponentRepository(new Component());
        $this->request = $request;
    }

    public function toResponse($request) {
        $res = $this->repository->paginateByTypes(request()->has('limit') ? request('limit') : 20, $this->request->type);
        return $this->indexResponse(RaeeResource::collection($res));
    }
}
