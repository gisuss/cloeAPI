<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            ['name' => 'Aluminio'],
            ['name' => 'Caucho'],
            ['name' => 'Cerámica'],
            ['name' => 'Corcho'],
            ['name' => 'Goma'],
            ['name' => 'Madera'],
            ['name' => 'Metal'],
            ['name' => 'Oro'],
            ['name' => 'Papel'],
            ['name' => 'Piedra'],
            ['name' => 'Plástico'],
            ['name' => 'Plata'],
            ['name' => 'Textil'],
            ['name' => 'Vidrio'],
            ['name' => 'Varios'],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
