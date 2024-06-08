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
            'name' => 'Pin de carga Galaxy A54 5G',
            'weight' => 0.013,
            'dimensions' => '12x5x0.03',
            'reusable' => false,
            'separated_by' => 4,
            'raee_id' => 1,
            'observations' => 'Pantalla en buen estado.'
        ]);
        $component->materials()->attach([11,9]);
        $component->processes()->attach([2]);
        
        $component = Component::create([
            'name' => 'Carcasa Galaxy A54 5G',
            'weight' => 110,
            'dimensions' => '12x5x0.5',
            'reusable' => true,
            'separated_by' => 4,
            'raee_id' => 1,
            'observations' => 'Carcasa en muy buen estado.'
        ]);
        $component->materials()->attach([11,9]);
        $component->processes()->attach([2]);
        
        $component = Component::create([
            'name' => 'Modulo cámara Galaxy A54 5G',
            'weight' => 4,
            'dimensions' => '2x2x0.10',
            'reusable' => false,
            'separated_by' => 4,
            'raee_id' => 1,
            'observations' => 'Modulo el mal estado.'
        ]);
        $component->materials()->attach([1,12]);
        $component->processes()->attach([2,3,4]);
        
        $component = Component::create([
            'name' => 'Modulo de encendido Galaxy A54 5G',
            'weight' => 0.10,
            'dimensions' => '1x2.2x0.052',
            'reusable' => true,
            'separated_by' => 4,
            'raee_id' => 1,
            'observations' => 'Modulo en buen estado.'
        ]);
        $component->materials()->attach([11,12,15]);
        $component->processes()->attach([2,3,4]);
        
        $component = Component::create([
            'name' => 'Carcasa Ipad pro',
            'weight' => 120,
            'dimensions' => '17x19x0.96',
            'reusable' => true,
            'separated_by' => 4,
            'raee_id' => 3,
            'observations' => 'Reutilizable.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,6]);
        
        $component = Component::create([
            'name' => 'Tarjeta lógica Ipad pro',
            'weight' => 90,
            'dimensions' => '17x19x0.5',
            'reusable' => true,
            'separated_by' => 4,
            'raee_id' => 3,
            'observations' => 'Modulo en buen estado y funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,6]);
        
        $component = Component::create([
            'name' => 'Pin de carga Ipad pro',
            'weight' => 25,
            'dimensions' => '2x3x0.015',
            'reusable' => false,
            'separated_by' => 4,
            'raee_id' => 3,
            'observations' => 'Modulo en corto, no funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,6]);
        
        $component = Component::create([
            'name' => 'Pantalla Ipad pro',
            'weight' => 15,
            'dimensions' => '17x19x0.015',
            'reusable' => true,
            'separated_by' => 4,
            'raee_id' => 3,
            'observations' => 'Pantalla operativa y funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,6]);
        
        $component = Component::create([
            'name' => 'Pantalla retina',
            'weight' => 0.87,
            'dimensions' => '60x45x0.25',
            'reusable' => true,
            'separated_by' => 24,
            'raee_id' => 6,
            'observations' => 'Componente reusable.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
        
        $component = Component::create([
            'name' => 'Carcasa de plastico',
            'weight' => 1050,
            'dimensions' => '65x50x10',
            'reusable' => false,
            'separated_by' => 23,
            'raee_id' => 6,
            'observations' => 'Carcasa inservible.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
        
        $component = Component::create([
            'name' => 'Inyector de tinta continua',
            'weight' => 30,
            'dimensions' => '3x1x1.15',
            'reusable' => true,
            'separated_by' => 8,
            'raee_id' => 9,
            'observations' => 'Inyector de yinta funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
        
        $component = Component::create([
            'name' => 'Mecanismo y motor láser',
            'weight' => 250,
            'dimensions' => '5x33x3.34',
            'reusable' => false,
            'separated_by' => 8,
            'raee_id' => 9,
            'observations' => 'Mecanismo no funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
        
        $component = Component::create([
            'name' => 'Tarjeta lógica',
            'weight' => 130,
            'dimensions' => '3x60x35',
            'reusable' => false,
            'separated_by' => 24,
            'raee_id' => 11,
            'observations' => 'No funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
        
        $component = Component::create([
            'name' => 'Conmutador de sonido',
            'weight' => 45,
            'dimensions' => '3x7x2',
            'reusable' => false,
            'separated_by' => 8,
            'raee_id' => 12,
            'observations' => 'No funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
        
        $component = Component::create([
            'name' => 'Modulo láser',
            'weight' => 15,
            'dimensions' => '3x3x2',
            'reusable' => true,
            'separated_by' => 8,
            'raee_id' => 12,
            'observations' => 'Funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
        
        $component = Component::create([
            'name' => 'Motor compresor',
            'weight' => 3000,
            'dimensions' => '30x36x40',
            'reusable' => false,
            'separated_by' => 8,
            'raee_id' => 15,
            'observations' => 'Funcional.'
        ]);
        $component->materials()->attach([1,7,15]);
        $component->processes()->attach([2,3,5,6]);
    }
}
