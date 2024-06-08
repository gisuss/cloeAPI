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
            'clasified_by' => 6,
            'model' => 'Galaxy A54 5G',
            'information' => 'Bateria y pantalla mala',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 1,
            'brand_id' => 11,
            'line_id' => 4,
            'category_id' => 17,
            'clasified_by' => 6,
            'model' => 'Iphone 12',
            'information' => 'No enciende, pantalla partida',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 1,
            'brand_id' => 11,
            'line_id' => 4,
            'category_id' => 18,
            'clasified_by' => 6,
            'model' => 'Ipad pro',
            'information' => 'Pin de carga malo, no enciende',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 1,
            'brand_id' => 149,
            'line_id' => 4,
            'category_id' => 17,
            'clasified_by' => 6,
            'model' => 'Galaxy J7',
            'information' => 'Bateria y pantalla mala',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 1,
            'brand_id' => 149,
            'line_id' => 4,
            'category_id' => 17,
            'clasified_by' => 6,
            'model' => 'Galaxy S3 mini',
            'information' => 'Bateria y pantalla mala',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 6,
            'brand_id' => 11,
            'line_id' => 3,
            'category_id' => 19,
            'clasified_by' => 25,
            'model' => 'iTV Magic 3030',
            'information' => 'Condensadores malos y pantalla partida',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 5,
            'brand_id' => 74,
            'line_id' => 3,
            'category_id' => 19,
            'clasified_by' => 12,
            'model' => 'Tv lcd 42 pulgadas L42F6',
            'information' => 'No enciende',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 6,
            'brand_id' => 60,
            'line_id' => 4,
            'category_id' => 25,
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
            'centro_id' => 2,
            'brand_id' => 46,
            'line_id' => 2,
            'category_id' => 20,
            'clasified_by' => 10,
            'model' => 'Barra De Sonido Estéreo Para Computadora',
            'information' => 'Enciende, pero no suena',
            'status' => 'Separado'
        ]);
        
        Raee::create([
            'centro_id' => 2,
            'brand_id' => 182,
            'line_id' => 4,
            'category_id' => 16,
            'clasified_by' => 9,
            'model' => 'Laptop Toshiba A105 S4034 17puLG',
            'information' => 'No enciende, bateria mala, carcasa en mal estado',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 2,
            'brand_id' => 3,
            'line_id' => 2,
            'category_id' => 16,
            'clasified_by' => 9,
            'model' => 'Monitores 19 Pulgadas',
            'information' => 'No enciende, bateria mala, carcasa en mal estado',
            'status' => 'Clasificado'
        ]);
        
        Raee::create([
            'centro_id' => 2,
            'brand_id' => 64,
            'line_id' => 1,
            'category_id' => 1,
            'clasified_by' => 9,
            'model' => 'Refrigerador Congelador Horizontal 300 Litros Dual',
            'information' => 'No funciona',
            'status' => 'Clasificado'
        ]);
    }
}
