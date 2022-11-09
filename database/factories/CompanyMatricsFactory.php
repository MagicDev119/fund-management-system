<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyMatricsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $result = [
            'matrics_resource_id' => \App\Models\MatricsResource::get()->random()->id,
        ];
        return $result;
    }

    public function withParams($param) {
        $result = [
            'category_id' => $param['category_id']
        ];
        return $this->state($result);
    }
}
