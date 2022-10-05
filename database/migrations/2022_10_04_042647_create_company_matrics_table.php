<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyMatricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_matrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('data_field_categories');
            $table->string('name');
            $table->foreignId('matrics_category_id')->constrained('matrics_category');
            $table->foreignId('matrics_unit_id')->constrained('matrics_unit');
            $table->string('decimals');
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
        Schema::dropIfExists('company_matrics');
    }
}
