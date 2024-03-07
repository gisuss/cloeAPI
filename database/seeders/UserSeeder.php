<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User};
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'lastname' => 'Cloe',
            'ci_id' => 1,
            'email' => 'admin@cloe.com',
            'address' => 'Guacara',
            'password'  =>  Hash::make('password'),
            'username' => 'admin',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 80,
            'enabled' => true,
        ]);
        $user->assignRole('Admin');
        
        $user2 = User::create([
            'name' => 'Encargado',
            'lastname' => 'Cloe',
            'ci_id' => 2,
            'email' => 'encargado@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'encargado',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user2->assignRole('Encargado');
        
        $user3 = User::create([
            'name' => 'Clasificador',
            'lastname' => 'Cloe',
            'ci_id' => 3,
            'email' => 'clasificador@cloe.com',
            'address' => 'Bejuma',
            'password'  =>  Hash::make('password'),
            'username' => 'clasificador',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 77,
            'enabled' => true,
        ]);
        $user3->assignRole('Clasificador');
        
        $user4 = User::create([
            'name' => 'Separador',
            'lastname' => 'Cloe',
            'ci_id' => 4,
            'email' => 'separador@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'separador',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');
    }
}
