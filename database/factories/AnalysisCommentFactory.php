<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnalysisCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $content = $this->faker->realText($maxNbChars = 100, $indexSize = 2);
        $result = [
            'user_id' => \App\Models\User::get()->random()->id,
            'content' => $content
        ];
        return $result;
    }

    public function withParams($param) {
        $result = [
            'data_field_category_id' => $param['data_field_category_id']
        ];
        return $this->state($result);
    }
}
