<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBRTanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_r_tanks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('游客')->comment('游客');
            $table->string('phone')->default('电话')->comment('电话');
            $table->string('company')->default('公司')->comment('公司');
            $table->string('desc')->default('详情')->comment('详情');
            $table->string('reason')->default('理由')->comment('理由');
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
        Schema::dropIfExists('b_r_tanks');
    }
}
