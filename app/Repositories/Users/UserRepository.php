<?php

namespace App\Repositories\Users;

use App\Models\{User, Identification};
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\{Collection,Str};
use Illuminate\Support\Facades\{Hash,Mail,Auth};
use Illuminate\Http\{Response,Request};
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class UserRepository extends Repository
{
    public function __construct(User $model, array $relations = [])
    {
        parent::__construct($model, $relations);
    }

    /**
     * Metodo para registrar un nuevo usuario.
     *
     * @param array $data
     */
    public function register(array $data) {
        $pass = $this->generateRandomPIN(6);
        $cedula = Identification::create([
            'type' => $data['ci_type'],
            'number' => $data['ci_number'],
        ]);

        $user = $this->model->create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'ci_id' => $cedula->id,
            'email' => $data['email'],
            'estado_id' => $data['estado_id'],
            'municipio_id' => $data['municipio_id'],
            'centro_id' => isset($data['centro_id']) ? $data['centro_id'] : null,
            'enabled' => $data['role'] === 'Admin' ? true : (isset($data['centro_id']) ? true : false),
            'address' => $data['address'],
            'password' => Hash::make($pass),
            'username' => $this->setUsername($data['name'], $data['lastname']),
            'email_verified_at' => Carbon::now(),
        ]);

        $user->assignRole($data['role']);
        // Mail::to($user->email)->send(new UserRegisterMail($user, $pass, $data['role']));

        return $user;
    }

    /**
     * Metodo activar un usuario.
     *
     * @param int $user
     * @param array $data
     * @return bool
     */
    public function activar(int $user) : bool {
        $band = false;
        $usuario = $this->model->where('id', $user)->first();
        if (isset($usuario) && ($usuario->id <> Auth::user()->id)) {
            $usuario->update([
                'active' => true,
                'enabled' => true,
                'remember_token' => null,
            ]);
            $band = true;
        }
        return $band;
    }

    /**
     * Metodo desactivar un usuario.
     *
     * @param int $user
     * @return bool
     */
    public function desactivar(int $user) : bool {
        $band = false;
        $usuario = $this->model->where('id', $user)->first();
        if ($user <> Auth::user()->id) {
            $usuario->update([
                'active' => false,
                'remember_token' => null
            ]);
            $usuario->tokens()->delete();
            $band = true;
        }
        return $band;
    }

    /**
     * Metodo para eliminar un usuario.
     *
     * @param int $user
     * @return bool
     */
    public function eliminarUser(int $user) : bool {
        $band = false;
        $usuario = $this->model->where('id', $user)->first();
        if (isset($usuario) && $usuario->id != Auth::user()->id) {
            $usuario->update([
                'active' => false,
                'remember_token' => null
            ]);
            $usuario->tokens()->delete();
            $band = true;
        }
        return $band;
    }

    /**
     * Método que genera un username único en el sistema.
     *
     * @param string $first_name
     * @param string $last_name
     * @return string
     */
    public function setUsername(string $first_name, string $last_name) : string {
        $i = 1;
        $nombre = self::eliminarTildes($first_name);
        $apellido = self::eliminarTildes($last_name);

        $strName = explode(" ", $nombre);
        $strLastName = explode(" ", $apellido);

        $nombre = Str::lower($strName[0]);
        $apellido = Str::lower($strLastName[0]);

        $username = substr($nombre, 0, $i).$apellido;

        while (User::where('username', $username)->exists()) {
            $i += 1;
            if ($i <= 2) {
                $username = substr($nombre, 0, $i).$apellido;
            }else{
                $j = $i-1;
                $username = substr($nombre, 0, 2).$apellido.$j;
            }
        }

        return $username;
    }

    /**
     * Método que elimina todo tipo de tildes de una caena pasada por parámetro.
     *
     * @param string $cadena
     * @return string
     */
    public function eliminarTildes(string $cadena) : string {
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena
        );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena
        );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena
        );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena
        );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        return $cadena;
    }

    public function generateRandomPIN($length) {
        return substr(str_shuffle("0123456789"), 0, $length);
    }

    public function paginate($relations = null, $paginate = 20, $filtersColumns = []) {
        return (!empty($relations))
            ? $this->model::with($relations)->orderBy('id', 'desc')->paginate($paginate)
            : $this->model::orderBy('id', 'desc')->paginate($paginate);
    }
}
