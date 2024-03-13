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

    public function store(array $data) {
        $raee = $this->model->create([
            'brand_id' => $data['brand_id'],
            'line_id' => $data['line_id'],
            'category_id' => $data['category_id'],
            'model' => $data['model'],
            'information' => $data['information'],
            'clasified_by' => Auth::user()->id,
            'centro_id' => Auth::user()->centro_id,
            'status' => 'Clasificado',
        ]);

        return $raee;
    }

    public function eliminarRaee(int $raee_id) {
        $band = false;
        $raee = $this->model->find($raee_id);
        
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
