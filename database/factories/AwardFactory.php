<?php

namespace Database\Factories;

use App\Models\Award;
use Illuminate\Database\Eloquent\Factories\Factory;

class AwardFactory extends Factory
{
    protected $model = Award::class;

    public function definition(): array
    {
        return [
            'title'                => $this->faker->sentence(3),
            'year'                 => $this->faker->numberBetween(2000, 2025),
            'awarding_organization' => $this->faker->company(),
            'description'          => $this->faker->paragraph(),
            'image_url'            => null,
            'order'                => $this->faker->numberBetween(0, 100),
        ];
    }
}
