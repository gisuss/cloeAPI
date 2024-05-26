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
     * @param Request $data
     * @return array
     */
    public function login(Request $data) : array {
        $array = [];
        $fieldType = filter_var($data['email_username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if (Auth::attempt(array($fieldType => $data['email_username'], 'password' => $data['password']))) {
            if ($fieldType == 'username') {
                $user = User::where('username', $data['email_username'])->first();
            }else{
                $user = User::where('email', $data['email_username'])->first();
            }

            if ($user === null) {
                $array = [
                    'success' => false,
                    'message' => 'Las credenciales suministradas son inválidas.',
                    'code' => Response::HTTP_UNAUTHORIZED
                ];
            }else{
                if ($user->active) {
                    $user->tokens()->delete();
                    $token = $user->createToken("login-" . $user->username);
        
                    // $now = Carbon::now();
                    // $expires_at = Carbon::parse($token->accessToken->expires_at);
                    // $expires_in = $expires_at->diffInRealHours($now);

                    $array = [
                        'message' => 'Inicio de sesión exitoso.',
                        'success' => true,
                        'token' => $token->plainTextToken,
                        'role' => $user->getRoleNames()[0],
                        'requireNewPassword' => (strtotime($user->updated_at) === strtotime($user->created_at)) ? true : false,
                        // 'expiresIn' => $expires_in . " horas",
                        'code' => Response::HTTP_OK
                    ];
                }else{
                    $array = [
                        'message' => 'No estás habilitado para hacer inicio de sesión.',
                        'success' => false,
                        'code' => Response::HTTP_FORBIDDEN
                    ];
                }
            }
        }else{
            $array = [
                'success' => false,
                'message' => 'Las credenciales suministradas son inválidas.',
                'code' => Response::HTTP_BAD_REQUEST
            ];
        }
        return $array;
    }

    /**
     * logout method.
     * 
     * @return array
     */
    public function logout() {
        $id = auth()->id();
        $array = [];

        if (isset($id)) {
            $user = $this->userModel->find($id);
            $user->tokens()->delete();
            $user->remember_token = null;
            $user->update();

            $array = [
                'success' => true,
                'message' => 'Logout exitoso.',
                'code' => Response::HTTP_OK
            ];
        }else{
            $array = [
                'success' => false,
                'message' => 'Error al hacer logout.',
                'code' => Response::HTTP_NOT_FOUND
            ];
        }

        return $array;
    }

    public function refreshToken() : array {
        $array = [];
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();

        if (isset($user)) {
            $user->tokens()->delete();
            $token = $user->createToken("login-" . $user->username);
    
            // $now = Carbon::now();
            // $expires_at = Carbon::parse($token->accessToken->expires_at);
            // $expires_in = $expires_at->diffInRealHours($now);
    
            $array = [
                'success' => true,
                'token' => $token->plainTextToken,
                'user' => [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'lastname' => $user->lastname,
                    'cedula_type' => $user->cedula->type,
                    'cedula_number' => $user->cedula->number,
                    'email' => $user->email,
                    'username' => $user->username,
                    'estado' => $user->estado_id,
                    'ciudad' => $user->ciudad_id,
                    'address' => $user->address,
                    'role' => $user->getRoleNames()[0],
                    'active' => $user->active,
                ],
                // 'enabled' => $user->getRoleNames()[0] === 'Admin' ? true : $user->enabled,
                'requireNewPassword' => (strtotime($user->updated_at) === strtotime($user->created_at)) ? true : false,
                'message' => 'Inicio de sesión exitoso.',
                // 'expiresIn' => $expires_in . " horas",
                'code' => Response::HTTP_OK
            ];
        }else{
            $array = [
                'success' => false,
                'message' => 'Opss, ha ocurrido un error. Por favor cierre su sesión actual.',
                'code' => Response::HTTP_NOT_FOUND
            ];
        }

        return $array;
    }
    
    public function profileInfo() : array {
        $array = [];
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();

        if (isset($user)) {
            $array = [
                'message' => 'Recurso obtenido con éxito.',
                'success' => true,
                'user' => [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'lastname' => $user->lastname,
                    'cedula_type' => $user->cedula->type,
                    'cedula_number' => $user->cedula->number,
                    'email' => $user->email,
                    'username' => $user->username,
                    'estado' => $user->estado_id,
                    'ciudad' => $user->ciudad_id,
                    'address' => $user->address,
                    'role' => $user->getRoleNames()[0],
                    'active' => $user->active,
                ],
                'code' => Response::HTTP_OK
            ];
        }else{
            $array = [
                'success' => false,
                'message' => 'Opss, ha ocurrido un error inesperado.',
                'code' => Response::HTTP_NOT_FOUND
            ];
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
        $user = $this->userModel->where('email', $email)->first();

        if (isset($user)) {
            $verify = DB::table('password_reset_tokens')->where('email', $email)->first();
    
            if (isset($verify)) {
                $verify->delete();
            }
    
            $pin = $this->generateRandomPIN(16);
            $password_reset = DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' =>  $pin,
                'created_at' => Carbon::now()
            ]);
    
            if ($password_reset) {
                // dispatch(new SendForgotPasswordMail($email, $token))->delay(now()->addSeconds(10));
                Mail::to($email)->send(new ForgotPasswordMail($user, $pin));
        
                $array = [
                    'success' => true,
                    'message' => 'Te hemos enviado un email con un enlace para que reestablezcas tu contraseña.',
                    'code' => Response::HTTP_OK
                ];
            }else{
                $array = [
                    'success' => false,
                    'message' => 'Oopss, ha ocurrido un error inesperado.',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ];
            }
        }else{
            $array = [
                'success' => false,
                'message' => 'Usuario no encontrado.',
                'code' => Response::HTTP_NOT_FOUND
            ];
        }
        
        return $array;
    }

    /**
     * User ResetPassword method.
     * 
     * @param array $data
     * @param Request $request
     * @return array
     */
    public function resetPassword(array $data, Request $request) : array {
        $array = [];
        //VERIFICACION DE TOKEN RECIBIDO POR LOS HEADERS
        $token = $request->header('Authorization');

        if (self::verifyPin($token)) {
            //ELIMINAR EL TOKEN DE LA TABLA password_reset_tokens
            $result = DB::table('password_reset_tokens')->where('token', $token)->first();
            $email = $result->email;
            $result->delete();

            $user = User::where('email', $email)->first();
            $user->update([
                'password' => Hash::make($data['password']),
                'active' => true
            ]);
            $user->tokens()->delete();

            Mail::to($user->email)->send(new ResetPasswordMail($user, $data['password']));

            $array = [
                'success' => true,
                'message' => 'La contraseña ha sido restablecida con éxito.',
                'code' => Response::HTTP_OK
            ];
        }else{
            $array = [
                'success' => false,
                'message' => 'Token inválido o caducado.',
                'code' => Response::HTTP_FORBIDDEN
            ];
        }

        return $array;
    }

    /**
     * Método para verificación de PIN para reseteo de passwords de usuarios.
     * 
     * @param string $token
     * @return bool
     */
    public function verifyPin(string $token) : bool {
        $bool = false;
        $check = DB::table('password_reset_tokens')->where('token', $token)->first();
        
        if (isset($check)) {
            $difference = Carbon::now()->diffInSeconds($check->created_at);
            if ($difference <= 3600) {
                $bool = true;
            }
        }
        
        return $bool;
    }

    public function isLoggeIn() : array {
        $bool = false;
        $array = [];

        if (Auth::check() && Auth::user()->active) {
            $bool = true;
        }

        $array = [
            'success' => $bool,
            'message' => $bool ? 'Usuario Autenticado.' : 'Usuario no Autenticado.',
            'code' => $bool ? Response::HTTP_OK : Response::HTTP_FORBIDDEN
        ];

        return $array;
    }

    /**
     * Método para generar un token aleatorio de longitud $length.
     * 
     * @param int $length
     * @return string
     */
    public function generateRandomPIN(int $length) : string {
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}
