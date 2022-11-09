<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MatricsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matrics_category')->insert([
            [
                'id' => 1,
                'name' => 'financial'
            ], [
                'id' => 2,
                'name' => 'operating'
            ], [
                'id' => 3,
                'name' => 'user_matrics'
            ]
        ]);
    }
}
