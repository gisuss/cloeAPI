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
    }
}
