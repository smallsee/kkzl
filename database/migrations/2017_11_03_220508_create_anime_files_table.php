<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimeFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_files', function (Blueprint $table) {
            $table->string('file_name')->default('未知名称')->comment('标题');
            $table->string('file_url')->default('未知地址')->comment('地址');
            $table->integer('anime_id')->unsigned()->index();
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
        Schema::dropIfExists('anime_files');
    }
}
