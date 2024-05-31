<?php

namespace App\Responsable\Elements;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Repositories\Components\ComponentRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\{ComponentResource};
use App\Models\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};

class ElementDestroyResponsable implements Responsable
{
    use StandardResponse;
    protected ComponentRepository $repository;
    public int $component;

    public function __construct(int $component_id, ComponentRepository $repository = null) {
        $this->repository = $repository ?? new ComponentRepository(new Component());
        $this->component = $component_id;
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                $componente = $this->repository->where('id', $this->component)->firstOrFail();
                $componente->delete();
            DB::commit();
            return $this->destroyResponse();
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'componente no encontrado.',
                'success' => false,
                'data' => [],
                'code' =>  Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'No se puede eliminar el componente.',
                'success' => false,
                'data' => [],
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
