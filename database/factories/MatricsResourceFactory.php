<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MatricsResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->realText($maxNbChars = 25, $indexSize = 2);
        $matrics_unit_id = \App\Models\MatricsUnit::get()->random()->id;
        $result = [
            'name' => $name,
            'matrics_unit_id' => $matrics_unit_id
        ];
        if ($matrics_unit_id != 4) $result['decimals'] = 2;
        return $result;
    }

    public function withParams($param) {
        $result = [
            'matrics_category_id' => $param['matrics_category_id'],
            'user_id' => $param['user_id']
        ];
        return $this->state($result);
    }
}
