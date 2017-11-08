<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('未知标题')->comment('标题');
            $table->string('thumb')->default('/images/avatar.png')->comment('缩略图');
            $table->string('episodes')->default('未知集数')->comment('集数');
            $table->text('introduction')->comment('简介');
            $table->string('star')->default('未知明星')->comment('明星');
            $table->string('country')->default('未知国家')->comment('国家');
            $table->string('tag')->default('未知类型')->comment('类型');
            $table->integer('status')->default(0)->comment('视频状态');
            $table->integer('see')->default(0)->comment('观看人数');
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
        Schema::dropIfExists('tvs');
    }
}
