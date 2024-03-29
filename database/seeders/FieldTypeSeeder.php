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
                'table' => '',
                'cate_name' => ''
            ], [
                'id' => 2,
                'name' => 'Text',
                'slug' => Str::slug('Text'),
                'resource' => '',
                'table' => '',
                'cate_name' => ''
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
                'table' => '',
                'cate_name' => 'Location'
            ], [
                'id' => 5,
                'name' => 'Number',
                'slug' => Str::slug('Number'),
                'resource' => '',
                'table' => '',
                'cate_name' => ''
            ], [
                'id' => 6,
                'name' => 'Date',
                'slug' => Str::slug('Date'),
                'resource' => '',
                'table' => '',
                'cate_name' => ''
            ], [
                'id' => 7,
                'name' => 'Boolean',
                'slug' => Str::slug('Boolean'),
                'resource' => '',
                'table' => '',
                'cate_name' => ''
            ], [
                'id' => 8,
                'name' => 'Autocomplete',
                'slug' => Str::slug('Autocomplete'),
                'resource' => '',
                'table' => '',
                'cate_name' => ''
            ], [
                'id' => 9,
                'name' => 'String',
                'slug' => Str::slug('String'),
                'resource' => '',
                'table' => '',
                'cate_name' => ''
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
                'table' => 'users',
                'cate_name' => 'Owner'
            ], [
                'id' => 12,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => '',
                'table' => 'asset',
                'cate_name' => 'Asset class'
            ], [
                'id' => 13,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'private_public',
                'table' => 'dropdown_list',
                'cate_name' => 'Private vs Public'
            ], [
                'id' => 14,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'sector',
                'table' => 'sector_industry',
                'cate_name' => 'Sector'
            ], [
                'id' => 15,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'industry',
                'table' => 'sector_industry',
                'cate_name' => 'Industry'
            ], [
                'id' => 16,
                'name' => 'Dropdown',
                'slug' => Str::slug('Dropdown'),
                'resource' => 'geography',
                'table' => 'dropdown_list',
                'cate_name' => 'Geography'
            ]
        ]);
    }
}
