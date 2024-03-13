<?php

namespace Database\Seeders;

use App\Models\Proceso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $procesos = [
            [ 'name' => 'Separación por densidad' ],
            [ 'name' => 'Separación magnética' ],
            [ 'name' => 'Separación por flotación' ],
            [ 'name' => 'Digestión ácida' ],
            [ 'name' => 'Disolución alcalina' ],
            [ 'name' => 'Biolixiviación' ],
            [ 'name' => 'Biodegradación' ],
        ];

        foreach ($procesos as $proceso) {
            Proceso::create($proceso);
        }
    }
}
