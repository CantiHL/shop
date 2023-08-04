<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name'=>$this->faker->name(),
            'product_price'=>rand(2000000,50000000),
            'product_brand_id'=>1,
            'product_category_id'=>1,
            'product_description'=>$this->faker->paragraph,
            'product_date'=>date('Y-m-d')
        ];
    }
}
