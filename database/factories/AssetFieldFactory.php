<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AssetFieldFactory extends Factory
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
            'field_type_id' => \App\Models\FieldType::get()->random()->id,
            'group_id' => \App\Models\AssetFieldGroup::get()->random()->id
        ];
        return $result;
    }
}
