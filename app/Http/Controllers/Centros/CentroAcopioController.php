<?php

namespace App\Http\Controllers\Centros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Responsable\CentrosAcopio\{CentrosAcopioStoreResponsable, CentrosAcopioShowResponsable, CentrosAcopioIndexResponsable, CentrosAcopioFindResponsable};

class CentroAcopioController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param mixed $centrosAcopioIndexResponsable
     * @return void
     * @OA\Get(
     *      path="/api/centro-acopio/index",
     *      tags={"Centro Acopio"},
     *      summary="INDEX Centro Acopio",
     *      description="Retorna la lista de Centro Acopio registrados en el sistema",
     *      security={{"sanctum":{}}},
     *      @OA\Response(
     *         response=200,
     *         description="Recurso obtenido con éxito.",
     *         @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *      )
     * )
     */
    public function index(CentrosAcopioIndexResponsable $centrosAcopioIndexResponsable)
    {
        return $centrosAcopioIndexResponsable;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param mixed $centrosAcopioStoreResponsable
     * @return void
     * @OA\Schema(
     *    schema="CreateCentroRequest",
     *    @OA\Property(
     *        property="encargado_id",
     *        type="integer",
     *        description="Encargado",
     *        nullable=false,
     *        example="1"
     *    ),
     *    @OA\Property(
     *        property="estado_id",
     *        type="integer",
     *        description="Estado",
     *        nullable=false,
     *        example="7"
     *    ),
     *    @OA\Property(
     *        property="ciudad_id",
     *        type="integer",
     *        description="Ciudad",
     *        nullable=false,
     *        example="127"
     *    ),
     *    @OA\Property(
     *        property="description",
     *        type="string",
     *        description="Descripción del centro de acopio",
     *        nullable=true,
     *        example="Centro de Acopio de Valencia"
     *    ),
     *    @OA\Property(
     *        property="address",
     *        type="string",
     *        description="Dirección del centro de acopio",
     *        nullable=false,
     *        format="Valencia centro"
     *    ),
     * )
     *
     * @OA\Post(
     *     path="/api/centro-acopio/store",
     *     tags={"Centro Acopio"},
     *     summary="Crea un nuevo Centro de Acopio",
     *     description="Registra un nuevo Centro de Acopio.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/CreateCentroRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recurso creado con éxito.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function store(CentrosAcopioStoreResponsable $centrosAcopioStoreResponsable) {
        return $centrosAcopioStoreResponsable;
    }

    /**
     * Display the specified resource.
     * 
     * @param int $centro_id
     * @return void
     * @OA\Get(
     *     path="/api/centro-acopio/show/{centro_id}",
     *     tags={"Centro Acopio"},
     *     summary="SHOW Centro de Acopio",
     *     description="Retorna la información del Centro de Acopio solicitado.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         description="Parámetro necesario para la consulta en la tabla Centros de Acopio",
     *         in="path",
     *         name="centro_id",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              example=1
     *         ),
     *         @OA\Examples(example="integer", value=1, summary="Introduce el número de id de un centro de acopio.")
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *     @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="No se ha encontrado el centro de acopio."
     *     ),
     *     @OA\Response(
     *     @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function show(int $centro_id)
    {
        return new CentrosAcopioShowResponsable($centro_id);
    }

    public function findByLocation(CentrosAcopioFindResponsable $centrosAcopioFindResponsable) {
        return $centrosAcopioFindResponsable;
    }
}
