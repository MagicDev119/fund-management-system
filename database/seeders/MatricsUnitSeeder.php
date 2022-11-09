<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MatricsUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matrics_unit')->insert([
            [
                'id' => 1,
                'name' => 'currency'
            ], [
                'id' => 2,
                'name' => 'percentage'
            ], [
                'id' => 3,
                'name' => 'number'
            ], [
                'id' => 4,
                'name' => 'text'
            ]
        ]);
    }
}
