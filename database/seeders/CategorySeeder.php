<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [ 'name' => 'Refrigeradores y congeladores', 'line_id' => 1 ],
            [ 'name' => 'Lavadoras y secadoras', 'line_id' => 1 ],
            [ 'name' => 'Lavavajillas', 'line_id' => 1 ],
            [ 'name' => 'Estufas y hornos', 'line_id' => 1 ],
            [ 'name' => 'Aires acondicionados', 'line_id' => 1 ],
            [ 'name' => 'Calentadores de agua', 'line_id' => 1 ],
            [ 'name' => 'Aspiradoras', 'line_id' => 1 ],
            [ 'name' => 'Tostadoras', 'line_id' => 4 ],
            [ 'name' => 'Cafeteras', 'line_id' => 4 ],
            [ 'name' => 'Licuadoras', 'line_id' => 4 ],
            [ 'name' => 'Batidoras', 'line_id' => 4 ],
            [ 'name' => 'Hervidores de agua', 'line_id' => 1 ],
            [ 'name' => 'Planchas', 'line_id' => 4 ],
            [ 'name' => 'Secadores de pelo', 'line_id' => 4 ],
            [ 'name' => 'Afeitadoras eléctricas', 'line_id' => 4 ],
            [ 'name' => 'Ordenadores', 'line_id' => 3 ],
            [ 'name' => 'Teléfonos móviles', 'line_id' => 3 ],
            [ 'name' => 'Tabletas', 'line_id' => 3 ],
            [ 'name' => 'Televisores', 'line_id' => 2 ],
            [ 'name' => 'Equipos de sonido', 'line_id' => 2 ],
            [ 'name' => 'Cámaras', 'line_id' => 2 ],
            [ 'name' => 'Routers', 'line_id' => 2 ],
            [ 'name' => 'Impresoras', 'line_id' => 3 ],
            [ 'name' => 'Radios', 'line_id' => 2 ],
            [ 'name' => 'Reproductores de CD y DVD', 'line_id' => 2 ],
            [ 'name' => 'Videoconsolas', 'line_id' => 2 ],
            [ 'name' => 'Relojes', 'line_id' => 3 ],
            [ 'name' => 'Calculadoras', 'line_id' => 3 ],
            [ 'name' => 'Juguetes electrónicos', 'line_id' => 3 ],
            [ 'name' => 'Bombillas', 'line_id' => 3 ],
            [ 'name' => 'Lámparas', 'line_id' => 3 ],
            [ 'name' => 'Linternas', 'line_id' => 3 ],
            [ 'name' => 'Luces LED', 'line_id' => 3 ],
            [ 'name' => 'Taladros', 'line_id' => 4 ],
            [ 'name' => 'Sierras', 'line_id' => 4 ],
            [ 'name' => 'Lijadoras', 'line_id' => 4 ],
            [ 'name' => 'Martillos', 'line_id' => 4 ],
            [ 'name' => 'Destornilladores', 'line_id' => 4 ],
            [ 'name' => 'Máquinas de rayos X', 'line_id' => 1 ],
            [ 'name' => 'Equipos de resonancia magnética', 'line_id' => 1 ],
            [ 'name' => 'Tomógrafos computarizados', 'line_id' => 1 ],
            [ 'name' => 'Monitores de pacientes', 'line_id' => 1 ],
            [ 'name' => 'Equipos de anestesia', 'line_id' => 1 ],
            [ 'name' => 'Motores', 'line_id' => 1 ],
            [ 'name' => 'Generadores', 'line_id' => 1 ],
            [ 'name' => 'Bombas', 'line_id' => 1 ],
            [ 'name' => 'Compresores', 'line_id' => 1 ],
            [ 'name' => 'Transformadores', 'line_id' => 1 ],
            [ 'name' => 'Termómetros', 'line_id' => 1 ],
            [ 'name' => 'Manómetros', 'line_id' => 1 ],
            [ 'name' => 'Voltímetros', 'line_id' => 4 ],
            [ 'name' => 'Amperímetros', 'line_id' => 4 ],
            [ 'name' => 'Óhmetros', 'line_id' => 4 ],
            [ 'name' => 'Baterías', 'line_id' => 4 ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
