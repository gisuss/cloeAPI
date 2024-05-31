<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComponentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $materials = [];
        $procesos = [];

        $m = $this->materials;
        $p = $this->processes;

        foreach ($m as $value) {
            array_push($materials, $value->name);
        }
        
        foreach ($p as $value) {
            array_push($procesos, $value->name);
        }

        return [
            'raee_name' => $this->raee->model . ' / ' . $this->raee->marca->name,
            'component_id' => $this->id,
            'name' => $this->name,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
            'reusable' => $this->reusable ? 1 : 0,
            'materials' => $materials,
            'process' => $procesos,
        ];
    }
}
