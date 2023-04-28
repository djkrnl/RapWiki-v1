<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRappersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rappers', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->unsigned();
			$table->string('rapper_name');
			$table->string('full_name');
			$table->date('birth_date');
			$table->string('birth_city')->nullable();
			$table->bigInteger('birth_country')->unsigned();
			$table->date('death_date')->nullable();
			$table->string('death_city')->nullable();
			$table->bigInteger('death_country')->unsigned();
			$table->bigInteger('country')->unsigned();
			$table->set('occupation', ['rapper', 'producer', 'songwriter']);
			$table->set('genre', ['trap', 'boombap', 'underground', 'abstract', 'jazz', 'lofi', 'experimental', 'industrial', 'drumless', 'gangsta', 'westcoast', 'eastcoast', 'emo', 'rock', 'cloud', 'house', 'hyphy', 'hardcore']);
			$table->enum('status', ['single', 'relationship', 'married', 'unknown']);
			$table->string('website')->nullable();
			$table->text('description');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('birth_country')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('death_country')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('rappers');
    }
}
