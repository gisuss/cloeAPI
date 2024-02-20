<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CentroAcopio;

class CentroAcopioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centro = CentroAcopio::create([
            'encargado_id' => 1,
            'estado_id' => 7,
            'ciudad_id' => 127,
            'description' => 'Centro de acopio principal de valencia norte',
            'address' => 'Valencia norte',
        ]);
    }
}
