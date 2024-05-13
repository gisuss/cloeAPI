<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{CentroAcopio, User};

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
            'municipio_id' => 86,
            'name' => 'Eco RAEE',
            'description' => 'Centro de acopio principal de valencia norte',
            'address' => 'Valencia norte',
        ]);

        $encargados = User::role('Encargado')->get();
        foreach ($encargados as $encargado) {
            $encargado->update([
                'centro_id' => $centro->id,
                'enabled' => true,
            ]);
        }
        
        $clasificadores = User::role('Clasificador')->get();
        foreach ($clasificadores as $clasificador) {
            $clasificador->update([
                'centro_id' => $centro->id,
                'enabled' => true,
            ]);
        }
        
        $separadores = User::role('Separador')->get();
        foreach ($separadores as $separador) {
            $separador->update([
                'centro_id' => $centro->id,
                'enabled' => true,
            ]);
        }
    }
}
