<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'Admin',
        'email' => 'faithtanuh@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('Tanu1234'), // password
        'remember_token' => Str::random(10),
        'is_admin' => 1

      
      ]);
      User::create([
        'name' => 'Faith',
        'email' => 'faithmutanumutie@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('Tanu1234'), // password
        'remember_token' => Str::random(10),
        'is_admin' => 0

      
      ]); 
    }
}
