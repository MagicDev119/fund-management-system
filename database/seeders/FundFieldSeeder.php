<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class FundFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('fund_field')->insert([
            /*[
                'id' => 1,
                'group_id' => 1,
                'name' => 'Fund vehicle display name',
                'slug' => Str::slug('Fund vehicle display name'),
                'field_type_id' => 9
            ], [
                'id' => 2,
                'group_id' => 1,
                'name' => 'Legal name',
                'slug' => Str::slug('Legal name'),
                'field_type_id' => 9
            ], */[
                'id' => 3,
                'group_id' => 1,
                'name' => 'Incorporation Number',
                'slug' => Str::slug('Incorporation Number'),
                'field_type_id' => 9
            ], [
                'id' => 4,
                'group_id' => 1,
                'name' => 'Date of incorporation',
                'slug' => Str::slug('Date of incorporation'),
                'field_type_id' => 6
            ],/* [
                'id' => 5,
                'group_id' => 1,
                'name' => 'Fund currency',
                'slug' => Str::slug('Fund currency'),
                'field_type_id' => 3
            ], [
                'id' => 6,
                'group_id' => 1,
                'name' => 'Type',
                'slug' => Str::slug('Type'),
                'field_type_id' => 10
            ],*/ [
                'id' => 7,
                'group_id' => 1,
                'name' => 'Place of incorporation',
                'slug' => Str::slug('Place of incorporation'),
                'field_type_id' => 4
            ], [
                'id' => 8,
                'group_id' => 1,
                'name' => 'Initial closing',
                'slug' => Str::slug('Initial closing'),
                'field_type_id' => 6
            ], [
                'id' => 9,
                'group_id' => 1,
                'name' => 'First closing',
                'slug' => Str::slug('First closing'),
                'field_type_id' => 6
            ], [
                'id' => 10,
                'group_id' => 1,
                'name' => 'Final closing',
                'slug' => Str::slug('Final closing'),
                'field_type_id' => 6
            ], [
                'id' => 11,
                'group_id' => 1,
                'name' => 'Termination date',
                'slug' => Str::slug('Termination date'),
                'field_type_id' => 6
            ], [
                'id' => 12,
                'group_id' => 1,
                'name' => 'Extension',
                'slug' => Str::slug('Extension'),
                'field_type_id' => 6
            ], [
                'id' => 13,
                'group_id' => 1,
                'name' => 'Investment period commencement date',
                'slug' => Str::slug('Investment period commencement date'),
                'field_type_id' => 6
            ], [
                'id' => 14,
                'group_id' => 1,
                'name' => 'Investment period end date',
                'slug' => Str::slug('Investment period end date'),
                'field_type_id' => 6
            ], [
                'id' => 15,
                'group_id' => 1,
                'name' => 'Formation structure',
                'slug' => Str::slug('Formation structure'),
                'field_type_id' => 9
            ], [
                'id' => 16,
                'group_id' => 1,
                'name' => 'Director / Legal representative',
                'slug' => Str::slug('Director / Legal representative'),
                'field_type_id' => 9
            ], [
                'id' => 17,
                'group_id' => 1,
                'name' => 'Company secretary',
                'slug' => Str::slug('Company secretary'),
                'field_type_id' => 9
            ], [
                'id' => 18,
                'group_id' => 1,
                'name' => 'Management company',
                'slug' => Str::slug('Management company'),
                'field_type_id' => 9
            ], [
                'id' => 19,
                'group_id' => 1,
                'name' => 'Vintage year',
                'slug' => Str::slug('Vintage year'),
                'field_type_id' => 9
            ], [
                'id' => 20,
                'group_id' => 1,
                'name' => 'Entity owner',
                'slug' => Str::slug('Entity owner'),
                'field_type_id' => 11
            ], [
                'id' => 21,
                'group_id' => 1,
                'name' => 'Financing category',
                'slug' => Str::slug('Financing category'),
                'field_type_id' => 9
            ], [
                'id' => 22,
                'group_id' => 1,
                'name' => 'Asset class',
                'slug' => Str::slug('Asset class'),
                'field_type_id' => 12
            ], [
                'id' => 23,
                'group_id' => 1,
                'name' => 'Fund group',
                'slug' => Str::slug('Fund group'),
                'field_type_id' => 9
            ], [
                'id' => 24,
                'group_id' => 1,
                'name' => 'Preferred rate',
                'slug' => Str::slug('Preferred rate'),
                'field_type_id' => 9
            ], [
                'id' => 25,
                'group_id' => 1,
                'name' => 'Strategy description',
                'slug' => Str::slug('Strategy description'),
                'field_type_id' => 2
            ], [
                'id' => 26,
                'group_id' => 1,
                'name' => 'Notes',
                'slug' => Str::slug('Notes'),
                'field_type_id' => 2
            ]
        ]);

        \App\Models\FundField::factory(200)->create();

        $fundFields = \App\Models\FundField::get();
        
        foreach ($fundFields as $fundField) {
            if ($fundField->fundFieldGroup->type == 3) {
                $fundData = [
                    'fund_field_id' => $fundField->id
                ];
                
                switch($fundField->fieldType->name) {
                    case 'Serial Number':
                        $fundData['value'] = $faker->regexify('[A-Za-z0-9]{10}');
                        break;
                    case 'Text';
                        $fundData['value'] = $faker->realText($maxNbChars = 200, $indexSize = 2);
                        break;
                    case 'Dropdown';
                        if(isset($fundField->fieldType->table) && $fundField->fieldType->table != '') {
                            if (isset($fundField->fieldType->resource) && $fundField->fieldType->resource != '') {
                                $list = DB::table($fundField->fieldType->table)->where('type', $fundField->fieldType->resource)->get();
                                $fundData['value'] = $list->random()->id;
                            } else {
                                $list = DB::table($fundField->fieldType->table)->get();
                                $fundData['value'] = $list->random()->id;
                            }
                        } else {
                            $fundData['value'] = $faker->country();
                        }
                        break;
                    case 'Number';
                        $fundData['value'] = $faker->numberBetween(1000, 999999);
                        break;
                    case 'Date';
                        $fundData['value'] = $faker->date($format = 'Y-m-d', $max = 'now');
                        break;
                    case 'Boolean';
                        $fundData['value'] = $faker->boolean;
                        break;
                    case 'Autocomplete';
                        $fundData['value'] = $faker->realText($maxNbChars = 30, $indexSize = 2);
                        break;
                    case 'String';
                        $fundData['value'] = $faker->realText($maxNbChars = 30, $indexSize = 2);
                        break;
                    default:
                        $fundData['value'] = $faker->realText($maxNbChars = 30, $indexSize = 2);
                        break;
                }
                DB::table('fund_data')->insert($fundData);
            }
        }
    }
}
