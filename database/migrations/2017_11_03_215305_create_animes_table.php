<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('未知标题')->comment('标题');
            $table->string('thumb')->default('/images/avatar.png')->comment('缩略图');
            $table->string('episodes')->default('未知集数')->comment('集数');
            $table->text('introduction')->comment('简介');
            $table->string('akira')->default('未知声优')->comment('声优');
            $table->string('tag')->default('未知类型')->comment('类型');
            $table->integer('status')->default(0)->comment('视频状态');
            $table->string('issue_date')->default('未知发行时间')->comment('发行时间');
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
        Schema::dropIfExists('animes');
    }
}
