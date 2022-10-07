<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert([
            [
                'id' => 1,
                'name' => 'Can lock / unlock portfolio valuations',
                'order' => 1
            ], [
                'id' => 2,
                'name' => 'Can edit / upload general ledger',
                'order' => 2
            ], [
                'id' => 3,
                'name' => 'Can edit data.collection',
                'order' => 3
            ], [
                'id' => 4,
                'name' => 'Can edit cap table',
                'order' => 4
            ]
        ]);
    }
}
