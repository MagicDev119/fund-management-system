<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataFieldCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_field_categories')->insert([
            [
                'id' => 1,
                'category_name' => 'Actuals'
            ], [
                'id' => 2,
                'category_name' => 'Budget'
            ], [
                'id' => 3,
                'category_name' => 'Balance Sheet'
            ], [
                'id' => 4,
                'category_name' => 'IC'
            ]
        ]);

        $assets = \App\Models\Asset::get();

        foreach ($assets as $asset) {
            DB::table('data_field_categories')->insert([
                [
                    'asset_id' => $asset->id,
                    'category_name' => 'Actuals',
                    'type' => 2
                ], [
                    'asset_id' => $asset->id,
                    'category_name' => 'Budget',
                    'type' => 2
                ], [
                    'asset_id' => $asset->id,
                    'category_name' => 'Balance Sheet',
                    'type' => 2
                ], [
                    'asset_id' => $asset->id,
                    'category_name' => 'IC',
                    'type' => 2
                ]
            ]);
            \App\Models\DataFieldCategories::factory(2)->withParams(['asset_id' => $asset->id, 'type' => 2])->create();
        }
    }
}
