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
            $table->foreignId('raee_id')->constrained('raees')->onDelete('cascade');
            $table->foreignId('separated_by')->constrained('users', 'id');
            $table->string('name');
            $table->string('weight');
            $table->string('dimensions');
            $table->string('observations', 300)->nullable();
            $table->boolean('reusable')->default(true);
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
