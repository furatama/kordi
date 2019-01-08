<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeykomunitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keykomunitas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('komunitas');
            $table->string('jabatan');
            $table->softDeletes();
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
        Schema::dropIfExists('keykomunitas');
    }
}
