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
        Schema::create('responsivas', function (Blueprint $table) {
            $table->id();
            $table->string('responsiva_number')->unique();

            $table->foreignId('teacher_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('device_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('assigned_date');
            $table->date('returned_date')->nullable();

            $table->enum('status', ['active', 'returned', 'canceled'])
                ->default('active');

            $table->string('condition');       // Estado físico del equipo
            $table->string('location');        // Ubicación
            $table->string('delivered_by');    // Entregado por

            $table->string('verification_code', 10)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsivas');
    }
};
