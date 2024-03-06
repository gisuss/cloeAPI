<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Identification;

class IdentificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $identifications = [
            ['type' => 'V', 'number' => '12345678' ],
            ['type' => 'E', 'number' => '8765432' ],
            ['type' => 'V', 'number' => '12098112' ],
            ['type' => 'J', 'number' => '180987625' ],
        ];

        foreach($identifications as $identification) {
            Identification::create($identification);
        }
    }
}
