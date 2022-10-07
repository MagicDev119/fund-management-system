<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FieldTypeSeeder::class,
            DropdownListSeeder::class,
            FundTypeSeeder::class,
            UserRoleSeeder::class,
            AccessibleTabSeeder::class,
            AdminRoleSeeder::class,
            UserSeeder::class,
            SectorIndustrySeeder::class,
            FundSeeder::class,
            AssetSeeder::class,
            FundFieldGroupSeeder::class,
            FundFieldSeeder::class,
            AssetFieldGroupSeeder::class,
            AssetFieldSeeder::class,
            FundDataSeeder::class,
            AssetDataSeeder::class,

            GeneralLedgerSeeder::class
        ]);
    }
}
