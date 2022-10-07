<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DropdownListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dropdown_list')->insert([
            [
                'id' => 1,
                'name' => 'Private',
                'type' => 'private_public',
                'slug' => Str::slug('Private')
            ], [
                'id' => 2,
                'name' => 'Public',
                'type' => 'private_public',
                'slug' => Str::slug('Public')
            ], [
                'id' => 3,
                'name' => 'Geography',
                'type' => 'geography',
                'slug' => Str::slug('Geography')
            ]
        ]);
    }
}
