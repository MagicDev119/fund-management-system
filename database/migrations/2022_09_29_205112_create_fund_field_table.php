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
            $table->string('slug');
            $table->foreignId('field_type_id')->constrained('field_type');
            $table->boolean('isVisible')->default(true);
            $table->boolean('isRequired')->default(false);
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
