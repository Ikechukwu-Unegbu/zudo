<?php

namespace Database\Factories\V1\Users;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\V1\Users\Bankaccount>
 */
class BankaccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bank_name'=>$this->faker->name('male').' Bank PLC',
            'bank_account'=>$this->faker->creditCardNumber(),
        ];
    }
}
