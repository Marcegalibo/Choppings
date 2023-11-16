<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'number_id' => '35252781',
            'name' => 'Martha',
            'last_name' => 'Galindo',
            'email' => 'marcegabo49@gmail.com',
            'password' => '987654321',
            'remember_token' => Str::random(10),
        ]);
    }
}
