<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('未知标题')->comment('标题');
            $table->string('thumb')->default('/images/avatar.png')->comment('缩略图');
            $table->text('introduction')->comment('简介');
            $table->text('url')->comment('下载地址');
            $table->string('star')->default('未知明星')->comment('明星');
            $table->string('tag')->default('未知类型')->comment('类型');
            $table->string('director')->default('未知导演')->comment('导演');
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
        Schema::dropIfExists('movies');
    }
}
