<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MatricsResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matrics_resource')->insert([
            [
                'name' => 'Revenue',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Revenue % growth yoy',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Cost of Goods Sold',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Gross profit',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Gross margin',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Research and development',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Selling general and administrative expenses',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Other operating expenses',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Total operating expenses',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'EBITDA',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'EBITDA margin',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Depreciation and amortization',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Operating income',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Operating margin',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'EBIT',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'EBIT margin',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Interest income',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'PBT',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Taxes',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Net income',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Net income margin',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Other non-recurring items',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Gross written premium',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Revenue from continuing operations',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Cash burn rate',
                'matrics_category_id' => 1,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Annual recurring revenue (ARR)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Monthly recurring revenue (MRR)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Gross merchandise value (GMV)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Subscription revenue',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Average revenue per user (ARPU)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Marketing costs',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Number of employees (end of period)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Number of clients',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Conversion rate',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Net promoter score (NPS)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Average selling price (ASP)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Bookings',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Churn rate',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Gross churn rate',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Net churn rate',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Customer acquisition costs (CAC)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Daily active users (DAU)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Monthly active users (MAU)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Number of users',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Click through rate',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Number of downloads',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Utilization rate',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Number of stores',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Production capacity',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ], [
                'name' => 'Credit rating',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 4,
                'decimals' => null
            ], [
                'name' => 'Asset under management',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Non performing loan (NPL)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 1,
                'decimals' => 2
            ], [
                'name' => 'Net interest margin (NIM)',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 2,
                'decimals' => 2
            ], [
                'name' => 'Cumulative Number of low and middle income lives impacted - Gender Neutral',
                'matrics_category_id' => 2,
                'matrics_unit_id' => 3,
                'decimals' => 2
            ]
        ]);

        $users = \App\Models\User::get();

        foreach ($users as $user) {
            \App\Models\MatricsResource::factory(10)->withParams(['user_id' => $user->id, 'matrics_category_id' => 3])->create();
        }
    }
}
