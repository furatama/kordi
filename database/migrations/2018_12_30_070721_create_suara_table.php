<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suara', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idcaleg');
            $table->unsignedInteger('idtps');

            $table->unsignedInteger('suara');
            $table->dateTime('tglsuara');
            $table->string('penanggung');
            $table->text('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('idcaleg')->references('id')->on('caleg');
            $table->foreign('idtps')->references('id')->on('tps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suara');
    }
}
