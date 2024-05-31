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
        $this->call(VenezuelaTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(IdentificationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CentroAcopioSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(LineSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(ProcesoSeeder::class);
        $this->call(RaeeSeeder::class);
        $this->call(ComponentSeeder::class);
    }
}
