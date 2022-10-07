<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FundFieldGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fund_field_group')->insert([
            [
                'id' => 1,
                'group_name' => 'Investee fund information',
                'slug' => Str::slug('Investee fund information'),
                'isVisible' => true,
                'type' => 1
            ]
        ]);
        $funds = \App\Models\Fund::get();

        foreach ($funds as $fund) {
            \App\Models\FundFieldGroup::factory(1)->withParams(['fund_id' => $fund->id, 'type' => 3])->create();
        }

        $users = \App\Models\User::get();

        foreach ($users as $user) {
            \App\Models\FundFieldGroup::factory(1)->withParams(['user_id' => $user->id, 'type' => 2])->create();
        }
    }
}
