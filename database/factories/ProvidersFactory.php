<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Providers;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvidersFactory extends Factory
{
    protected $model = Providers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id, // Use 'user_id' instead of 'provider_id'
            'surname' => $this->faker->lastName(), // Use faker method 'lastName()' instead of 'name()'
            'firstname' => $this->faker->firstName(), // Use faker method 'firstName()' instead of 'name()'
            'email' => $this->faker->unique()->safeEmail(), // Use faker method 'unique()->safeEmail()' for unique email
            'mobile' => $this->faker->phoneNumber(), // Use faker method 'phoneNumber()' instead of 'mobile()'
            'state' => $this->faker->state(), // Use faker method 'state()' instead of 'state()'
            'country' => $this->faker->country(), // Use faker method 'country()' instead of 'country()'
            'image' => $this->faker->imageUrl(), // Use faker method 'imageUrl()' instead of 'image()'
        ];
    }
}
