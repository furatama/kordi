<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanjar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banjar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->unsignedInteger('iddesa')->nullable();
            $table->timestamps();

            $table->foreign('iddesa')->references('id')->on('desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banjar');
    }
}
