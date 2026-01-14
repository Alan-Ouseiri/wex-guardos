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

            $table->text('notes')->nullable();

            $table->string('delivery_image')->nullable();
            $table->string('teacher_signature')->nullable();

            $table->foreignId('created_by')
                ->constrained('users');

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
