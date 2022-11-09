<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomReportMatricsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyMatrics = \App\Models\CompanyMatrics::get();
        foreach ($companyMatrics as $eachCompanyMatrics) {
            $year = 2020;
            while(true) {
                $curYear = date("Y");
                if ($year > $curYear) break;
                $month = 1;
                while(true) {
                    $curMonth = date("m");
                    if (($year == $curYear && $month > $curMonth) || $month > 12) break;
                    \App\Models\CustomReportMatricsData::factory(1)->withParams(['company_matrics_id' => $eachCompanyMatrics->id, 'set_date' => date('Y-m-d', strtotime($year . '-' . $month . '-01'))])->create();
                    $month ++;
                }
                $year ++;
            }
        }
    }
}
