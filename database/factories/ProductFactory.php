<?php

namespace Database\Factories;

use App\Models\Manufacturers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        $image = $this->faker->image();
        return [
            'manufacturer_id' => Manufacturers::factory(),
            'name' => $name,
            'price' => $this->faker->numberBetween(100,20000),
            'quantity' => $this->faker->numberBetween(0,100),
            'image' => $image,
        ];
    }
}
