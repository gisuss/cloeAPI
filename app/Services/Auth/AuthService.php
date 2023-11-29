<?php

namespace App\Services\Auth;

use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\{Auth, DB, Hash, Mail};
use App\Mail\{ForgotPasswordMail, ResetPasswordMail};
use App\Models\{User};
use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthService
{
    private User $userModel;

    public function __construct(User $user) {
        $this->userModel = $user;
    }

    /**
     * login method.
     * 
     * @param array $data
     * @return array
     */
    public function login(array $data) : array {
        $array = [];
        $fieldType = filter_var($data['email_username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if (Auth::attempt(array($fieldType => $data['email_username'], 'password' => $data['password']))) {
            if ($fieldType == 'username') {
                $user = User::where('username', $data['email_username'])->first();
            }else{
                $user = User::where('email', $data['email_username'])->first();
            }

            if ($user === null) {
                $array['message'] = "Las credenciales suministradas son inválidas.";
                $array['code'] = Response::HTTP_UNAUTHORIZED;
            }else{
                if ($user->active) {
                    if (config('app.env') === 'production') {
                        $user->tokens()->delete();
                    }
                    $permisos = $user->getAllPermissions();
                    $tokenAbilities = [];
                    foreach ($permisos as $permiso) {
                        $tokenAbilities[] = $permiso->name;
                    }
                    $token = $user->createToken("login-".$data['email_username'], $tokenAbilities);
        
                    // if ($data['remember_me']) {
                    //     $user->remember_token = $token->plainTextToken;
                    //     $user->update();
                    // }
        
                    $array['message'] = "Usuario logeado exitosamente.";
                    $array['code'] = Response::HTTP_OK;
                    $array['token'] = $token->plainTextToken;
        
                    $now = Carbon::now();
                    $expires_at = Carbon::parse($token->accessToken->expires_at);
                    $expires_in = $expires_at->diffInRealHours($now);
                    $array['expiresIn'] = $expires_in . " horas";
                }else{
                    $array['message'] = "No tienes permitido el acceso, consulte con su superior.";
                    $array['code'] = Response::HTTP_FORBIDDEN;
                }
            }
        }else{
            $array['message'] = "Las credenciales suministradas son inválidas.";
            $array['code'] = Response::HTTP_BAD_REQUEST;
        }
        return $array;
    }

    public function logout() {
        $id = auth()->id();
        $array = [];
        if (isset($id)) {
            $user = $this->userModel->find($id);
            $user->tokens()->delete();
            $user->remember_token = NULL;
            $user->update();

            $array['message'] = "Cierre de Sesión Exitoso.";
            $array['code'] = Response::HTTP_OK;
        }else{
            $array['message'] = "Cierre de Sesión Fallido.";
            $array['code'] = Response::HTTP_NOT_FOUND;
        }
        return $array;
    }

    /**
     * User ForgotPassword method.
     * 
     * @param array $data
     * @return array
     */
    public function forgotPassword(array $data) {
        $array = [];
        $email = trim(Str::lower($data['email']));
        $verify = $this->userModel->where('email', $email)->exists();

        if ($verify) {
            $verify2 =  DB::table('password_reset_tokens')->where('email', $email);

            if ($verify2->exists()) {
                $verify2->delete();
            }

            $pin = $this->generateRandomPIN(6);
            $password_reset = DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' =>  $pin,
                'created_at' => Carbon::now()
            ]);

            if ($password_reset) {
                // dispatch(new SendForgotPasswordMail($email, $token))->delay(now()->addSeconds(10));
                Mail::to($email)->send(new ForgotPasswordMail($pin));

                // AL RECIBIR ESTE JSON DE RESPUESTA, EL CLIENTE DEBE REDIRIGIRSE A LA VENTANA DE LOGIN
                $array['message'] = "PIN de reseteo de contraseña enviado correctamente a " . $email . ".";
                $array['code'] = Response::HTTP_OK;
            }
        }else{
            // AL RECIBIR ESTE JSON DE RESPUESTA, EL CLIENTE DEBE PERMANECER EN LA VISTA ACTUAL
            $array['message'] = "El email suministrado no existe.";
            $array['code'] = Response::HTTP_NOT_FOUND;
        }
        return $array;
    }

    /**
     * User ResetPassword method.
     * 
     * @param array $data
     * @return array
     */
    public function resetPassword(array $data) : array {                
        $array = [];
        $user = Auth::user();
        if (!isset($user)) {
            $array['message'] = "El usuario no existe en el sistema.";
            $array['code'] = Response::HTTP_NOT_FOUND;
        }else{
            $user->update([
                'password' => Hash::make($data['password']),
                'isReset' => true,
            ]);
            $user->tokens()->delete();

            Mail::to($user->email)->send(new ResetPasswordMail($user, $data['password']));

            $array['message'] = "La contraseña ha sido actualizada con éxito.";
            $array['code'] = Response::HTTP_OK;
        }
        return $array;
    }

    /**
     * Método para verificación de PIN para reseteo de passwords de usuarios.
     * 
     * @param array $data
     * @return array
     */
    public function verifyPin(array $data) : array {
        $bool = false;
        $check = DB::table('password_reset_tokens')->where('email', $data['email']);
        $user = $this->userModel->where('email', $data['email'])->get();

        if ($check->exists() && ($check->first()->token == $data['pin'])) {
            $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
            if ($difference <= 3600) {
                $bool = true;
            }
        }

        $array = [];
        if ($bool) {
            $array['message'] = "PIN validado correctamente.";
            $array['OK'] = $bool;
            $array['user'] = $user;
            $array['code'] = Response::HTTP_OK;
        }else{
            $array['message'] = "PIN inválido o caducado.";
            $array['OK'] = $bool;
            $array['code'] = Response::HTTP_UNPROCESSABLE_ENTITY;
        }
        return $array;
    }

    public function isLoggeIn() : array {
        $bool = false;
        if (Auth::check() && Auth::user()->active) {
            $bool = true;
        }
        
        $array = [];
        if ($bool) {
            $array['message'] = "Usuario Autenticado.";
            $array['OK'] = $bool;
            $array['code'] = Response::HTTP_OK;
        }else{
            $array['message'] = "Usuario no Autenticado o Desactivado.";
            $array['OK'] = $bool;
            $array['code'] = Response::HTTP_FORBIDDEN;
        }
        return $array;
    }

    public function generateRandomPIN($length) {
        return substr(str_shuffle("0123456789"), 0, $length);
    }
}
