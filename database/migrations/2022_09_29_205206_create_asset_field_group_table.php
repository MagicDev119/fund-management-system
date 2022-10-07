<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetFieldGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_field_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->nullable()->constrained('asset');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('group_name');
            $table->string('slug');
            $table->boolean('isVisible')->default(true);
            $table->tinyInteger('type')->default(1); // 1: default, 2: user_set, 3: asset
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
        Schema::dropIfExists('asset_field_group');
    }
}
