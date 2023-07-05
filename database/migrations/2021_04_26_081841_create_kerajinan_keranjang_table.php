<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerajinanKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerajinan_keranjang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_keranjang');
            $table->unsignedBigInteger('id_kerajinan');

            $table->foreign('id_keranjang')->references('id')->on('keranjang')->onDelete('cascade');
            $table->foreign('id_kerajinan')->references('id')->on('kerajinan_tangan')->onDelete('cascade');

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
        Schema::dropIfExists('kerajinan_keranjang');
    }
}
