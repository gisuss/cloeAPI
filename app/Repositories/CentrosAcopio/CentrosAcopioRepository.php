<?php

namespace App\Repositories\CentrosAcopio;

use App\Models\{CentroAcopio, User};
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

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
     */
    public function register(array $data) {
        $centro = $this->model->create(array_merge($data, ['active' => true]));
        
        if (isset($centro)) {
            $user = User::find($data['encargado_id']);
            $user->update([
                'centro_id' => $centro->id,
                'enabled' => true,
            ]);
        }

        return $centro;
    }

    /**
     * Metodo para actualizar un Centro de Acopio.
     *
     * @param array $data
     * @param int $centro_id
     * @return bool
     */
    public function actualizar(array $data, int $centro_id) : bool {
        $bool = false;
        $centro = $this->model->where('id', $centro_id)->first();

        if (isset($centro)) {
            $update = $centro->update($data);

            if ($update) {
                $bool = true;
            }
        }

        return $bool;
    }

    public function paginate($relations = null, $paginate = 20, $filtersColumns = []) {
        return (!empty($relations))
            ? $this->model::with($relations)->filterLocation($filtersColumns)->orderBy('id', 'desc')->paginate($paginate)
            : $this->model::filterLocation($filtersColumns)->orderBy('id', 'desc')->paginate($paginate);
    }
    
    public function getWithoutPaginate($filtersColumns = []) {
        return $this->model::filterLocation($filtersColumns)->orderBy('id', 'desc')->get();
    }
}
