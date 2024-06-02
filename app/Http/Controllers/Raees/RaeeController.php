<?php

namespace App\Http\Controllers\Raees;

use App\Exports\RaeeExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RaeeUpdateRequest;
use App\Models\{Raee, User};
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Responsable\Raees\{ RaeeStoreResponsable, RaeeIndexResponsable, RaeeShowResponsable, RaeeUpdateResponsable,
    RaeeDestroyResponsable
};

class RaeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param mixed $raeeIndexResponsable
     * @return void
     * @OA\Get(
     *      path="/api/raee/index",
     *      tags={"Clasificacion"},
     *      summary="INDEX RAEEs",
     *      description="Retorna la lista de RAEEs registrados en el sistema",
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
    public function index(RaeeIndexResponsable $raeeIndexResponsable)
    {
        return $raeeIndexResponsable;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param mixed $raeeStoreResponsable
     * @return void
     * @OA\Schema(
     *    schema="CreateRaeeRequest",
     *    @OA\Property(
     *        property="brand_id",
     *        type="integer",
     *        description="Marca",
     *        nullable=false,
     *        example="149"
     *    ),
     *    @OA\Property(
     *        property="line_id",
     *        type="integer",
     *        description="Línea",
     *        nullable=false,
     *        example="2"
     *    ),
     *    @OA\Property(
     *        property="category_id",
     *        type="integer",
     *        description="Categoría",
     *        nullable=false,
     *        example="17"
     *    ),
     *    @OA\Property(
     *        property="model",
     *        type="string",
     *        description="Modelo",
     *        nullable=false,
     *        example="Galaxy A54 5G"
     *    ),
     *    @OA\Property(
     *        property="information",
     *        type="string",
     *        description="Información adicional",
     *        nullable=false,
     *        example="Pantalla partida"
     *    ),
     * )
     *
     * @OA\Post(
     *     path="/api/raee/store",
     *     tags={"Clasificacion"},
     *     summary="Registra un nuevo RAEE",
     *     description="Registra un nuevo RAEE.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/CreateRaeeRequest")
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
    public function store(RaeeStoreResponsable $raeeStoreResponsable)
    {
        return $raeeStoreResponsable;
    }

    /**
     * Display the specified resource.
     * 
     * @param int $raee_id
     * @return void
     * @OA\Get(
     *     path="/api/raee/show/{raee_id}",
     *     tags={"Clasificacion"},
     *     summary="SHOW RAEE",
     *     description="Retorna la información del RAEE solicitado.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         description="Parámetro necesario para la consulta en la tabla RAEEs",
     *         in="path",
     *         name="raee_id",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              example=1
     *         ),
     *         @OA\Examples(example="integer", value=1, summary="Introduce el número de id de un RAEE.")
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *     @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="No se ha encontrado el RAEE."
     *     ),
     *     @OA\Response(
     *     @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function show(int $raee_id)
    {
        return new RaeeShowResponsable($raee_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param int $raee_id
     * @param RaeeUpdateRequest $request
     * @return void
     * @OA\Schema(
     *    schema="UpdateRaeeRequest",
     *    @OA\Property(
     *        property="brand_id",
     *        type="integer",
     *        description="Marca",
     *        nullable=false,
     *        example="149"
     *    ),
     *    @OA\Property(
     *        property="line_id",
     *        type="integer",
     *        description="Línea",
     *        nullable=false,
     *        example="2"
     *    ),
     *    @OA\Property(
     *        property="category_id",
     *        type="integer",
     *        description="Categoría",
     *        nullable=false,
     *        example="17"
     *    ),
     *    @OA\Property(
     *        property="model",
     *        type="string",
     *        description="Modelo",
     *        nullable=false,
     *        example="Galaxy A54 5G"
     *    ),
     *    @OA\Property(
     *        property="information",
     *        type="string",
     *        description="Información adicional",
     *        nullable=false,
     *        example="Pantalla partida"
     *    ),
     * )
     *
     * @OA\Put(
     *     path="/api/raee/update/{raee_id}",
     *     tags={"Clasificacion"},
     *     summary="Actualiza un RAEE",
     *     description="Actualiza un RAEE.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/UpdateRaeeRequest")
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
    public function update(int $raee_id, RaeeUpdateRequest $request)
    {
        return new RaeeUpdateResponsable($raee_id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $raee_id
     * @return void
     * @OA\Delete(
     *     path="/api/raee/delete/{raee_id}",
     *     tags={"Clasificacion"},
     *     summary="DELETE a RAEE",
     *     description="Elimina un RAEE.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         description="Parámetro necesario para la búsqueda en la tabla de RAEEs",
     *         in="path",
     *         name="raee_id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="1", summary="Introduce el número de id de un RAEE.")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recurso eliminado con éxito.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function destroy(int $raee_id)
    {
        return new RaeeDestroyResponsable($raee_id);
    }

    public function reportPDF() {
        $isAdmin = false;
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->getRoleNames()[0] === 'Admin') {
            $raees = Raee::all();
            $isAdmin = true;
        }else{
            $raees = Raee::where('centro_id', $user->centro_id)->get();
            $centro = $user->centro->name;
        }

        if (isset($centro)) {
            $pdf = Pdf::loadView('exports.PDFRaee', compact('raees', 'isAdmin', 'centro'));
        }else {
            $pdf = Pdf::loadView('exports.PDFRaee', compact('raees', 'isAdmin'));
        }

        return $pdf->download('reporte_de_raee.pdf');
    }

    public function reportExcel() {
        return Excel::download(new RaeeExport, 'reporte_de_raee.xlsx');
    }
}
