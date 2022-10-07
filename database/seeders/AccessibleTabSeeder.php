<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccessibleTabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accessible_tab')->insert([
            [
                'id' => 1,
                'name' => 'Dashboard',
                'order' => 1
            ], [
                'id' => 2,
                'name' => 'Entities',
                'order' => 2
            ], [
                'id' => 3,
                'name' => 'Companies',
                'order' => 3
            ], [
                'id' => 4,
                'name' => 'Portfolio',
                'order' => 4
            ], [
                'id' => 5,
                'name' => 'Valuations',
                'order' => 5
            ], [
                'id' => 6,
                'name' => 'Reports',
                'order' => 6
            ], [
                'id' => 7,
                'name' => 'General Ledger',
                'order' => 7
            ], [
                'id' => 8,
                'name' => 'Settings',
                'order' => 8
            ]
        ]);
    }
}
