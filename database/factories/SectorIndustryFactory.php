<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectorIndustryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = ucwords($this->faker->word);
        $type = ($this->faker->randomNumber(2) % 2 == 0) ? 'sector' : 'industry';
        return [
            'name' => $name,
            'type' => $type,
            'slug' => Str::slug($name)
        ];
    }
}
