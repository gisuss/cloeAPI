<?php

namespace App\Repositories\Raees;

use App\Models\{Raee};
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};

class RaeeRepository extends Repository
{
    public function __construct(Raee $model, array $relations = [])
    {
        parent::__construct($model, $relations);
    }

    public function eliminarRaee(int $raee_id) {
        $band = false;
        $raee = $this->model->where('id', $raee_id)->first();
        
        if (isset($raee)) {
            $raee->delete();
            $band = true;
        }

        return $band;
    }

    public function paginate($relations = null, $paginate = 20, $filtersColumns = []) {
        return (!empty($relations))
            ? $this->model::with($relations)->status($filtersColumns)->orderBy('id', 'desc')->paginate($paginate)
            : $this->model::status($filtersColumns)->orderBy('id', 'desc')->paginate($paginate);
    }
}
