<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'title'          => $title,
            'slug'           => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'type'           => 'blog',
            'status'         => 'draft',
            'excerpt'        => $this->faker->paragraph(),
            'body'           => '<p>' . $this->faker->paragraphs(3, true) . '</p>',
            'featured_image' => null,
            'author_id'      => User::factory(),
            'published_at'   => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn () => [
            'status'       => 'published',
            'published_at' => now(),
        ]);
    }
}
