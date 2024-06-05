<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, Response};
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\{Auth, Mail};
use App\Mail\ContactMail;
use App\Models\{Brand, Category, Ciudad, Estado, Line, Material, Municipio, Proceso, User};
use Spatie\Permission\Models\Role;

class UtilsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * 
     * @param ContactRequest $request
     * @return void
     * @OA\Schema(
     *    schema="ContactRequest",
     *    @OA\Property(
     *        property="name",
     *        type="string",
     *        description="Nombre",
     *        nullable=false,
     *        example="John Doe"
     *    ),
     *    @OA\Property(
     *        property="phone",
     *        type="string",
     *        description="Telefono",
     *        nullable=false,
     *        example="04121234567"
     *    ),
     *    @OA\Property(
     *        property="email",
     *        type="string",
     *        description="Correo electronico",
     *        nullable=false,
     *        example="johndoe@example.com"
     *    ),
     *    @OA\Property(
     *        property="city",
     *        type="string",
     *        description="Ciudad",
     *        nullable=false,
     *        example="Valencia"
     *    ),
     *    @OA\Property(
     *        property="message",
     *        type="string",
     *        description="Mensaje",
     *        nullable=false,
     *        example="Centro de acopio en la zona de valencia?"
     *    ),
     * )
     *
     * @OA\Post(
     *     path="/api/utils/contact",
     *     tags={"Utils"},
     *     summary="Contacto con centro de soporte de cloe",
     *     description="Contacto con centro de soporte de cloe.",
     *     @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/ContactRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Email enviado con éxito.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function contact(ContactRequest $request) {
        try {
            $data = $request->validated();
            $estado = Estado::find($data['estado_id'])->estado;
            $ciudad = Ciudad::find($data['ciudad_id'])->ciudad;

            $datosMail = array_merge($data, [
                'estado' => $estado,
                'ciudad' => $ciudad,
            ]);

            Mail::to('info@cloe.com')->send(new ContactMail($datosMail));
    
            return response()->json([
                'success' => true,
                'message' => 'Mensaje enviado exitosamente.',
                'code' => Response::HTTP_OK
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'El mensaje no pudo ser enviado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/utils/estados",
     *     tags={"Utils"},
     *     summary="Estados registrados en sistema cloe",
     *     description="Estados registrados en sistema cloe.",
     *     @OA\Response(
     *         response=200,
     *         description="Recurso obtenido con éxito",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Returns when user is not authenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Not authorized"),
     *         )
     *     )
     * )
     */
    public function states() {
        try {
            $data = [];
            $estados = Estado::get();

            foreach ($estados as $estado) {
                $data[] = [
                    'id' => $estado->id,
                    'name' => $estado->estado,
                ];
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/utils/ciudades",
     *     tags={"Utils"},
     *     summary="Ciudades registrados en sistema cloe",
     *     description="Ciudades registrados en sistema cloe.",
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="Ha ocurrido un error."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function cities(Request $request) {
        try {
            $data = [];
            $ciudades = Ciudad::filterByState($request->filters)->get();

            foreach ($ciudades as $ciudad) {
                $data[] = [
                    'id' => $ciudad->id,
                    'estado_id' => $ciudad->estado_id,
                    'name' => $ciudad->ciudad,
                ];
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/api/utils/municipios",
     *     tags={"Utils"},
     *     summary="Municipios registrados en sistema cloe",
     *     description="Municipios registrados en sistema cloe.",
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="Ha ocurrido un error."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function municipios(Request $request) {
        try {
            $data = [];
            $municipios = Municipio::filterByState($request->filters)->get();

            foreach ($municipios as $municipio) {
                $data[] = [
                    'id' => $municipio->id,
                    'estado_id' => $municipio->estado_id,
                    'name' => $municipio->municipio,
                ];
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/api/cargos/",
     *     tags={"Utils"},
     *     summary="Cargos registrados en sistema cloe",
     *     description="Cargos registrados en sistema cloe.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="Ha ocurrido un error."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function getRoles() {
        try {
            $data = [];
            $userAuth = User::find(Auth::user()->id);
            
            if ($userAuth->getRoleNames()[0] === 'Admin') {
                $roles = Role::orderBy('name', 'asc')->get();
            }else{
                $roles = Role::whereNotIn('name', ['Admin'])->orderBy('name', 'desc')->get();
            }

            foreach ($roles as $rol) {
                $data[] = [
                    'name' => $rol->name
                ];
            }

            return response()->json([
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data,
                'success' => true,
                'code' => Response::HTTP_OK
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'data' => [],
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/utils/brands",
     *     tags={"Utils"},
     *     summary="Marcas de RAEES pre-cargados en sistema cloe",
     *     description="Marcas de RAEES pre-cargados en sistema cloe.",
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="Ha ocurrido un error."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function getBrands() {
        try {
            $data = [];
            $brands = Brand::get();

            foreach ($brands as $brand) {
                $data[] = [
                    'id' => $brand->id,
                    'name' => $brand->name,
                ];
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/utils/lines",
     *     tags={"Utils"},
     *     summary="Líneas de clasificación de RAEES.",
     *     description="Líneas de clasificación de RAEES.",
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="Ha ocurrido un error."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function getLineas() {
        try {
            $data = [];
            $lines = Line::get();

            foreach ($lines as $line) {
                $data[] = [
                    'id' => $line->id,
                    'name' => $line->name,
                ];
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/utils/categories",
     *     tags={"Utils"},
     *     summary="Categorías de RAEES.",
     *     description="Categorías de RAEES.",
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="Ha ocurrido un error."
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function getCategories(Request $request) {
        try {
            $data = [];
            $categories = Category::filterByLine($request->filters)->get();

            foreach ($categories as $category) {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    public function getMaterials() {
        try {
            $data = [];
            $materials = Material::get();

            foreach ($materials as $material) {
                $data[] = [
                    'id' => $material->id,
                    'name' => $material->name,
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data
            ],Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
    
    public function getProcesses() {
        try {
            $data = [];
            $procesos = Proceso::get();

            foreach ($procesos as $proceso) {
                $data[] = [
                    'id' => $proceso->id,
                    'name' => $proceso->name,
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $data
            ],Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
