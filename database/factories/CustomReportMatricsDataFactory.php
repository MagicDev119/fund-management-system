<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomReportMatricsDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $result = [
            'value' => $this->faker->numberBetween(1000, 90000)
        ];
        return $result;
    }

    public function withParams($param) {
        $result = [
            'company_matrics_id' => $param['company_matrics_id'],
            'set_date' => $param['set_date']
        ];
        return $this->state($result);
    }
}
