<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->string('username', 100)->nullable();
            $table->unsignedBigInteger('tanaman_id')->nullable();
            $table->timestamps();

            $table->primary(['username', 'tanaman_id']);
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
        Schema::dropIfExists('bookmarks');
    }
}
