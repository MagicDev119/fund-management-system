<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_field', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('asset_field_group');
            $table->string('name');
            $table->string('type');
            $table->boolean('isVisible');
            $table->boolean('isEditable');
            $table->boolean('isTimestampField');
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
        Schema::dropIfExists('asset_field');
    }
}
