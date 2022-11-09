<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DataFieldCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->realText($maxNbChars = 25, $indexSize = 2);
        $result = [
            'category_name' => $name
        ];
        return $result;
    }

    public function withParams($param) {
        $result = [
            'type' => $param['type'],
            'asset_id' => $param['asset_id']
        ];
        return $this->state($result);
    }
}
