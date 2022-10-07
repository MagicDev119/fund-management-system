<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->realText($maxNbChars = 15);
        $result = [
            'name' => $name,
            'slug' => Str::slug($name),
            'currency' => $this->faker->currencyCode,
            'fund_type_id' => \App\Models\FundType::get()->random()->id,
            'legal_name' => $this->faker->realText($maxNbChars = 20)
        ];
        return $result;
    }
}
