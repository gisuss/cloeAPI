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
            ['type' => 'V', 'number' => '12098112' ],
            ['type' => 'V', 'number' => '11222111' ],
            ['type' => 'V', 'number' => '22333222' ],
            ['type' => 'V', 'number' => '33222333' ],
            ['type' => 'V', 'number' => '44333444' ],
            ['type' => 'V', 'number' => '55444555' ],
            ['type' => 'V', 'number' => '66555666' ],
            ['type' => 'V', 'number' => '77666777' ],
            ['type' => 'V', 'number' => '88777888' ],
            ['type' => 'V', 'number' => '99888999' ],
            ['type' => 'V', 'number' => '11000111' ],
            ['type' => 'V', 'number' => '22000111' ],
            ['type' => 'V', 'number' => '33000222' ],
            ['type' => 'V', 'number' => '44000333' ],
            ['type' => 'V', 'number' => '55000444' ],
            ['type' => 'V', 'number' => '55000444' ],
            ['type' => 'V', 'number' => '66000555' ],
            ['type' => 'V', 'number' => '77666000' ],
            ['type' => 'V', 'number' => '88777000' ],
            ['type' => 'V', 'number' => '99000888' ],
        ];

        foreach($identifications as $identification) {
            Identification::create($identification);
        }
    }
}
