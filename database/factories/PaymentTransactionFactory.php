<?php

namespace Database\Factories;

use App\Models\PaymentTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PaymentTransactionFactory extends Factory
{
    protected $model = PaymentTransaction::class;

    public function definition(): array
    {
        return [
            'donation_id' => $this->faker->randomNumber(),
            'transaction_id' => $this->faker->word(),
            'payment_gateway' => $this->faker->word(),
            'amount_usd' => $this->faker->randomFloat(),
            'currency' => $this->faker->word(),
            'status' => $this->faker->word(),
            'gateway_response' => $this->faker->words(),
            'paid_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ];
    }
}
