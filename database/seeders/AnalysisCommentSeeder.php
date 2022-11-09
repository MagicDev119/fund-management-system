<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnalysisCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataFieldCategories = \App\Models\DataFieldCategories::get();

        foreach ($dataFieldCategories as $dataFieldCategory) {
            \App\Models\AnalysisComment::factory(3)->withParams(['data_field_category_id' => $dataFieldCategory->id])->create();
        }
    }
}
