<?php

namespace App\Repositories\Components;

use App\Models\{Component, Raee};
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};

class ComponentRepository extends Repository
{
    public function __construct(Component $model, array $relations = [])
    {
        parent::__construct($model, $relations);
    }

    public function store(array $data) {
        $raee = Raee::where('id', $data['raee_id'])->first();

        foreach ($data['components'] as $value) {
            $component = $this->model->create([
                'name' => $value['name'],
                'weight' => $value['weight'],
                'dimensions' => $value['dimensions'],
                'reusable' => $value['reusable'],
                'separated_by' => Auth::user()->id,
                'raee_id' => $raee->id
            ]);

            $component->materials()->attach($value['materials']);
            $component->process()->attach($value['process']);
        }

        $raee->update([
            'status' => 'Separado'
        ]);
        
        return true;
    }

    public function paginate($relations = null, $paginate = 20, $filtersColumns = []) {
        return (!empty($relations))
            ? $this->model::with($relations)->orderBy('id', 'desc')->paginate($paginate)
            : $this->model::orderBy('id', 'desc')->paginate($paginate);
    }
}
