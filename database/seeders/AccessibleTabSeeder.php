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
                'order' => 1,
                'isDefault' => false
            ], [
                'id' => 2,
                'name' => 'Entities',
                'order' => 2,
                'isDefault' => false
            ], [
                'id' => 3,
                'name' => 'Companies',
                'order' => 3,
                'isDefault' => true
            ], [
                'id' => 4,
                'name' => 'Portfolio',
                'order' => 4,
                'isDefault' => true
            ], [
                'id' => 5,
                'name' => 'Valuations',
                'order' => 5,
                'isDefault' => true
            ], [
                'id' => 6,
                'name' => 'Reports',
                'order' => 6,
                'isDefault' => true
            ], [
                'id' => 7,
                'name' => 'General Ledger',
                'order' => 7,
                'isDefault' => false
            ], [
                'id' => 8,
                'name' => 'Settings',
                'order' => 8,
                'isDefault' => false
            ]
        ]);
    }
}
