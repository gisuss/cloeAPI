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
            ['type' => 'E', 'number' => '86898321' ],
            ['type' => 'V', 'number' => '21345662' ],
            ['type' => 'V', 'number' => '21345333' ],
            ['type' => 'V', 'number' => '21000989' ],
            ['type' => 'V', 'number' => '2134567' ],
            ['type' => 'E', 'number' => '65987900' ],
            ['type' => 'J', 'number' => '23654785' ],
            ['type' => 'E', 'number' => '81234000' ],
            ['type' => 'V', 'number' => '22786909' ],
            ['type' => 'V', 'number' => '24555432' ],
            ['type' => 'E', 'number' => '82345678' ],
            ['type' => 'J', 'number' => '12987345' ],
            ['type' => 'E', 'number' => '88990323' ],
            ['type' => 'V', 'number' => '22345234' ],
            ['type' => 'V', 'number' => '22123321' ],
            ['type' => 'V', 'number' => '25765494' ],
            ['type' => 'V', 'number' => '26589345' ],
            ['type' => 'J', 'number' => '99092344' ],
            ['type' => 'V', 'number' => '9909332' ],
            ['type' => 'E', 'number' => '90212345' ],
            ['type' => 'V', 'number' => '24323456' ],
            ['type' => 'V', 'number' => '20764234' ],
            ['type' => 'J', 'number' => '21345657' ],
            ['type' => 'V', 'number' => '22345654' ],
            ['type' => 'J', 'number' => '12323453' ],
            ['type' => 'V', 'number' => '21909863' ],
            ['type' => 'V', 'number' => '22345432' ],
        ];

        foreach($identifications as $identification) {
            Identification::create($identification);
        }
    }
}
