<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssetFieldGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asset_field_group')->insert([
            [
                'id' => 1,
                'group_name' => 'Asset Information',
                'slug' => Str::slug('Asset Information')
            ], [
                'id' => 2,
                'group_name' => 'Industry Information',
                'slug' => Str::slug('Industry Information')
            ], [
                'id' => 3,
                'group_name' => 'Additional Information',
                'slug' => Str::slug('Additional Information')
            ], [
                'id' => 4,
                'group_name' => 'Bank Account Information',
                'slug' => Str::slug('Bank Account Information')
            ], [
                'id' => 5,
                'group_name' => 'Process management',
                'slug' => Str::slug('Process management')
            ], [
                'id' => 6,
                'group_name' => 'Notes',
                'slug' => Str::slug('Notes')
            ]
        ]);

        $assets = \App\Models\Asset::get();

        foreach ($assets as $asset) {
            \App\Models\AssetFieldGroup::factory(1)->withParams(['asset_id' => $asset->id, 'type' => 3])->create();
        }

        $users = \App\Models\User::get();

        foreach ($users as $user) {
            \App\Models\AssetFieldGroup::factory(1)->withParams(['user_id' => $user->id, 'type' => 2])->create();
        }
    }
}
