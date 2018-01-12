<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXcxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xcxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('游客')->comment('游客');
            $table->string('phone')->default('电话')->comment('电话');
            $table->string('desc')->default('详情')->comment('标题');
            $table->string('server')->default('服务选择')->comment('标题');
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
        Schema::dropIfExists('xcxes');
    }
}
