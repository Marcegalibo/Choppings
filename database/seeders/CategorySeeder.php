<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Alimentos y Bebidas']);
        Category::create(['name' => 'Animales y Mascotas']);
        Category::create(['name' => 'Belleza y Cuidado personal']);
        Category::create(['name' => 'Bebes']);
        Category::create(['name' => 'Ropa y Accesorios']);
        Category::create(['name' => 'Juegos y Juguetes']);
        Category::create(['name' => 'Herramientas']);
    }
}
