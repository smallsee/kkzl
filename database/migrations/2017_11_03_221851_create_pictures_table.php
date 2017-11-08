<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('未知标题')->comment('标题');
            $table->string('thumb')->default('/images/avatar.png')->comment('缩略图');
            $table->string('big_thumb')->default('/images/avatar.png')->comment('缩略图');
            $table->string('topic')->default('未知话题')->comment('话题');
            $table->integer('status')->default(0)->comment('文章状态');
            $table->integer('see')->default(0)->comment('观看人数');
            $table->integer('user_id')->unsigned()->default(0);
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
        Schema::dropIfExists('pictures');
    }
}
