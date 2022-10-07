<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_role')->insert([
            [
                'id' => 1,
                'name' => 'Master'
            ], [
                'id' => 2,
                'name' => 'Admin'
            ], [
                'id' => 3,
                'name' => 'General'
            ]
        ]);
    }
}
