<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Providers;
use App\Models\Categories;
use App\Models\ProvidersItems;

class ProvidersItemsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProvidersItems::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provider_id' => Providers::factory()->create()->id,
            'title' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 10, 100), // Example of generating a random price between 10 and 100
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->word(),
            'mainimage' => $this->faker->imageUrl(),
            'firstimage' => $this->faker->imageUrl(),
            'secondimage' => $this->faker->imageUrl(), 
        ];
    }
}

