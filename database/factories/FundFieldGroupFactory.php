<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FundFieldGroupFactory extends Factory
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
            'group_name' => $name,
            'slug' => Str::slug($name)
        ];
        return $result;
    }

    public function withParams($param) {
        $result = [
            'type' => $param['type']
        ];
        if ($param['type'] == 2) $result['user_id'] = $param['user_id'];
        else $result['fund_id'] = $param['fund_id'];
        return $this->state($result);
    }
}
