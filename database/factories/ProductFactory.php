<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\File;
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
            'stock' => $this->faker->randomDigit(),
            'description' => $this->faker->paragraph(),
            'cost' => $this->faker->randomDigit(),
            'activo'=> $this->faker->boolean()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product){
			$file = new File(['route' => '/storage/image/products/default.png']);
			$product->file()->save($file);
        });
    }
}
