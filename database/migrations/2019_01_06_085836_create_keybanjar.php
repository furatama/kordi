<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeybanjar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keybanjar', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('iddesa')->nullable();
            $table->unsignedInteger('idbanjar')->nullable();
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('jabatan');

            $table->foreign('iddesa')->references('id')->on('desa');
            $table->foreign('idbanjar')->references('id')->on('banjar');
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
        Schema::dropIfExists('keybanjar');
    }
}
