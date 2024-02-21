<?php

namespace App\Repositories\CentrosAcopio;

use App\Models\{CentroAcopio, User};
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\{Collection,Str};
use Illuminate\Support\Facades\{Hash,Mail,Auth,Storage, DB};
use Illuminate\Http\{Response,Request};
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class CentrosAcopioRepository extends Repository
{
    public function __construct(CentroAcopio $model, array $relations = [])
    {
        parent::__construct($model, $relations);
    }

    /**
     * Metodo para registrar un nuevo Centro de Acopio.
     *
     * @param array $data
     * @return array
     */
    public function register(array $data) : array {
        $array = [];

        $centro = $this->model->create($data);

        if ($centro) {
            $array = [
                'success' => true,
                'message' => 'Excelente, el centro de acopio se ha registrado con éxito.',
                'code' => Response::HTTP_OK
            ];
        }else{
            $array = [
                'success' => false,
                'message' => 'Error al intentar crear el centro de acopio.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }

        return $array;
    }

    /**
     * Metodo para actualizar un Centro de Acopio.
     *
     * @param array $data
     * @param int $centro_id
     * @return array
     */
    public function actualizar(array $data, int $centro_id) : array {
        $array = [];
        $centro = $this->model->where('id', $centro_id)->first();

        if ($centro) {
            $update = $centro->update($data);

            if ($update) {
                $array = [
                    'success' => true,
                    'message' => 'Excelente, el centro de acopio ha sido actualizado con éxito.',
                    'code' => Response::HTTP_OK
                ];
            }else{
                $array = [
                    'success' => false,
                    'message' => 'Error al intentar actualizar el recurso.',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ];
            }
        }else{
            $array = [
                'success' => false,
                'message' => 'Error al intentar encontrar el centro de acopio.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }

        return $array;
    }

    public function paginate($relations = null, $paginate = 20, $filtersColumns = []) {
        return (!empty($relations))
            ? $this->model::with($relations)->filterLocation($filtersColumns)->orderBy('id', 'desc')->paginate($paginate)
            : $this->model::filterLocation($filtersColumns)->orderBy('id', 'desc')->paginate($paginate);
    }
}
