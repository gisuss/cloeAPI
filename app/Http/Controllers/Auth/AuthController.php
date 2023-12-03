<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\{LoginRequests,ResetPasswordRequests,ForgotPasswordRequests,VerifyPinRequests};
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
     *     description="Login.",
     *     @OA\RequestBody(
     *        required=true,
     *        description="Pass user credentials",
     *        @OA\JsonContent(
     *           required={"email_username","password"},
     *           @OA\Property(property="email_username", type="string", format="string", example="admin"),
     *           @OA\Property(property="password", type="string", format="password", example="password"),
     *           @OA\Property(property="remember_me", type="boolean", example="true"),
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
    public function login(LoginRequests $request) {
        $result = $this->service->login($request->validated());
        return response()->json([
            "message" => $result["message"],
            "token" => isset($result["token"]) ? $result["token"] : "",
            "role" => isset($result["role"]) ? $result["role"] : "",
            "expiredIn" => isset($result["expiresIn"]) ? $result["expiresIn"] : "",
            "code" => $result["code"],
        ], $result["code"]);
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
        return response()->json([
            "message" => $result["message"],
            "code" => $result["code"],
        ], $result["code"]);
    }

    /**
     * Forgot Password
     * 
     * @OA\Post(
     *     path="/api/auth/forgot-password",
     *     summary="Forgot password",
     *     description="Inicia proceso de reseteo de contraseña.",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *           required={"email"},
     *           @OA\Property(property="email", type="string", format="email", example="admin@censo.com"),
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
        return response()->json([
            "message" => $result["message"],
            "code" => $result["code"],
        ], $result["code"]);
    }

    public function verifyPin(VerifyPinRequests $request) {
        $result = $this->service->verifyPin($request->validated());
        return response()->json([
            "message" => $result["message"],
            "OK" => $result["OK"],
            "user" => isset($result["user"]) ? $result["user"] : "",
            "code" => $result["code"],
        ], $result["code"]);
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
        return response()->json([
            "message" => $result["message"],
            "OK" => $result["OK"],
            "code" => $result["code"],
        ], $result["code"]);
    }

    /**
     * Forgot Password
     * 
     * @OA\Put(
     *     path="/api/auth/reset-password",
     *     summary="Reset password",
     *     description="Reseteo de contraseña.",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *           @OA\Property(property="password", type="string", format="password", example="Sint3x#123"),
     *           @OA\Property(property="confirm_password", type="string", format="password", example="Sint3x#123"),
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
        return response()->json([
            "message" => $result["message"],
            "code" => $result["code"],
        ], $result["code"]);
    }

}
