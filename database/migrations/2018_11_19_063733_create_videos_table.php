<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->string('task_type');
            $table->string('url');
            $table->string('title');
            $table->string('screensnap')->nullable()->default('')->change();
            $table->string('filepath')->nullable()->default('')->change();
            $table->integer('is_get_file_already')->default(0)->change();
            $table->string('file_md5')->nullable()->default('')->change();
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
        Schema::dropIfExists('videos');
    }
}
