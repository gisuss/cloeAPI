<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Role,Permission};


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Encargado']);
        Role::create(['name' => 'Clasificador']);
        Role::create(['name' => 'Separador']);
        Role::create(['name' => 'Desactivado']);
    }
}
