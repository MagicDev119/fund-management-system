<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioCustomReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_custom_report', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('asset');
            $table->foreignId('currency_id')->constrained('currency');
            $table->string('sector');
            $table->string('country');
            $table->string('industry');
            $table->float('headcount');
            $table->string('deal_source');
            $table->string('website_link');
            $table->bigInteger('valuation');
            $table->bigInteger('pre_money');
            $table->bigInteger('post_money');
            $table->float('ownership');
            $table->float('moic');
            $table->text('description');
            $table->text('recent_performance');
            $table->text('quarterly_highlights');
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
        Schema::dropIfExists('portfolio_custom_report');
    }
}
