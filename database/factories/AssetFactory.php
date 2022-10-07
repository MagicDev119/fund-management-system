<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->realText($maxNbChars = 20);
        $result = [
            'name' => $name,
            'slug' => Str::slug($name),
            'legal_name' => $this->faker->realText($maxNbChars = 20),
            'fund_id' => \App\Models\Fund::get()->random()->id
        ];
        return $result;
    }
}
