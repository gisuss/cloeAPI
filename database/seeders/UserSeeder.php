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
            'dni' => 'V12345678',
            'email' => 'admin@cloe.com',
            'password'  =>  Hash::make('password'),
            'username' => 'admin',
            'email_verified_at' => Carbon::now(),
        ]);
        $user->assignRole('Admin');
        
        $user2 = User::create([
            'name' => 'Recolector',
            'lastname' => 'Cloe',
            'dni' => 'V11122278',
            'email' => 'recolector@cloe.com',
            'password'  =>  Hash::make('password'),
            'username' => 'recolector',
            'email_verified_at' => Carbon::now(),
        ]);
        $user2->assignRole('Recolector');
        
        $user3 = User::create([
            'name' => 'Separador',
            'lastname' => 'Cloe',
            'dni' => 'V22233389',
            'email' => 'separador@cloe.com',
            'password'  =>  Hash::make('password'),
            'username' => 'separador',
            'email_verified_at' => Carbon::now(),
        ]);
        $user3->assignRole('Separador');
    }
}
