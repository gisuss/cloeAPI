<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void 
    {
		Schema::create('estados', function(Blueprint $table) {
			$table->increments('id');
			$table->string('estado');
		});

	    Schema::create('municipios', function(Blueprint $table) {
	        $table->increments('id');
          	$table->integer('estado_id')->unsigned();
			$table->foreign('estado_id')->references('id')->on('estados');
	        $table->string('municipio');
	    });

	    Schema::create('ciudades', function(Blueprint $table) {
	        $table->increments('id');
          	$table->integer('estado_id')->unsigned();
			$table->foreign('estado_id')->references('id')->on('estados');
	        $table->string('ciudad');
	        $table->tinyInteger('capital');
	    });

	    Schema::create('parroquias', function(Blueprint $table) {
	        $table->increments('id');
          	$table->integer('municipio_id')->unsigned();
			$table->foreign('municipio_id')->references('id')->on('municipios');
	        $table->string('parroquia');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void 
    {
		Schema::dropIfExists('estados');
		Schema::dropIfExists('municipios');
		Schema::dropIfExists('ciudades');
		Schema::dropIfExists('parroquias');
	}

};
