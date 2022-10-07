<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFieldGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(array $arguments = [])
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
        else $result['asset_id'] = $param['asset_id'];
        return $this->state($result);
    }
}
