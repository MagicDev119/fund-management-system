<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioTearsheetReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_tearsheet_report', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('asset');
            $table->string('ic_year');
            $table->integer('ebitda_req_ebitda');
            $table->float('market_comps_multiple_cur_ltm');
            $table->float('market_comps_multiple_budget_fy');
            $table->float('market_comps_multiple_req_mult');
            $table->integer('target_exit_year');
            $table->float('target_money_multiple');
            $table->date('set_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_tearsheet_report');
    }
}
