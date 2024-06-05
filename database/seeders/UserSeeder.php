<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{CentroAcopio, User};
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
            'name' => 'Administrador',
            'lastname' => 'Cloe',
            'ci_id' => 1,
            'email' => 'admin@cloe.com',
            'address' => 'Guacara',
            'password'  =>  Hash::make('password'),
            'username' => 'admin',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'ciudad_id' => 124,
            'enabled' => true,
        ]);
        $user->assignRole('Admin');

        // VALENCIA

        $user2 = User::create([
            'name' => 'Juan Carlos',
            'lastname' => 'Lopez',
            'ci_id' => 2,
            'email' => 'encargado@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'jclopez1',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'ciudad_id' => 122,
            'enabled' => true,
        ]);
        $user2->assignRole('Encargado');

        $centro = CentroAcopio::create([
            'encargado_id' => $user2->id,
            'estado_id' => 7,
            'ciudad_id' => 127,
            'name' => 'Eco RAEE',
            'description' => 'Centro de acopio principal de valencia norte',
            'address' => 'Valencia norte',
        ]);

        $user2->update([
            'centro_id' => $centro->id
        ]);
        
        $user3 = User::create([
            'name' => 'Roberto Antonio',
            'lastname' => 'Sulbarán',
            'ci_id' => 3,
            'email' => 'clasificador@cloe.com',
            'address' => 'Bejuma',
            'password'  =>  Hash::make('password'),
            'username' => 'rsulbaran',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'ciudad_id' => 106,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user3->assignRole('Clasificador');
        
        $user4 = User::create([
            'name' => 'Maria Daniela',
            'lastname' => 'Guarda',
            'ci_id' => 4,
            'email' => 'm.guarda@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'mguarda',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'ciudad_id' => 122,
            'enabled' => true,
            'centro_id' => $centro->id
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
            'ciudad_id' => 127,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Juan Yu',
            'lastname' => 'Rivas',
            'ci_id' => 6,
            'email' => 'wurivas@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'jwrivas',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'ciudad_id' => 108,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Clasificador');

        // ARAGUA

        $user4 = User::create([
            'name' => 'Paul José',
            'lastname' => 'Reyes',
            'ci_id' => 7,
            'email' => 'encargado99@cloe.com',
            'address' => 'Aragua',
            'password'  =>  Hash::make('password'),
            'username' => 'jpreyes',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 4,
            'ciudad_id' => 54,
            'enabled' => true,
        ]);
        $user4->assignRole('Encargado');

        $centro = CentroAcopio::create([
            'encargado_id' => $user4->id,
            'estado_id' => 4,
            'ciudad_id' => 64,
            'name' => 'Eco RAEE - Girardot',
            'description' => 'Centro de acopio zona centro de Girardot',
            'address' => 'Calle Bolivar municipio Girardot, Edo. Aragua',
        ]);

        $user4->update([
            'centro_id' => $centro->id
        ]);

        $user4 = User::create([
            'name' => 'José Raul',
            'lastname' => 'Zaraza',
            'ci_id' => 8,
            'email' => 'separador89@cloe.com',
            'address' => 'Aragua',
            'password'  =>  Hash::make('password'),
            'username' => 'rzaraza',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 4,
            'ciudad_id' => 73,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'David',
            'lastname' => 'Suarez',
            'ci_id' => 9,
            'email' => 'clasificador566@cloe.com',
            'address' => 'Aragua',
            'password'  =>  Hash::make('password'),
            'username' => 'sdavid',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 4,
            'ciudad_id' => 69,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Clasificador');

        $user4 = User::create([
            'name' => 'Angela',
            'lastname' => 'Lopez',
            'ci_id' => 10,
            'email' => 'separador212@cloe.com',
            'address' => 'Aragua',
            'password'  =>  Hash::make('password'),
            'username' => 'alopez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 4,
            'ciudad_id' => 72,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Clasificador');

        $user4 = User::create([
            'name' => 'Freddymar Maria',
            'lastname' => 'Oropeza',
            'ci_id' => 11,
            'email' => 'encargado021@cloe.com',
            'address' => 'Aragua',
            'password'  =>  Hash::make('password'),
            'username' => 'ofreddy',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 4,
            'ciudad_id' => 72,
            'enabled' => true,
        ]);
        $user4->assignRole('Encargado');

        $centro = CentroAcopio::create([
            'encargado_id' => $user4->id,
            'estado_id' => 4,
            'ciudad_id' => 59,
            'name' => 'Eco RAEE - Tovar',
            'description' => 'Centro de acopio zona centro de Tovar',
            'address' => 'Calle Bolivar, municipio Tovar, Edo. Aragua',
        ]);

        $user4->update([
            'centro_id' => $centro->id
        ]);

        $user4 = User::create([
            'name' => 'Santiago Daniel',
            'lastname' => 'Laos',
            'ci_id' => 12,
            'email' => 'clasificador0034@cloe.com',
            'address' => 'Aragua',
            'password'  =>  Hash::make('password'),
            'username' => 'slaos',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 4,
            'ciudad_id' => 59,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Clasificador');

        $user4 = User::create([
            'name' => 'Yessica del Carmen',
            'lastname' => 'Swan',
            'ci_id' => 13,
            'email' => 'separadortovar45@cloe.com',
            'address' => 'Aragua',
            'password'  =>  Hash::make('password'),
            'username' => 'yswan2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 4,
            'ciudad_id' => 59,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Separador');

        // DISTRITO CAPITAL

        $user4 = User::create([
            'name' => 'Daniela Josefa',
            'lastname' => 'Martinez',
            'ci_id' => 14,
            'email' => 'separador44@cloe.com',
            'address' => 'Capital',
            'password'  =>  Hash::make('password'),
            'username' => 'dmartinez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 24,
            'ciudad_id' => 149,
            'enabled' => true,
        ]);
        $user4->assignRole('Encargado');

        $centro = CentroAcopio::create([
            'encargado_id' => $user4->id,
            'estado_id' => 24,
            'ciudad_id' => 150,
            'name' => 'Eco RAEE - Libertador',
            'description' => 'Centro de acopio zona centro de Capital',
            'address' => 'Calle urdaneta, municipio libertador, dtto capital',
        ]);

        $user4->update([
            'centro_id' => $centro->id
        ]);

        $user4 = User::create([
            'name' => 'Mary Carmen',
            'lastname' => 'Lopez',
            'ci_id' => 15,
            'email' => 'separador303@cloe.com',
            'address' => 'Capital',
            'password'  =>  Hash::make('password'),
            'username' => 'mlopez2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 24,
            'ciudad_id' => 150,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Maria Antonela',
            'lastname' => 'Lopez',
            'ci_id' => 16,
            'email' => 'clasificador909@cloe.com',
            'address' => 'Capital',
            'password'  =>  Hash::make('password'),
            'username' => 'malopez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 24,
            'ciudad_id' => 149,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Clasificador');

        // LARA

        $user4 = User::create([
            'name' => 'Yesenia Josefina',
            'lastname' => 'Durand Martínez',
            'ci_id' => 17,
            'email' => 'encargado809@cloe.com',
            'address' => 'Lara',
            'password'  =>  Hash::make('password'),
            'username' => 'ydurand2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 12,
            'ciudad_id' => 219,
            'enabled' => true,
        ]);
        $user4->assignRole('Encargado');

        $centro = CentroAcopio::create([
            'encargado_id' => $user4->id,
            'estado_id' => 12,
            'ciudad_id' => 220,
            'name' => 'Eco RAEE - Andres Eloy Blanco',
            'description' => 'Centro de acopio zona centro de Andres Eloy Blanco',
            'address' => 'Calle urdaneta, municipio Andres Eloy Blanco, Lara',
        ]);

        $user4->update([
            'centro_id' => $centro->id
        ]);

        $user4 = User::create([
            'name' => 'Valeria',
            'lastname' => 'Carrazco',
            'ci_id' => 18,
            'email' => 'separador711@cloe.com',
            'address' => 'Lara',
            'password'  =>  Hash::make('password'),
            'username' => 'vcarrazco',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 12,
            'ciudad_id' => 221,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Carlos',
            'lastname' => 'Suarez',
            'ci_id' => 19,
            'email' => 'separador6081@cloe.com',
            'address' => 'Lara',
            'password'  =>  Hash::make('password'),
            'username' => 'scarlos3',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 12,
            'ciudad_id' => 217,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Paul Daniel',
            'lastname' => 'Clark Ramos',
            'ci_id' => 20,
            'email' => 'clasificador605@cloe.com',
            'address' => 'Lara',
            'password'  =>  Hash::make('password'),
            'username' => 'rpclark',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 12,
            'ciudad_id' => 215,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Clasificador');

        $user4 = User::create([
            'name' => 'Isamar',
            'lastname' => 'Uzcategui',
            'ci_id' => 21,
            'email' => 'clasificador704@cloe.com',
            'address' => 'Lara',
            'password'  =>  Hash::make('password'),
            'username' => 'iuzcategui',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 12,
            'ciudad_id' => 221,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Clasificador');

        // APURE

        $user4 = User::create([
            'name' => 'Daniela Avila',
            'lastname' => 'Rivas',
            'ci_id' => 22,
            'email' => 'separador1@cloe.com',
            'address' => 'San fernando',
            'password'  =>  Hash::make('password'),
            'username' => 'darivas1',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 3,
            'ciudad_id' => 52,
            'enabled' => true,
        ]);
        $user4->assignRole('Encargado');

        $centro = CentroAcopio::create([
            'encargado_id' => $user4->id,
            'estado_id' => 3,
            'ciudad_id' => 52,
            'name' => 'Eco RAEE - San Fernando',
            'description' => 'Centro de acopio zona centro de San fernando',
            'address' => 'Calle bolivar, municipio San fernando, Apure',
        ]);

        $user4->update([
            'centro_id' => $centro->id
        ]);

        $user4 = User::create([
            'name' => 'Thomas Alexander',
            'lastname' => 'Lu Veliz',
            'ci_id' => 23,
            'email' => 'separador2@cloe.com',
            'address' => 'Apure',
            'password'  =>  Hash::make('password'),
            'username' => 'lutomas',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 3,
            'ciudad_id' => 49,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Separador');

        $user4 = User::create([
            'name' => 'Luisana del Valle',
            'lastname' => 'Uribe',
            'ci_id' => 24,
            'email' => 'separador3@cloe.com',
            'address' => 'Apure',
            'password'  =>  Hash::make('password'),
            'username' => 'luribe3',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 3,
            'ciudad_id' => 48,
            'enabled' => true,
            'centro_id' => $centro->id
        ]);
        $user4->assignRole('Separador');
    }
}
