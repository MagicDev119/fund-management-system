<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Fund::factory(10)->create();

        $funds = \App\Models\Fund::get();

        foreach ($funds as $fund) {
            $fund->users()->attach(\App\Models\User::get()->random()->id, ['relation' => '1']);
            for ($i=0; $i < 3; $i++) { 
                $fund->accessibleUsers()->attach(\App\Models\User::get()->random()->id);
                $attachedIds = $fund->users()->pluck('user_id')->toArray();
                $newIds = array_diff(\App\Models\User::get()->pluck('id')->toArray(), $attachedIds);
                $fund->users()->attach($newIds[array_rand($newIds)], ['relation' => '0']);
            }
        }
    }
}
