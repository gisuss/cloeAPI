<?php

namespace Database\Seeders;

use App\Models\Raee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RaeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Raee::create([
            'centro_id' => 1,
            'brand_id' => 149,
            'line_id' => 4,
            'category_id' => 17,
            'clasified_by' => 1,
            'model' => 'Samsung Galaxy A54 5G',
            'information' => 'Bateria y pantalla mala',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 6,
            'brand_id' => 11,
            'line_id' => 3,
            'category_id' => 19,
            'clasified_by' => 21,
            'model' => 'iTV Magic 3030',
            'information' => 'Condensadores malos y pantalla partida',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 5,
            'brand_id' => 20,
            'line_id' => 3,
            'category_id' => 19,
            'clasified_by' => 12,
            'model' => 'TV plano',
            'information' => 'No enciende',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 6,
            'brand_id' => 60,
            'line_id' => 4,
            'category_id' => 23,
            'clasified_by' => 10,
            'model' => 'Impresora laser k333',
            'information' => 'No enciende',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 2,
            'brand_id' => 60,
            'line_id' => 4,
            'category_id' => 23,
            'clasified_by' => 6,
            'model' => 'Impresora laser k334',
            'information' => 'Toner pegado',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 4,
            'brand_id' => 38,
            'line_id' => 2,
            'category_id' => 22,
            'clasified_by' => 3,
            'model' => 'Antena cisco l3',
            'information' => 'Problemas de encendido',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 4,
            'brand_id' => 38,
            'line_id' => 2,
            'category_id' => 22,
            'clasified_by' => 20,
            'model' => 'Switch cisco wireless 1000mbps',
            'information' => 'No recibe señal',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 6,
            'brand_id' => 78,
            'line_id' => 1,
            'category_id' => 1,
            'clasified_by' => 9,
            'model' => 'SL2250',
            'information' => 'Motor malo',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 1,
            'brand_id' => 80,
            'line_id' => 2,
            'category_id' => 9,
            'clasified_by' => 12,
            'model' => 'FAST 2121',
            'information' => 'No enciende',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 2,
            'brand_id' => 55,
            'line_id' => 1,
            'category_id' => 7,
            'clasified_by' => 21,
            'model' => 'KL54',
            'information' => 'Motor malo',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 6,
            'brand_id' => 79,
            'line_id' => 2,
            'category_id' => 15,
            'clasified_by' => 16,
            'model' => 'Tipo cero',
            'information' => 'No enciende',
            'status' => 'Clasificado'
        ]);
    }
}
