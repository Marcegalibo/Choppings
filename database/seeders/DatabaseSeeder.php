<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleAndPermissionSeeder;

class DatabaseSeeder extends Seeder
{
   public function run()
   {
    $this->call([
        RoleAndPermissionSeeder::class,
        UserSeeder::class,

    ]);
    User::factory(10)->create();
    Category::factory(7)->create();
   }
}
