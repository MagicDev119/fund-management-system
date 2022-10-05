<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('valuation_period_id')->constrained('valuation_period');
            $table->foreignId('asset_id')->constrained('asset');
            $table->boolean('rev_or_ebit');
            $table->float('rev_or_ebit_multi_applied');
            $table->float('control_premium');
            $table->float('marketability_discount');
            $table->bigInteger('valuation_equity_value_used');
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
        Schema::dropIfExists('valuation');
    }
}
