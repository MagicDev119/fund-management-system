<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyMatricsSeeder extends Seeder
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
            \App\Models\CompanyMatrics::factory(5)->withParams(['category_id' => $dataFieldCategory->id])->create();
        }
    }
}
