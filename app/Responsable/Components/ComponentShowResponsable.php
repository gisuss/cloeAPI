<?php

namespace App\Responsable\Components;

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
        $res = $this->repository->find($this->raee);
        return $this->showResponse(RaeeShowResource::make($res), isset($res) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    private function setRaee($raee_id) {
        $this->raee = $raee_id;
    }
}