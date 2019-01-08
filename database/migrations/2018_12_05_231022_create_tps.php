<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->unsignedInteger('idbanjar')->nullable();
            $table->unsignedInteger('iddesa')->nullable();
            $table->timestamps();

            $table->foreign('iddesa')->references('id')->on('desa');
            $table->foreign('idbanjar')->references('id')->on('banjar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tps');
    }
}
