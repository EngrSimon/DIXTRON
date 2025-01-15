<?php

namespace Database\Factories;

use App\Models\Itemsimages;
use App\Models\ProvidersItems;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Itemsimages>
 */
class ItemsimagesFactory extends Factory
{
    protected $model = Itemsimages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provideritems_id' => ProvidersItems::factory()->create()->id,
            'mainimage' => $this->faker->imageUrl(),
            'imageone' => $this->faker->imageUrl(),
            'imagetwo' => $this->faker->imageUrl(), 
        ];
    }
}
