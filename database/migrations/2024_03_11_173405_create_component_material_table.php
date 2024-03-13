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
        Schema::create('component_material', function (Blueprint $table) {
            $table->foreignId('component_id')->constrained('components', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('material_id')->constrained('materials', 'id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_material');
    }
};
