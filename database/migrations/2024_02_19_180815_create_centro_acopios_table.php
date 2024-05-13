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
            $table->foreignId('encargado_id')->nullable()->constrained('users', 'id');
            $table->foreignId('estado_id')->nullable()->constrained('estados', 'id')->nullOnDelete();
            $table->foreignId('municipio_id')->nullable()->constrained('municipios', 'id')->nullOnDelete();
            $table->string('description', 300)->nullable();
            $table->string('name');
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
