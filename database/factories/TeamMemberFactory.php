<?php

namespace Database\Factories;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamMemberFactory extends Factory
{
    protected $model = TeamMember::class;

    public function definition(): array
    {
        return [
            'name'      => $this->faker->name(),
            'title'     => $this->faker->jobTitle(),
            'bio'       => $this->faker->paragraph(),
            'photo_url' => null,
            'email'     => $this->faker->safeEmail(),
            'order'     => $this->faker->numberBetween(0, 100),
            'is_active' => true,
        ];
    }
}
