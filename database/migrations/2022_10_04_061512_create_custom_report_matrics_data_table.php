<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomReportMatricsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_report_matrics_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_matrics_id')->constrained('company_matrics');
            $table->bigInteger('value');
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
        Schema::dropIfExists('custom_report_matrics_data');
    }
}
