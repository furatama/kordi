<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalegTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caleg', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idpartai')->nullable();

            $table->unsignedInteger('nourut');
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('idpartai')->references('id')->on('partai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caleg');
    }
}
