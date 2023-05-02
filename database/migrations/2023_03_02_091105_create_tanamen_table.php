<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanamen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tanaman', 100);
            $table->string('username', 100);
            $table->string('latin', 100);
            $table->string('desk', 5000);
            $table->string('khasiat', 1000);
            $table->string('lokasi', 225);
            $table->string('kategori',  100);
            $table->string('gambar', 225);
            $table->timestamps();

            $table->foreign('kategori')->references('kategori')->on('kategoris');

            $table->foreign('username')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanamen');
    }
}
