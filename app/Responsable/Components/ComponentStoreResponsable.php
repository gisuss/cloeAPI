<?php

namespace App\Responsable\Components;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Http\Requests\ComponentStoreRequest;
use App\Repositories\Components\ComponentRepository;
use App\Helpers\StandardResponse;
use App\Models\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Generator\StringManipulation\Pass\Pass;

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
                        'success' => false,
                        'code' =>  Response::HTTP_UNAUTHORIZED,
                        'message' => 'No estás habilitado para esta acción.',
                        'data' => []
                    ],Response::HTTP_UNAUTHORIZED);
                }
            DB::commit();

            if ($res) {
                return response()->json([
                    'success' => true,
                    'code' =>  Response::HTTP_OK,
                    'message' => 'Excelente, el RAEE se ha separado con éxito.',
                    'data' => []
                ],Response::HTTP_OK);
            }else{
                return response()->json([
                    'success' => false,
                    'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Oopss, ha ocurrido un error inesperado.',
                    'data' => []
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'code' =>  Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Oopss, ha ocurrido un error inesperado.',
                'data' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}