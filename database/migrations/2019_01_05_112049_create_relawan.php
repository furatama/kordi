<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relawan', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nik')->unique();
            $table->string('namalengkap');
            $table->enum('jeniskelamin',['L','P'])->nullable();
            $table->string('alamat')->nullable();
            $table->json('kontak')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('relawan');
    }
}
