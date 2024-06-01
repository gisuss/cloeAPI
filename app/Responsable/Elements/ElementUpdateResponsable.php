<?php

namespace App\Responsable\Elements;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Repositories\Components\ComponentRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\{ComponentResource, RaeeResource};
use App\Models\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};

class ElementUpdateResponsable implements Responsable
{
    use StandardResponse;
    protected ComponentRepository $repository;
    public array $request;
    public int $component;

    public function __construct(int $component_id, array $data, ComponentRepository $repository = null) {
        $this->repository = $repository ?? new ComponentRepository(new Component());
        $this->request = $data;
        $this->component = $component_id;
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $componente = $this->repository->where('id', $this->component)->firstOrFail();
                $update = $componente->update($this->request);

                if (isset($update)) {
                    if (isset($this->request['materials'])) {
                        $componente->materials()->sync($this->request['materials']);
                    }

                    if ($this->request['process']) {
                        $componente->processes()->sync($this->request['process']);
                    }
                }
            DB::commit();

            if (isset($update)) {
                $componente2 = $this->repository->where('id', $this->component)->firstOrFail();
                return $this->updateResponse(ComponentResource::make($componente2), $update ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
            }else{
                return response()->json([
                    'message' => 'No se puede actualizar el componente.',
                    'success' => false,
                    'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => [],
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'componente no encontrado.',
                'success' => false,
                'code' =>  Response::HTTP_NOT_FOUND,
                'data' => [],
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'No se puede actualizar el componente.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
