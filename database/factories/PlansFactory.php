<?php

namespace Database\Factories;

use App\Models\Plans;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlansFactory extends Factory
{
    protected $model = Plans::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plan' => $this->faker->word(), // Generate a random word for the plan name
            'amount' => $this->faker->randomFloat(2, 10, 100), // Generate a random price between 10 and 100
            'duration' => $this->faker->randomNumber(), // Generate a random duration (adjust as needed)
        ];
    }
}
