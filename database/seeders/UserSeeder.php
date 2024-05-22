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

        $user4 = User::create([
            'name' => 'Julio Cesar',
            'lastname' => 'Ramos',
            'ci_id' => 5,
            'email' => 'jlramos@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'jlramos',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Juan Wu',
            'lastname' => 'Rivas',
            'ci_id' => 6,
            'email' => 'wurivas@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'wrivas',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Paul Jose',
            'lastname' => 'Reyes',
            'ci_id' => 7,
            'email' => 'separador99@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'jpreyes',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'José Raul',
            'lastname' => 'Zaraza',
            'ci_id' => 8,
            'email' => 'separador89@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'rzaraza',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'David',
            'lastname' => 'Suarez',
            'ci_id' => 9,
            'email' => 'separador566@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'sdavid',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Angela',
            'lastname' => 'Lopez',
            'ci_id' => 10,
            'email' => 'separador212@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'alopez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Freddymar Maria',
            'lastname' => 'Oropeza',
            'ci_id' => 11,
            'email' => 'separador21@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'ofreddy',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Santiago',
            'lastname' => 'Laos',
            'ci_id' => 12,
            'email' => 'separador34@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'slaos',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Yessica',
            'lastname' => 'Swan',
            'ci_id' => 13,
            'email' => 'separador45@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'yswan2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Daniela Josefa',
            'lastname' => 'Martinez',
            'ci_id' => 14,
            'email' => 'separador44@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'dmartinez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Mary',
            'lastname' => 'Lopez',
            'ci_id' => 15,
            'email' => 'separador33@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'mlopez2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Maria Antonela',
            'lastname' => 'Lopez',
            'ci_id' => 16,
            'email' => 'separador9@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'malopez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Yesenia',
            'lastname' => 'Durand',
            'ci_id' => 17,
            'email' => 'separador8@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'ydurand2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Valeria',
            'lastname' => 'Carrazco',
            'ci_id' => 18,
            'email' => 'separador7@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'vcarrazco',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Carlos',
            'lastname' => 'Suarez',
            'ci_id' => 19,
            'email' => 'separador6@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'scarlos3',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Paul Daniel',
            'lastname' => 'Clark Ramos',
            'ci_id' => 20,
            'email' => 'separador5@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'rpclark',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Isamar',
            'lastname' => 'Uzcategui',
            'ci_id' => 21,
            'email' => 'separador4@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'iuzcategui',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Daniela Avila',
            'lastname' => 'Rivas',
            'ci_id' => 22,
            'email' => 'separador1@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'darivas1',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Tomas',
            'lastname' => 'Lu',
            'ci_id' => 23,
            'email' => 'separador2@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'lutomas',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Luisana del Valle',
            'lastname' => 'Uribe',
            'ci_id' => 24,
            'email' => 'separador3@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'luribe3',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'municipio_id' => 90,
            'enabled' => true,
        ]);
        $user4->assignRole('Separador');
    }
}
