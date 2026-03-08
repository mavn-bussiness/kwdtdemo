<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'mediable_id' => $this->faker->randomNumber(),
            'mediable_type' => $this->faker->word(),
            'file_path' => $this->faker->word(),
            'file_type' => $this->faker->word(),
            'file_name' => $this->faker->name(),
            'alt_text' => $this->faker->text(),
            'file_size_kb' => $this->faker->randomNumber(),
            'uploaded_by' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
        ];
    }
}
