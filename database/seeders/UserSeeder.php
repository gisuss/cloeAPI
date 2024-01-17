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
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'admin',
            'email_verified_at' => Carbon::now(),
        ]);
        $user->assignRole('Admin');
        
        $user2 = User::create([
            'name' => 'Recolector',
            'lastname' => 'Cloe',
            'ci_id' => 2,
            'email' => 'recolector@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'recolector',
            'email_verified_at' => Carbon::now(),
        ]);
        $user2->assignRole('Recolector');
        
        $user3 = User::create([
            'name' => 'Separador',
            'lastname' => 'Cloe',
            'ci_id' => 3,
            'email' => 'separador@cloe.com',
            'address' => 'Valencia',
            'password'  =>  Hash::make('password'),
            'username' => 'separador',
            'email_verified_at' => Carbon::now(),
        ]);
        $user3->assignRole('Separador');
    }
}
