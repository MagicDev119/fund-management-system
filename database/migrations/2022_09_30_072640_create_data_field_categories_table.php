<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataFieldCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_field_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->nullable()->constrained('asset');
            $table->string('category_name');
            $table->tinyInteger('type')->default(1); // 1: default, 2: asset
            $table->boolean('isLocked')->default(2); // 1:unLocked 2:locked
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
        Schema::dropIfExists('data_field_categories');
    }
}
