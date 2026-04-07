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
            'reason' => $this->faker->sentence(),
            'amount_original' => $this->faker->randomFloat(2, 1, 1000),
            'currency' => 'USD',
            'amount_usd' => $this->faker->randomFloat(2, 1, 1000),
            'payment_method' => 'paypal',
            'is_anonymous' => false,
            'status' => 'pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
