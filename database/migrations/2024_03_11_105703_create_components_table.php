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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raee_id')->constrained('raees', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->float('weight', 8, 2, true);
            $table->string('dimensions');
            $table->boolean('reusable')->default(false);
            $table->foreignId('separated_by')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
