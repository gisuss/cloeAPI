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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->foreignId('ci_id')->constrained('identifications', 'id');
            $table->foreignId('estado_id')->nullable()->constrained('estados', 'id')->nullOnDelete();
            $table->foreignId('ciudad_id')->nullable()->constrained('ciudades', 'id')->nullOnDelete();
            $table->string('address');
            $table->boolean('active')->default(true);
            $table->boolean('enabled')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
