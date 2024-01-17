<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(VenezuelaTableSeeder::class); // Creación de Venezuela en la db
        $this->call(RoleSeeder::class); // Creación de Roles en la db
        $this->call(IdentificationSeeder::class); // Creación de Identifications base en la db
        $this->call(UserSeeder::class); // Creación de usuarios de prueba en la db
    }
}
