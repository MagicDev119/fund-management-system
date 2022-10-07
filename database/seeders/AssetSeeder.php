<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Asset::factory(40)->create();

        $assets = \App\Models\Asset::get();

        foreach ($assets as $asset) {
            $asset->accessibleUsers()->attach(\App\Models\User::get()->random()->id);
        }
    }
}
