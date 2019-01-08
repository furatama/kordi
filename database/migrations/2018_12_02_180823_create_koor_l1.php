<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKoorL1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koorl1', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('iddesa')->nullable();
            $table->unsignedInteger('idbanjar')->nullable();
            $table->unsignedInteger('idtps')->nullable();

            $table->string('nik')->unique();
            $table->string('namalengkap');
            $table->enum('jeniskelamin',['L','P'])->nullable();
            $table->string('alamat')->nullable();
            $table->json('kontak')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('iddesa')->references('id')->on('desa');
            $table->foreign('idbanjar')->references('id')->on('banjar');
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
        Schema::dropIfExists('koorl1');
    }
}
