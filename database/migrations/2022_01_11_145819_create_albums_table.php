<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->unsigned();
			$table->string('album_name', 1000);
			$table->date('release_date');
			$table->enum('type', ['album', 'ep', 'single']);
			$table->set('genre', ['trap', 'boombap', 'underground', 'abstract', 'jazz', 'lofi', 'experimental', 'industrial', 'drumless', 'gangsta', 'westcoast', 'eastcoast', 'emo', 'rock', 'cloud', 'house', 'hyphy', 'hardcore']);
			$table->string('label');
			$table->string('studio')->nullable();
			$table->text('description');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('albums');
    }
}
