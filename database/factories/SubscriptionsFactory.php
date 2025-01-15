<?php
namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Providers;
use App\Models\Plans;
use App\Models\Subscriptions;
class SubscriptionsFactory extends Factory
{
    protected $model = Subscriptions::class;

    public function definition()
    {
        return [
            'provider_id' => Providers::factory(),
            'plan_id' => Plans::factory(),
            'status' => $this->faker->boolean(),
            'refrence'=> $this->faker->randomNumber(),
        ];
    }

    // Define a state for subscribed
    public function subscribed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => true,
            ];
        });
    }

    // Define a state for unsubscribed
    public function unsubscribed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => false,
            ];
        });
    }
}
