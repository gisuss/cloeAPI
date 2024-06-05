<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{CentroAcopio, User};
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class CentroAcopioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Julio Esteban',
            'lastname' => 'Rondón',
            'ci_id' => 25,
            'email' => 'julio.e.rondon@cloe.com',
            'address' => 'Aroa',
            'password'  =>  Hash::make('password'),
            'username' => 'jerondon2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 22,
            'ciudad_id' => 445,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');

        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 22,
            'ciudad_id' => 445,
            'name' => 'Aroa ECO RAEE',
            'description' => 'Centro de acopio principal de Aroa',
            'address' => 'Aroa norte',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Laura Estefanía',
            'lastname' => 'Ramirez',
            'ci_id' => 26,
            'email' => 'lauran@cloe.com',
            'address' => 'Cocorote',
            'password'  =>  Hash::make('password'),
            'username' => 'lramirez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 22,
            'ciudad_id' => 449,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 22,
            'ciudad_id' => 449,
            'name' => 'Central Cocorote RAEE',
            'description' => 'Centro de acopio principal de Cocorote',
            'address' => 'Cocorote central',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Lucas Anthony',
            'lastname' => 'Rodríguez',
            'ci_id' => 27,
            'email' => 'anthonyr@cloe.com',
            'address' => 'Guama',
            'password'  =>  Hash::make('password'),
            'username' => 'arodriguez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 22,
            'ciudad_id' => 451,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 22,
            'ciudad_id' => 451,
            'name' => 'Centro de acopio Guama RAEE',
            'description' => 'Centro de acopio principal de Guama',
            'address' => 'Av principal, calle 9, Guama',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Maria',
            'lastname' => 'Rodríguez',
            'ci_id' => 28,
            'email' => 'mrodriguez2@cloe.com',
            'address' => 'Guanta',
            'password'  =>  Hash::make('password'),
            'username' => 'mrodriguez2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 2,
            'ciudad_id' => 15,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 2,
            'ciudad_id' => 15,
            'name' => 'Eco RAEE Guanta',
            'description' => 'Centro de acopio principal de Guanta norte',
            'address' => 'Guanta norte',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'José Miguel',
            'lastname' => 'Martínez',
            'ci_id' => 29,
            'email' => 'jmmartinez@cloe.com',
            'address' => 'Anaco',
            'password'  =>  Hash::make('password'),
            'username' => 'jmmartinez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 2,
            'ciudad_id' => 4,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 2,
            'ciudad_id' => 4,
            'name' => 'Eco RAEE Anaco',
            'description' => 'Centro de acopio principal de Anaco norte',
            'address' => 'Anaco norte',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'José',
            'lastname' => 'Gutierres',
            'ci_id' => 30,
            'email' => 'jgutierres@cloe.com',
            'address' => 'Lechería',
            'password'  =>  Hash::make('password'),
            'username' => 'jgutierres',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 2,
            'ciudad_id' => 16,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 2,
            'ciudad_id' => 16,
            'name' => 'Eco RAEE Lechería',
            'description' => 'Centro de acopio principal de Lechería norte',
            'address' => 'Lechería norte',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Laura Sofía',
            'lastname' => 'Beltrán',
            'ci_id' => 31,
            'email' => 'lsbeltran@cloe.com',
            'address' => 'Ciudad Alianza',
            'password'  =>  Hash::make('password'),
            'username' => 'lsbeltran',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'ciudad_id' => 112,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 7,
            'ciudad_id' => 112,
            'name' => 'Eco RAEE Ciudad Alianza',
            'description' => 'Centro de acopio principal de Ciudad Alianza',
            'address' => 'Ciudad Alianza calle 4',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'José Luís',
            'lastname' => 'Beltrán',
            'ci_id' => 32,
            'email' => 'jlbeltran@cloe.com',
            'address' => 'Canoabo',
            'password'  =>  Hash::make('password'),
            'username' => 'jlbeltran',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 7,
            'ciudad_id' => 109,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 7,
            'ciudad_id' => 109,
            'name' => 'Eco RAEE Canoabo',
            'description' => 'Centro de acopio principal de Canoabo',
            'address' => 'Canoabo calle 4',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Luisana',
            'lastname' => 'Chacón López',
            'ci_id' => 33,
            'email' => 'llopez2@cloe.com',
            'address' => 'Colón',
            'password'  =>  Hash::make('password'),
            'username' => 'llopez2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 19,
            'ciudad_id' => 386,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 19,
            'ciudad_id' => 386,
            'name' => 'Eco RAEE Colón',
            'description' => 'Centro de acopio principal de Colón',
            'address' => 'Coloncito calle 9',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Ernesto',
            'lastname' => 'Contreras',
            'ci_id' => 34,
            'email' => 'econtreras@cloe.com',
            'address' => 'La Fría',
            'password'  =>  Hash::make('password'),
            'username' => 'econtreras',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 19,
            'ciudad_id' => 392,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 19,
            'ciudad_id' => 392,
            'name' => 'Eco RAEE La Fría',
            'description' => 'Centro de acopio principal de La Fría',
            'address' => 'La Fría centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'José Félix',
            'lastname' => 'Angulo',
            'ci_id' => 35,
            'email' => 'jfangulo@cloe.com',
            'address' => 'San Cristóbal',
            'password'  =>  Hash::make('password'),
            'username' => 'jfangulo',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 19,
            'ciudad_id' => 405,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 19,
            'ciudad_id' => 405,
            'name' => 'Eco RAEE San Cristóbal',
            'description' => 'Centro de acopio principal de San Cristóbal',
            'address' => 'San Cristóbal centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Doris Isabel',
            'lastname' => 'Pantoja',
            'ci_id' => 36,
            'email' => 'dipantoja@cloe.com',
            'address' => 'Ureña',
            'password'  =>  Hash::make('password'),
            'username' => 'dipantoja',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 19,
            'ciudad_id' => 413,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 19,
            'ciudad_id' => 413,
            'name' => 'Eco RAEE Ureña',
            'description' => 'Centro de acopio principal de Ureña',
            'address' => 'Ureña centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Guillermina',
            'lastname' => 'Rodríguez',
            'ci_id' => 37,
            'email' => 'grodriguez2@cloe.com',
            'address' => 'Maracaibo',
            'password'  =>  Hash::make('password'),
            'username' => 'grodriguez2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 23,
            'ciudad_id' => 487,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 23,
            'ciudad_id' => 487,
            'name' => 'RAEE Maracaibo',
            'description' => 'Centro de acopio principal de Maracaibo',
            'address' => 'Maracaibo centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Guillermo David',
            'lastname' => 'Azuaje',
            'ci_id' => 38,
            'email' => 'gazuaje@cloe.com',
            'address' => 'Cabimas',
            'password'  =>  Hash::make('password'),
            'username' => 'gazuaje',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 23,
            'ciudad_id' => 463,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 23,
            'ciudad_id' => 463,
            'name' => 'RAEE Cabimas',
            'description' => 'Centro de acopio principal de Cabimas',
            'address' => 'Cabimas centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Antonio Daniel',
            'lastname' => 'Marcano',
            'ci_id' => 39,
            'email' => 'admarcano@cloe.com',
            'address' => 'Lagunillas del Zulia',
            'password'  =>  Hash::make('password'),
            'username' => 'admarcano',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 23,
            'ciudad_id' => 483,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 23,
            'ciudad_id' => 483,
            'name' => 'RAEE Lagunillas del Zulia',
            'description' => 'Centro de acopio principal de Lagunillas del Zulia',
            'address' => 'Lagunillas del Zulia centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Maria Isabel',
            'lastname' => 'Marcano',
            'ci_id' => 40,
            'email' => 'mimarcano@cloe.com',
            'address' => 'El Mené',
            'password'  =>  Hash::make('password'),
            'username' => 'mimarcano',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 23,
            'ciudad_id' => 475,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 23,
            'ciudad_id' => 475,
            'name' => 'RAEE El Mené',
            'description' => 'Centro de acopio principal de El Mené',
            'address' => 'El Mené centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Maria Anthonela',
            'lastname' => 'Durand',
            'ci_id' => 41,
            'email' => 'mdurand2@cloe.com',
            'address' => 'Chiquinquirá',
            'password'  =>  Hash::make('password'),
            'username' => 'mdurand2',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 23,
            'ciudad_id' => 469,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 23,
            'ciudad_id' => 469,
            'name' => 'RAEE Chiquinquirá',
            'description' => 'Centro de acopio principal de Chiquinquirá',
            'address' => 'Chiquinquirá centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Miriam Maria',
            'lastname' => 'Rivas',
            'ci_id' => 42,
            'email' => 'mmrivas@cloe.com',
            'address' => 'Santa Rita',
            'password'  =>  Hash::make('password'),
            'username' => 'mmrivas',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 23,
            'ciudad_id' => 503,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 23,
            'ciudad_id' => 503,
            'name' => 'RAEE Santa Rita',
            'description' => 'Centro de acopio principal de Santa Rita',
            'address' => 'Santa Rita centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Marcos Antonio',
            'lastname' => 'Riveiro',
            'ci_id' => 43,
            'email' => 'mriveiro@cloe.com',
            'address' => 'Sabana Grande',
            'password'  =>  Hash::make('password'),
            'username' => 'mriveiro',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 24,
            'ciudad_id' => 149,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 24,
            'ciudad_id' => 149,
            'name' => 'RAEE Sabana Grande',
            'description' => 'Centro de acopio principal de Sabana Grande',
            'address' => 'Sabana Grande, libertador',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Daniela Alexandra',
            'lastname' => 'Ramos',
            'ci_id' => 44,
            'email' => 'daramos@cloe.com',
            'address' => 'Coche',
            'password'  =>  Hash::make('password'),
            'username' => 'daramos',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 24,
            'ciudad_id' => 149,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');

        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 24,
            'ciudad_id' => 149,
            'name' => 'RAEE Coche',
            'description' => 'Centro de acopio principal de Coche',
            'address' => 'Coche centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Alexander Antuan',
            'lastname' => 'Arteaga',
            'ci_id' => 45,
            'email' => 'aaarteaga@cloe.com',
            'address' => 'El Paraíso',
            'password'  =>  Hash::make('password'),
            'username' => 'aaarteaga',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 24,
            'ciudad_id' => 149,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 24,
            'ciudad_id' => 149,
            'name' => 'RAEE El Paraíso',
            'description' => 'Centro de acopio principal de El Paraíso',
            'address' => 'El Paraíso centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'David Daniel',
            'lastname' => 'Cardoza',
            'ci_id' => 46,
            'email' => 'ddcardoza@cloe.com',
            'address' => 'Zaraza',
            'password'  =>  Hash::make('password'),
            'username' => 'ddcardoza',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 11,
            'ciudad_id' => 209,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 11,
            'ciudad_id' => 209,
            'name' => 'RAEE Zaraza',
            'description' => 'Centro de acopio principal de Zaraza',
            'address' => 'Zaraza centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Roberto Antonio',
            'lastname' => 'Gomez',
            'ci_id' => 47,
            'email' => 'ragomez@cloe.com',
            'address' => 'Tucupido',
            'password'  =>  Hash::make('password'),
            'username' => 'ragomez',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 11,
            'ciudad_id' => 207,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 11,
            'ciudad_id' => 207,
            'name' => 'RAEE Tucupido',
            'description' => 'Centro de acopio principal de Tucupido',
            'address' => 'Tucupido centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Yessenia del Valle',
            'lastname' => 'Andrade',
            'ci_id' => 48,
            'email' => 'yandrade@cloe.com',
            'address' => 'Calabozo',
            'password'  =>  Hash::make('password'),
            'username' => 'yandrade',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 11,
            'ciudad_id' => 184,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 11,
            'ciudad_id' => 184,
            'name' => 'RAEE Calabozo',
            'description' => 'Centro de acopio principal de Calabozo',
            'address' => 'Calabozo centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Raúl',
            'lastname' => 'Coronel',
            'ci_id' => 49,
            'email' => 'rcoronel@cloe.com',
            'address' => 'Chaguaramas Guárico',
            'password'  =>  Hash::make('password'),
            'username' => 'rcoronel',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 11,
            'ciudad_id' => 196,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 11,
            'ciudad_id' => 196,
            'name' => 'RAEE Chaguaramas Guárico',
            'description' => 'Centro de acopio principal de Chaguaramas Guárico',
            'address' => 'Chaguaramas Guárico centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);

        $user = User::create([
            'name' => 'Reinaldo',
            'lastname' => 'Rojas Izaguirre',
            'ci_id' => 50,
            'email' => 'rrizaguirre@cloe.com',
            'address' => 'Altagracia de Orituco',
            'password'  =>  Hash::make('password'),
            'username' => 'rrizaguirre',
            'email_verified_at' => Carbon::now(),
            'estado_id' => 11,
            'ciudad_id' => 182,
            'enabled' => true,
        ]);
        $user->assignRole('Encargado');
        
        $centro = CentroAcopio::create([
            'encargado_id' => $user->id,
            'estado_id' => 11,
            'ciudad_id' => 182,
            'name' => 'RAEE Altagracia de Orituco',
            'description' => 'Centro de acopio principal de Altagracia de Orituco',
            'address' => 'Altagracia de Orituco centro',
        ]);

        $user->update([
            'centro_id' => $centro->id
        ]);
    }
}
