<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FundTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fund_type')->insert([
            [
                'id' => 1,
                'type' => 'Main fund',
                'slug' => Str::slug('Main fund')
            ]
        ]);
    }
}
