<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('asset');
            // $table->foreignId('fund_id')->constrained('fund');
            $table->string('name');
            $table->tinyInteger('instruments');
            $table->integer('issuedOfShares');
            $table->integer('fullyDilutedOfShares');
            $table->bigInteger('capitalContribution');
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
        Schema::dropIfExists('cap');
    }
}
