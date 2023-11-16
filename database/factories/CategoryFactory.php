<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
       return [
        'name' => $this->faker->name()
       ];
    }
    public function configure()
	{
		return $this->afterCreating(function (Category $category) {
			Product::factory(5)->categoryId($category)->create();
		});
	}
}
