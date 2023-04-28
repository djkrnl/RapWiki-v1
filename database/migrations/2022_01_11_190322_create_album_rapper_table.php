<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumRapperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_rapper', function (Blueprint $table) {
			$table->bigInteger('album_id')->unsigned();
			$table->bigInteger('rapper_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
			$table->foreign('rapper_id')->references('id')->on('rappers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_rapper');
    }
}
