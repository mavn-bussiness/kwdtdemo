<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    public function definition(): array
    {
        return [
            'donor_name' => $this->faker->name(),
            'donor_email' => $this->faker->unique()->safeEmail(),
            'donor_phone' => $this->faker->phoneNumber(),
            'reason' => $this->faker->word(),
            'amount_original' => $this->faker->randomFloat(),
            'currency' => $this->faker->word(),
            'amount_usd' => $this->faker->randomFloat(),
            'payment_method' => $this->faker->word(),
            'is_anonymous' => $this->faker->boolean(),
            'status' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
