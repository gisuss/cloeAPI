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
        CentroAcopio::create([
            'estado_id' => 22,
            'ciudad_id' => 445,
            'name' => 'Aroa ECO RAEE',
            'description' => 'Centro de acopio principal de Aroa',
            'address' => 'Aroa norte',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 22,
            'ciudad_id' => 449,
            'name' => 'Central Cocorote RAEE',
            'description' => 'Centro de acopio principal de Cocorote',
            'address' => 'Cocorote central',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 22,
            'ciudad_id' => 451,
            'name' => 'Centro de acopio Guama RAEE',
            'description' => 'Centro de acopio principal de Guama',
            'address' => 'Av principal, calle 9, Guama',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 2,
            'ciudad_id' => 15,
            'name' => 'Eco RAEE Guanta',
            'description' => 'Centro de acopio principal de Guanta norte',
            'address' => 'Guanta norte',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 2,
            'ciudad_id' => 4,
            'name' => 'Eco RAEE Anaco',
            'description' => 'Centro de acopio principal de Anaco norte',
            'address' => 'Anaco norte',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 2,
            'ciudad_id' => 16,
            'name' => 'Eco RAEE Lechería',
            'description' => 'Centro de acopio principal de Lechería norte',
            'address' => 'Lechería norte',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 7,
            'ciudad_id' => 112,
            'name' => 'Eco RAEE Ciudad Alianza',
            'description' => 'Centro de acopio principal de Ciudad Alianza',
            'address' => 'Ciudad Alianza calle 4',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 7,
            'ciudad_id' => 109,
            'name' => 'Eco RAEE Canoabo',
            'description' => 'Centro de acopio principal de Canoabo',
            'address' => 'Canoabo calle 4',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 19,
            'ciudad_id' => 386,
            'name' => 'Eco RAEE Colón',
            'description' => 'Centro de acopio principal de Colón',
            'address' => 'Coloncito calle 9',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 19,
            'ciudad_id' => 392,
            'name' => 'Eco RAEE La Fría',
            'description' => 'Centro de acopio principal de La Fría',
            'address' => 'La Fría centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 19,
            'ciudad_id' => 405,
            'name' => 'Eco RAEE San Cristóbal',
            'description' => 'Centro de acopio principal de San Cristóbal',
            'address' => 'San Cristóbal centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 19,
            'ciudad_id' => 413,
            'name' => 'Eco RAEE Ureña',
            'description' => 'Centro de acopio principal de Ureña',
            'address' => 'Ureña centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 23,
            'ciudad_id' => 487,
            'name' => 'RAEE Maracaibo',
            'description' => 'Centro de acopio principal de Maracaibo',
            'address' => 'Maracaibo centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 23,
            'ciudad_id' => 463,
            'name' => 'RAEE Cabimas',
            'description' => 'Centro de acopio principal de Cabimas',
            'address' => 'Cabimas centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 23,
            'ciudad_id' => 483,
            'name' => 'RAEE Lagunillas del Zulia',
            'description' => 'Centro de acopio principal de Lagunillas del Zulia',
            'address' => 'Lagunillas del Zulia centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 23,
            'ciudad_id' => 475,
            'name' => 'RAEE El Mené',
            'description' => 'Centro de acopio principal de El Mené',
            'address' => 'El Mené centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 23,
            'ciudad_id' => 469,
            'name' => 'RAEE Chiquinquirá',
            'description' => 'Centro de acopio principal de Chiquinquirá',
            'address' => 'Chiquinquirá centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 23,
            'ciudad_id' => 503,
            'name' => 'RAEE Santa Rita',
            'description' => 'Centro de acopio principal de Santa Rita',
            'address' => 'Santa Rita centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 24,
            'ciudad_id' => 149,
            'name' => 'RAEE Sabana Grande',
            'description' => 'Centro de acopio principal de Sabana Grande',
            'address' => 'Sabana Grande, libertador',
        ]);

        CentroAcopio::create([
            'estado_id' => 24,
            'ciudad_id' => 149,
            'name' => 'RAEE Coche',
            'description' => 'Centro de acopio principal de Coche',
            'address' => 'Coche centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 24,
            'ciudad_id' => 149,
            'name' => 'RAEE El Paraíso',
            'description' => 'Centro de acopio principal de El Paraíso',
            'address' => 'El Paraíso centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 11,
            'ciudad_id' => 209,
            'name' => 'RAEE Zaraza',
            'description' => 'Centro de acopio principal de Zaraza',
            'address' => 'Zaraza centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 11,
            'ciudad_id' => 207,
            'name' => 'RAEE Tucupido',
            'description' => 'Centro de acopio principal de Tucupido',
            'address' => 'Tucupido centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 11,
            'ciudad_id' => 184,
            'name' => 'RAEE Calabozo',
            'description' => 'Centro de acopio principal de Calabozo',
            'address' => 'Calabozo centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 11,
            'ciudad_id' => 196,
            'name' => 'RAEE Chaguaramas Guárico',
            'description' => 'Centro de acopio principal de Chaguaramas Guárico',
            'address' => 'Chaguaramas Guárico centro',
        ]);
        
        CentroAcopio::create([
            'estado_id' => 11,
            'ciudad_id' => 182,
            'name' => 'RAEE Altagracia de Orituco',
            'description' => 'Centro de acopio principal de Altagracia de Orituco',
            'address' => 'Altagracia de Orituco centro',
        ]);
    }
}
