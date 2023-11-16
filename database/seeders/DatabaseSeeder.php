<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
   public function run()
   {
    $this->call([
        UserSeeder::class,
        //CategorySeeder::class,
    ]);
    User::factory(10)->create();
    Category::factory(7)->create();
   }
}
