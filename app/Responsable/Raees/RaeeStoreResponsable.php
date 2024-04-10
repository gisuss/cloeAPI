<?php

namespace App\Responsable\Raees;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Raee;
use Illuminate\Http\Response;
use App\Http\Requests\RaeeStoreRequest;
use App\Repositories\Raees\RaeeRepository;
use App\Helpers\StandardResponse;
use App\Http\Resources\RaeeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RaeeStoreResponsable implements Responsable
{
    use StandardResponse;
    private RaeeRepository $repository;
    private array $data;

    public function __construct(RaeeRepository $repository = null, RaeeStoreRequest $request) {
        $this->repository = ($repository === null) ? new RaeeRepository(new Raee()) : $repository;
        $this->data = $request->validated();
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                if (Auth::user()->enabled) {
                    $raee = Raee::create([
                        'brand_id' => $this->data['brand_id'],
                        'line_id' => $this->data['line_id'],
                        'category_id' => $this->data['category_id'],
                        'model' => $this->data['model'],
                        'information' => isset($this->data['information']) ? $this->data['information'] : null,
                        'clasified_by' => Auth::user()->id,
                        'centro_id' => Auth::user()->centro_id,
                        'status' => 'Clasificado',
                    ]);

                    $res = Raee::findOrFail($raee->id);
                }else{
                    return response()->json([
                        'message' => 'No estás habilitado para esta acción.',
                        'success' => false,
                        'code' =>  Response::HTTP_UNAUTHORIZED,
                        'data' => []
                    ],Response::HTTP_UNAUTHORIZED);
                }
            DB::commit();
            return $this->storeResponse(RaeeResource::make($res), isset($res) ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'No se pudo registrar el RAEE.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}