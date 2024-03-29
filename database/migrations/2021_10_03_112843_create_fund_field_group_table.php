<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundFieldGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_field_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id')->nullable()->constrained('fund');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('group_name');
            $table->string('slug');
            $table->boolean('isVisible')->default(true);
            $table->tinyInteger('type')->default(1); // 1: default, 2: user_set, 3: fund
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
        Schema::dropIfExists('fund_field_group');
    }
}
