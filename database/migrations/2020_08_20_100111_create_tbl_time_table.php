<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_time', function (Blueprint $table) {
            $table->id();
            $table->string('time_tmp');
            $table->string('time_end_from');
            $table->string('time_end_to');
            $table->string('content_end');
            $table->string('time_begin_from');
            $table->string('time_begin_to');
            $table->string('content_begin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_time');
    }
}
