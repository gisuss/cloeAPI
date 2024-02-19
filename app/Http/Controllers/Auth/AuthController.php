<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\{ResetPasswordRequests,ForgotPasswordRequests};
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;


class AuthController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $service) {
        $this->service = $service;
    }

    /**
     * Login User
     * 
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     summary="LOGIN user",
     *     description="Iniciar sesión.",
     *     @OA\RequestBody(
     *        required=true,
     *        description="Pass user credentials",
     *        @OA\JsonContent(
     *           required={"email_username","password"},
     *           @OA\Property(property="email_username", type="string", format="string", example="admin"),
     *           @OA\Property(property="password", type="string", format="password", example="password")
     *        ),
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Wrong credentials response",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Usuario o contraseña erróneos. Intente de nuevo.")
     *          )
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function login(Request $request) {
        $result = $this->service->login($request);
        return response()->json($result);
    }

    /**
     * Logout an User
     * 
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="LOGOUT user",
     *     description="Logout user and invalidate token",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
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
    public function logout() {
        $result = $this->service->logout();
        return response()->json($result);
    }

    /**
     * Forgot Password
     * 
     * @OA\Post(
     *     path="/api/auth/forgot-password",
     *     summary="Forgot password",
     *     description="Inicia proceso de restablecimiento de contraseña.",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *           required={"email"},
     *           @OA\Property(property="email", type="string", format="email", example="admin@cloe.com"),
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
    public function forgotPassword(ForgotPasswordRequests $request) {
        $result = $this->service->forgotPassword($request->validated());
        return response()->json($result);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/is-logged-in",
     *     summary="IS-LOG-IN user",
     *     description="Verifica si el usuario aún tiene sesión activa.",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
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
    public function isLoggeIn() {
        $result = $this->service->isLoggeIn();
        return response()->json($result);
    }

    /**
     * Reset Password
     * 
     * @OA\Post(
     *     path="/api/auth/reset-password",
     *     summary="Reset password",
     *     description="Restablecimiento de contraseña.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *           @OA\Property(property="password", type="string", format="password", example="password"),
     *           @OA\Property(property="confirm_password", type="string", format="password", example="password"),
     *           @OA\Property(property="pin", type="string", format="string", example="123456"),
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
    public function resetPassword(ResetPasswordRequests $request) {
        $result = $this->service->resetPassword($request->validated());
        return response()->json($result);
    }
}
