<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $component = Component::create([
            'name' => 'Pantalla',
            'weight' => 0.013,
            'dimensions' => '12x5x0.03',
            'reusable' => true,
            'separated_by' => 13,
            'raee_id' => 2,
            'observations' => 'pantalla en buen estado'
        ]);
        $component->materials()->attach([11,9]);
        $component->processes()->attach([2]);
        
        $component = Component::create([
            'name' => 'Modulo cámara',
            'weight' => 0.90,
            'dimensions' => '2x2x0.10',
            'reusable' => false,
            'separated_by' => 13,
            'raee_id' => 2,
            'observations' => 'modulo el mal estado'
        ]);
        $component->materials()->attach([1,12]);
        $component->processes()->attach([2,3,4]);
        
        $component = Component::create([
            'name' => 'Modulo de encendido',
            'weight' => 0.10,
            'dimensions' => '5x4x0.50',
            'reusable' => false,
            'separated_by' => 24,
            'raee_id' => 7,
            'observations' => 'modulo el mal estado'
        ]);
        $component->materials()->attach([11,12,15]);
        $component->processes()->attach([2,3,4]);
        
        $component = Component::create([
            'name' => 'carcasa',
            'weight' => 1,
            'dimensions' => '60x40x5',
            'reusable' => true,
            'separated_by' => 24,
            'raee_id' => 7,
            'observations' => 'carcasa reutilizable'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,6]);
        
        $component = Component::create([
            'name' => 'mecanismo laser',
            'weight' => 0.87,
            'dimensions' => '75x2x0.5',
            'reusable' => false,
            'separated_by' => 24,
            'raee_id' => 5,
            'observations' => 'componente no reusable'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
    }
}
