<?php

namespace Database\Factories\V1\Admin;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\V1\Admin\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question'=>$this->faker->sentence(),
            'answer'=>$this->faker->sentences(5, true),
            'slug'=>Str::random(10)
        ];
    }
}
