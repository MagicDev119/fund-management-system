<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class AssetFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('asset_field')->insert([
            [
                'id' => 1,
                'group_id' => 1,
                'name' => 'Asset',
                'slug' => Str::slug('Asset'),
                'field_type_id' => 9
            ], [
                'id' => 2,
                'group_id' => 1,
                'name' => 'Legal name',
                'slug' => Str::slug('Legal name'),
                'field_type_id' => 9
            ], [
                'id' => 3,
                'group_id' => 1,
                'name' => 'Public vs Private',
                'slug' => Str::slug('Public vs Private'),
                'field_type_id' => 13
            ], [
                'id' => 4,
                'group_id' => 1,
                'name' => 'Founded year',
                'slug' => Str::slug('Founded year'),
                'field_type_id' => 9
            ], [
                'id' => 5,
                'group_id' => 1,
                'name' => 'Intermediate vehicle',
                'slug' => Str::slug('Intermediate vehicle'),
                'field_type_id' => 9
            ], [
                'id' => 6,
                'group_id' => 1,
                'name' => 'Type of transaction',
                'slug' => Str::slug('Type of transaction'),
                'field_type_id' => 9
            ], [
                'id' => 7,
                'group_id' => 1,
                'name' => 'Transaction Source',
                'slug' => Str::slug('Transaction Source'),
                'field_type_id' => 9
            ], [
                'id' => 8,
                'group_id' => 1,
                'name' => 'EV at Closing',
                'slug' => Str::slug('EV at Closing'),
                'field_type_id' => 9
            ], [
                'id' => 9,
                'group_id' => 1,
                'name' => 'Expected closing date',
                'slug' => Str::slug('Expected closing date'),
                'field_type_id' => 6
            ], [
                'id' => 10,
                'group_id' => 1,
                'name' => 'Board Representation',
                'slug' => Str::slug('Board Representation'),
                'field_type_id' => 9
            ], [
                'id' => 11,
                'group_id' => 1,
                'name' => 'Lead Partner',
                'slug' => Str::slug('Lead Partner'),
                'field_type_id' => 9
            ], [
                'id' => 12,
                'group_id' => 1,
                'name' => 'Pemba Reps',
                'slug' => Str::slug('Pemba Reps'),
                'field_type_id' => 9
            ], [
                'id' => 13,
                'group_id' => 1,
                'name' => "Devil's Advocate",
                'slug' => Str::slug("Devil's Advocate"),
                'field_type_id' => 9
            ], [
                'id' => 14,
                'group_id' => 2,
                'name' => 'Sector',
                'slug' => Str::slug('Sector'),
                'field_type_id' => 14
            ], [
                'id' => 15,
                'group_id' => 2,
                'name' => 'Industry',
                'slug' => Str::slug('Industry'),
                'field_type_id' => 15
            ], [
                'id' => 16,
                'group_id' => 3,
                'name' => 'Geography',
                'slug' => Str::slug('Geography'),
                'field_type_id' => 16
            ], [
                'id' => 17,
                'group_id' => 3,
                'name' => 'Website / App',
                'slug' => Str::slug('Website / App'),
                'field_type_id' => 9
            ], [
                'id' => 18,
                'group_id' => 3,
                'name' => 'Business Model',
                'slug' => Str::slug('Business Model'),
                'field_type_id' => 9
            ], [
                'id' => 19,
                'group_id' => 3,
                'name' => 'Fund Participation',
                'slug' => Str::slug('Fund Participation'),
                'field_type_id' => 9
            ], [
                'id' => 20,
                'group_id' => 3,
                'name' => 'Initial round',
                'slug' => Str::slug('Initial round'),
                'field_type_id' => 9
            ], [
                'id' => 21,
                'group_id' => 3,
                'name' => 'Current round',
                'slug' => Str::slug('Current round'),
                'field_type_id' => 9
            ], [
                'id' => 22,
                'group_id' => 3,
                'name' => 'Number of Shares',
                'slug' => Str::slug('Number of Shares'),
                'field_type_id' => 1
            ]
        ]);
        
        \App\Models\AssetField::factory(300)->create();

        $assetFields = \App\Models\AssetField::get();
        
        foreach ($assetFields as $assetField) {
            if ($assetField->assetFieldGroup->type == 3) {
                $assetData = [
                    'asset_field_id' => $assetField->id,
                    'set_date' => $faker->date($format = 'Y-m-d', $max = 'now')
                ];
                
                switch($assetField->fieldType->name) {
                    case 'Serial Number':
                        $assetData['value'] = $faker->regexify('[A-Za-z0-9]{10}');
                        break;
                    case 'Text';
                        $assetData['value'] = $faker->realText($maxNbChars = 200, $indexSize = 2);
                        break;
                    case 'Dropdown';
                        if(isset($assetField->fieldType->table) && $assetField->fieldType->table != '') {
                            if (isset($assetField->fieldType->resource) && $assetField->fieldType->resource != '') {
                                $list = DB::table($assetField->fieldType->table)->where('type', $assetField->fieldType->resource)->get();
                            } else {
                                $list = DB::table($assetField->fieldType->table)->get();
                            }
                            $assetData['value'] = $list->random()->id;
                        } else {
                            $assetData['value'] = $faker->country();
                        }
                        break;
                    case 'Number';
                        $assetData['value'] = $faker->numberBetween(1000, 999999);
                        break;
                    case 'Date';
                        $assetData['value'] = $faker->date($format = 'Y-m-d', $max = 'now');
                        break;
                    case 'Boolean';
                        $assetData['value'] = $faker->boolean;
                        break;
                    case 'Autocomplete';
                        $assetData['value'] = $faker->realText($maxNbChars = 30, $indexSize = 2);
                        break;
                    case 'String';
                        $assetData['value'] = $faker->realText($maxNbChars = 30, $indexSize = 2);
                        break;
                    default:
                        $assetData['value'] = $faker->realText($maxNbChars = 30, $indexSize = 2);
                        break;
                }
                DB::table('asset_data')->insert($assetData);
            }
        }
    }
}
