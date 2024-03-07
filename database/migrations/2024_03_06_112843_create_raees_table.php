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
        Schema::create('raees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('centro_id')->constrained('centro_acopios', 'id')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands', 'id')->cascadeOnDelete();
            $table->foreignId('line_id')->constrained('lines', 'id')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories', 'id')->cascadeOnDelete();
            $table->foreignId('clasified_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->boolean('status')->default(false);
            $table->string('model');
            $table->string('information', 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raees');
    }
};
