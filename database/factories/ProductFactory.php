<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function categoryId($category)
	{
		return $this->state([
			'category_id' => $category->id
		]);
	}


    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'category_id' => $this->faker->randomNumber(1,2,3,4,5,6,7),
            'stock' => $this->faker->randomDigit(),
            'description_corta' => $this->faker->paragraph(),
            'description_larga' => $this->faker->paragraph(),
            'cost' => $this->faker->randomDigit(),
            'activo'=> $this->faker->boolean()
        ];
    }

}
