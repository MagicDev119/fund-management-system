<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundPortfolioAccessibleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('fund_portfolio_accessible')) {
            // Schema::table('users', function (Blueprint $table) {
            //     $table->string('role', 20);
            //     $table->string('accessible_tab', 20);
            // });
        } else {
            Schema::create('fund_portfolio_accessible', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users');
                $table->foreignId('fund_id')->constrained('fund');
                $table->foreignId('asset_id')->constrained('asset');
                $table->string('type', 20);
                $table->boolean('isAccessible');
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fund_portfolio_accessible');
    }
}
