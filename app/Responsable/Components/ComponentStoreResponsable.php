<?php

namespace App\Responsable\Components;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Http\Requests\ComponentStoreRequest;
use App\Repositories\Components\ComponentRepository;
use App\Helpers\StandardResponse;
use App\Models\Component;
use Illuminate\Support\Facades\{Auth, DB};

class ComponentStoreResponsable implements Responsable
{
    use StandardResponse;
    private ComponentRepository $repository;
    private array $data;

    public function __construct(ComponentRepository $repository = null, ComponentStoreRequest $request) {
        $this->repository = ($repository === null) ? new ComponentRepository(new Component()) : $repository;
        $this->data = $request->validated();
    }

    public function toResponse($request) {
        try {
            DB::beginTransaction();
                if (Auth::user()->enabled) {
                    $res = $this->repository->store($this->data);
                }else{
                    return response()->json([
                        'message' => 'No estás habilitado para esta acción.',
                        'success' => false,
                        'code' =>  Response::HTTP_UNAUTHORIZED,
                        'data' => []
                    ],Response::HTTP_UNAUTHORIZED);
                }
            DB::commit();

            if ($res) {
                return response()->json([
                    'message' => 'Excelente, el RAEE se ha separado con éxito.',
                    'success' => true,
                    'code' =>  Response::HTTP_OK,
                    'data' => []
                ],Response::HTTP_OK);
            }else{
                return response()->json([
                    'message' => 'Oopss, ha ocurrido un error inesperado.',
                    'success' => false,
                    'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => []
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Oopss, ha ocurrido un error inesperado.',
                'success' => false,
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}