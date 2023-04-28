<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_tracks', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('album_id')->unsigned();
			$table->integer('track_nr');
			$table->string('track_name', 1000);
			$table->string('track_length');
			$table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
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
        Schema::dropIfExists('album_tracks');
    }
}
