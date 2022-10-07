<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectorIndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SectorIndustry::factory(20)->create();
    }
}
