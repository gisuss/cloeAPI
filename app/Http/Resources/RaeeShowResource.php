<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaeeShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $components = [];
        $compts = $this->components;
        foreach ($compts as $comp) {
            $components[] = [
                'id' => $comp->id,
                'name' => $comp->name,
                'weight' => $comp->weight,
                'dimensions' => $comp->dimensions,
                'reusable' => $comp->reusable,
                'observations' => $comp->observations,
                'materials' => $comp->materials->pluck('name'),
                'process' => $comp->processes->pluck('name'),
            ];
        }

        return [
            'raee' => [
                'brand' => $this->marca->name,
                'model' => $this->model,
                'category' => $this->category->name,
                'line' => $this->linea->name
            ],
            'components' => $components,
        ];
    }
}
