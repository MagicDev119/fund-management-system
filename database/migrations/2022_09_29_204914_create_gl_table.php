<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id')->constrained('fund');
            $table->foreignId('asset_id')->constrained('asset');
            $table->foreignId('gl_category_id')->constrained('gl_category');
            $table->bigInteger('amount');
            $table->string('description');
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
        Schema::dropIfExists('gl');
    }
}
