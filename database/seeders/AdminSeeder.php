<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'nome' => 'admin',
            'email' => 'admin@gmail.com',
            'password'=>Hash::make('password'),
            'isAdmin'=> 1
        ]);
    }
}
