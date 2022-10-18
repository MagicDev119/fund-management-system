<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundPortfolioRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_portfolio_relation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id')->constrained('fund');
            $table->foreignId('asset_id')->constrained('asset');
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
        Schema::dropIfExists('fund_portfolio_relation');
    }
}
