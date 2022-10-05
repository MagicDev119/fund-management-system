<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuation_period', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Last twelve months, 6m actual + 6m budget, 12 months budget
            $table->string('description'); // Last twelve months, 6 months actual and 6 months budget (forward projection), 12 months budget (forward projection)
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
        Schema::dropIfExists('valuation_period');
    }
}
