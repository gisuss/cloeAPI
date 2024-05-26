<?php

namespace App\Http\Controllers\Centros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CentroAcopioUpdateRequest;
use App\Models\{CentroAcopio, User};
use Barryvdh\DomPDF\Facade\Pdf;
use App\Responsable\CentrosAcopio\{CentrosAcopioStoreResponsable, CentrosAcopioDesactivateResponsable, CentrosAcopioUpdateResponsable, CentrosAcopioShowResponsable, CentrosAcopioIndexResponsable, CentrosAcopioActivateResponsable, CentrosAcopioFindResponsable};
use Illuminate\Support\Facades\Auth;

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
     *        property="name",
     *        type="string",
     *        description="nombre del centro de acopio",
     *        nullable=false,
     *        example="ECO RAEE"
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
     * Update a specified resource in storage.
     * 
     * @param int $centro_id
     * @return void
     * @OA\Schema(
     *    schema="UpdateCentroRequest",
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
     *        property="name",
     *        type="string",
     *        description="Nombre del centro de acopio",
     *        nullable=false,
     *        example="Eco Raee"
     *    ),
     *    @OA\Property(
     *        property="description",
     *        type="string",
     *        description="Descripción del centro de acopio",
     *        nullable=true,
     *        example="Centro de Acopio de Naguanagua"
     *    ),
     *    @OA\Property(
     *        property="address",
     *        type="string",
     *        description="Dirección del centro de acopio",
     *        nullable=false,
     *        format="Naguanagua centro"
     *    ),
     * )
     *
     * @OA\Put(
     *     path="/api/centro-acopio/update/{centro_id}",
     *     tags={"Centro Acopio"},
     *     summary="Actualiza datos de un Centro de Acopio",
     *     description="Actualiza datos de un Centro de Acopio.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/UpdateCentroRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recurso actualizado con éxito.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function update(int $centro_id, CentroAcopioUpdateRequest $request) {
        return new CentrosAcopioUpdateResponsable($centro_id, $request->validated());
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

    /**
     * Activate the specified resource.
     * 
     * @param int $centro_id
     * @return void
     * @OA\Post(
     *     path="/api/centro-acopio/activate/{centro_id}",
     *     tags={"Centro Acopio"},
     *     summary="ACTIVAR Centro de Acopio",
     *     description="Reactiva el Centro de Acopio solicitado.",
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
     *         description="Recurso actualizado con éxito."
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
    public function activate(int $centro_id) {
        return new CentrosAcopioActivateResponsable($centro_id);
    }

    /**
     * Desactivate the specified resource.
     * 
     * @param int $centro_id
     * @return void
     * @OA\Post(
     *     path="/api/centro-acopio/desactivate/{centro_id}",
     *     tags={"Centro Acopio"},
     *     summary="DESACTIVAR Centro de Acopio",
     *     description="Desactiva el Centro de Acopio solicitado.",
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
     *         description="Recurso actualizado con éxito."
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
    public function desactivate(int $centro_id) {
        return new CentrosAcopioDesactivateResponsable($centro_id);
    }

    public function reportPDF() {
        $isAdmin = false;
        $userAuth = User::where('id', Auth::user()->id)->first();

        if ($userAuth->getRoleNames()[0] === 'Admin') {
            $centros = CentroAcopio::all();
            $isAdmin = true;
            $pdf = Pdf::loadView('exports.PDFCentros', compact('centros', 'isAdmin'));
    
            return $pdf->download('reporte_de_usuarios.pdf');
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Acceso no autorizado.',
                'code' => 403
            ], 403);
        }  
    }
}
