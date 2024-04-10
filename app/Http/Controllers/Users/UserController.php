<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{UserUpdateRequest, FirstResetPasswordRequests, UserActivateRequest};
use App\Responsable\Users\{ UserShowResponsable,UserDestroyResponsable, UserIndexResponsable,UserGetByRoleResponsable,
                            UserStoreResponsable, UserUpdateResponsable, UserDesactivateResponsable,UserActivateResponsable,
                            UserUpdatePasswordResponsable
                          };

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param mixed $userIndexResponsable
     * @return void
     * @OA\Get(
     *      path="/api/users/index",
     *      tags={"Users"},
     *      summary="INDEX Users",
     *      description="Retorna la lista de usuarios registrados en el sistema",
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
    public function index(UserIndexResponsable $userIndexResponsable)
    {
        return $userIndexResponsable;
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
     * @param mixed $userStoreResponsable
     * @return void
     * @OA\Schema(
     *    schema="CreateUserRequest",
     *    @OA\Property(
     *        property="name",
     *        type="string",
     *        description="Nombre",
     *        nullable=false,
     *        example="Juan"
     *    ),
     *    @OA\Property(
     *        property="lastname",
     *        type="string",
     *        description="Apellido",
     *        nullable=false,
     *        example="Arango"
     *    ),
     *    @OA\Property(
     *        property="ci_type",
     *        type="string",
     *        description="Tipo de identificación personal",
     *        nullable=false,
     *        example="V"
     *    ),
     *    @OA\Property(
     *        property="ci_number",
     *        type="string",
     *        description="Número de identificación personal",
     *        nullable=false,
     *        example="20753800"
     *    ),
     *    @OA\Property(
     *        property="email",
     *        type="string",
     *        description="Correo eletrónico",
     *        nullable=false,
     *        format="email"
     *    ),
     *    @OA\Property(
     *        property="estado_id",
     *        type="integer",
     *        description="ID de estado",
     *        nullable=false,
     *        example="7"
     *    ),
     *    @OA\Property(
     *        property="municipio_id",
     *        type="integer",
     *        description="ID de municipio",
     *        nullable=false,
     *        example="86"
     *    ),
     *    @OA\Property(
     *        property="address",
     *        type="string",
     *        description="Dirección del usuario",
     *        nullable=false,
     *        example="Valencia, calle 101, Venezuela"
     *    ),
     *    @OA\Property(
     *        property="role",
     *        type="string",
     *        description="Rol",
     *        nullable=false,
     *        example="Recolector"
     *    ),
     * )
     *
     * @OA\Post(
     *     path="/api/users/register",
     *     tags={"Users"},
     *     summary="STORE a new user",
     *     description="Registra un nuevo usuario.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/CreateUserRequest")
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
    public function store(UserStoreResponsable $userStoreResponsable)
    {
        return $userStoreResponsable;
    }

    /**
     * Display the specified resource.
     * 
     * @param int $user
     * @return void
     * @OA\Get(
     *     path="/api/users/show/{user}",
     *     tags={"Users"},
     *     summary="SHOW User",
     *     description="Retorna la información del usuario solicitado.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         description="Parámetro necesario para la consulta en la tabla usuarios",
     *         in="path",
     *         name="user",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              example=1
     *         ),
     *         @OA\Examples(example="integer", value=1, summary="Introduce el número de id de un usuario.")
     *     ),
     *     @OA\Response(
     *         @OA\MediaType(mediaType="application/json"),
     *         response=200,
     *         description="Recurso obtenido con éxito."
     *     ),
     *     @OA\Response(
     *     @OA\MediaType(mediaType="application/json"),
     *         response=404,
     *         description="No se ha encontrado el usuario."
     *     ),
     *     @OA\Response(
     *     @OA\MediaType(mediaType="application/json"),
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function show(int $user)
    {
        return new UserShowResponsable($user);
    }

    /**
     * Display users by role name.
     * 
     * @param Request $request
     * @return void
     * @OA\Schema(
     *    schema="RoleRequest",
     *    @OA\Property(
     *        property="roleName",
     *        type="string",
     *        description="Nombre de rol",
     *        nullable=false,
     *        example="Recolector"
     *    ),
     *    @OA\Property(
     *        property="estado_id",
     *        type="integer",
     *        description="ID de estado",
     *        nullable=false,
     *        example="7"
     *    ),
     * )
     * @OA\Get(
     *      path="/api/users/getByRoleName",
     *      tags={"Users"},
     *      summary="Listado de users by role name",
     *      description="Retorna la lista de usuarios dado un rol",
     *      security={{"sanctum":{}}},
     *      @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RoleRequest")
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Recurso obtenido con éxito.",
     *         @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error.",
     *         @OA\JsonContent()
     *      )
     * )
     */
    public function getUsersByRole(UserGetByRoleResponsable $userGetByRoleResponsable)
    {
        return $userGetByRoleResponsable;
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
     * @param int $user
     * @param UserUpdateRequest $request
     * @return void
     * @OA\Schema(
     *    schema="UpdateUserRequest",
     *    @OA\Property(
     *        property="name",
     *        type="string",
     *        description="Nombre",
     *        nullable=false,
     *        example="Juan"
     *    ),
     *    @OA\Property(
     *        property="lastname",
     *        type="string",
     *        description="Apellido",
     *        nullable=false,
     *        example="Pérez"
     *    ),
     *    @OA\Property(
     *        property="ci_type",
     *        type="string",
     *        description="Tipo de identificación personal",
     *        nullable=false,
     *        example="V"
     *    ),
     *    @OA\Property(
     *        property="ci_number",
     *        type="string",
     *        description="Número de identificación personal",
     *        nullable=false,
     *        example="20753800"
     *    ),
     *    @OA\Property(
     *        property="email",
     *        type="string",
     *        description="Correo eletrónico",
     *        nullable=false,
     *        format="email"
     *    ),
     *    @OA\Property(
     *        property="estado_id",
     *        type="integer",
     *        description="ID de estado",
     *        nullable=false,
     *        example="7"
     *    ),
     *    @OA\Property(
     *        property="municipio_id",
     *        type="integer",
     *        description="ID de municipio",
     *        nullable=false,
     *        example="86"
     *    ),
     *    @OA\Property(
     *        property="address",
     *        type="string",
     *        description="Dirección del usuario",
     *        nullable=false,
     *        example="Valencia, calle 120, Venezuela"
     *    )
     * )
     *
     * @OA\Put(
     *     path="/api/users/update/{user}",
     *     tags={"Users"},
     *     summary="UPDATE user",
     *     description="Actualiza un usuario.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         description="Parámetro necesario para la búsqueda en la tabla usuarios",
     *         in="path",
     *         name="user",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="integer", value=1, summary="Introduce el número de id de un usuario.")
     *     ),
     *     @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest")
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
    public function update(int $user, UserUpdateRequest $request)
    {
        return new UserUpdateResponsable($user, $request->validated());
    }

    /**
     * First Reset Password
     * @param int $user
     * @param FirstResetPasswordRequests $request
     * @return void
     * 
     * @OA\Post(
     *     path="/api/users/first-reset-password/{user}",
     *     summary="First reset password",
     *     description="Restablecimiento de contraseña por primera vez.",
     *     tags={"Users"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         description="Parámetro necesario para la búsqueda en la tabla usuarios",
     *         in="path",
     *         name="user",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="integer", value=1, summary="Introduce el número de id de un usuario.")
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *           @OA\Property(property="password", type="string", format="password", example="password"),
     *           @OA\Property(property="confirm_password", type="string", format="password", example="password"),
     *        ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
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
    public function firstResetPassword(int $user, FirstResetPasswordRequests $request) {
        return new UserUpdatePasswordResponsable($user, $request->validated());
    }

    /**
     * Desactive an specified user.
     * 
     * @param int $user
     * @return void
     * @OA\Post(
     *      path="/api/users/desactivate/{user}",
     *      tags={"Users"},
     *      summary="DESACTIVATE an User by ID",
     *      description="Desactiva un usuario del sistema",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *         description="Parámetro necesario para la búsqueda en la tabla usuarios",
     *         in="path",
     *         name="user",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="integer", value=1, summary="Introduce el número de id de un usuario.")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recurso obtenido con éxito.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function desactivarUser(int $user) {
        return new UserDesactivateResponsable($user);
    }
    
    /**
     * Desactive an specified user.
     * 
     * @param int $user
     * @return void
     * @OA\Post(
     *      path="/api/users/activate/{user}",
     *      tags={"Users"},
     *      summary="ACTIVATE an User by ID",
     *      description="Activa un usuario del sistema",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *         description="Parámetro necesario para la búsqueda en la tabla usuarios",
     *         in="path",
     *         name="user",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="integer", value=1, summary="Introduce el número de id de un usuario.")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recurso obtenido con éxito.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function activarUser(int $user) {
        return new UserActivateResponsable($user);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param mixed $user
     * @return void
     * @OA\Delete(
     *     path="/api/users/delete/{user}",
     *     tags={"Users"},
     *     summary="DELETE {user}",
     *     description="Elimina un usuario.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         description="Parámetro necesario para la búsqueda en la tabla usuarios",
     *         in="path",
     *         name="user",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="1", summary="Introduce el número de id de un usuario.")
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
    public function destroy(int $user)
    {
        return new UserDestroyResponsable($user);
    }
}
