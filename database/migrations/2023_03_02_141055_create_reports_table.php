<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->unsignedBigInteger('tanaman_id');
            $table->string('pesan');
            $table->timestamps();

            $table->foreign('username')->references('username')->on('users');
            $table->foreign('tanaman_id')->references('id')->on('tanamen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
