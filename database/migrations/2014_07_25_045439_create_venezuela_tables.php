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
			$table->id();
			$table->string('estado');
		});

	    Schema::create('municipios', function(Blueprint $table) {
	        $table->id();
			$table->foreignId('estado_id')->constrained('estados', 'id');
	        $table->string('municipio');
	    });

	    Schema::create('ciudades', function(Blueprint $table) {
	        $table->id();
			$table->foreignId('estado_id')->constrained('estados', 'id');
	        $table->string('ciudad');
	        $table->tinyInteger('capital');
	    });

	    Schema::create('parroquias', function(Blueprint $table) {
	        $table->id();
			$table->foreignId('municipio_id')->constrained('municipios', 'id');
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
