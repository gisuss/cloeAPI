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
        Schema::create('component_proceso', function (Blueprint $table) {
            $table->foreignId('component_id')->constrained('components', 'id')->onDelete('cascade');
            $table->foreignId('proceso_id')->constrained('procesos', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_proceso');
    }
};
