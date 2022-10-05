<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_field', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('fund_field_group');
            $table->string('name');
            $table->string('type');
            $table->boolean('isVisible');
            $table->boolean('isRequired');
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
        Schema::dropIfExists('fund_field');
    }
}
