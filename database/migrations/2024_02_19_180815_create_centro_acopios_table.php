<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('centro_acopios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('encargado_id')->constrained('users', 'id');
            $table->foreignId('estado_id')->constrained('estados', 'id');
            $table->foreignId('ciudad_id')->constrained('ciudades', 'id');
            $table->string('description', 300)->nullable();
            $table->string('address', 300);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_acopios');
    }
};
