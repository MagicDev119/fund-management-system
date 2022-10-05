<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundKpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_kpis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id')->constrained('fund');
            $table->bigInteger('capital_called_investment_paid_in_cash_basis');
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
        Schema::dropIfExists('fund_kpis');
    }
}
