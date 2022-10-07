<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('field_type')->insert([
            [
                'id' => 1,
                'name' => 'Serial Number',
                'slug' => Str::slug('Serial Number'),
                'resource' => '',
                'table' => ''
            ], [
                'id' => 2,
                'name' => 'Text',
                'slug' => Str::slug('Text'),
                'resource' => '',
                'table' => ''
            ],/* [
                'id' => 3,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'currency',
                'table' => ''
            ],*/ [
                'id' => 4,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'country',
                'table' => ''
            ], [
                'id' => 5,
                'name' => 'Number',
                'slug' => Str::slug('Number'),
                'resource' => '',
                'table' => ''
            ], [
                'id' => 6,
                'name' => 'Date',
                'slug' => Str::slug('Date'),
                'resource' => '',
                'table' => ''
            ], [
                'id' => 7,
                'name' => 'Boolean',
                'slug' => Str::slug('Boolean'),
                'resource' => '',
                'table' => ''
            ], [
                'id' => 8,
                'name' => 'Autocomplete',
                'slug' => Str::slug('Autocomplete'),
                'resource' => '',
                'table' => ''
            ], [
                'id' => 9,
                'name' => 'String',
                'slug' => Str::slug('String'),
                'resource' => '',
                'table' => ''
            ],/* [
                'id' => 10,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => '',
                'table' => 'fund_type'
            ],*/ [
                'id' => 11,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => '',
                'table' => 'users'
            ], [
                'id' => 12,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => '',
                'table' => 'asset'
            ], [
                'id' => 13,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'private_public',
                'table' => 'dropdown_list'
            ], [
                'id' => 14,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'sector',
                'table' => 'sector_industry'
            ], [
                'id' => 15,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'industry',
                'table' => 'sector_industry'
            ], [
                'id' => 16,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'geography',
                'table' => 'dropdown_list'
            ]
        ]);
    }
}
