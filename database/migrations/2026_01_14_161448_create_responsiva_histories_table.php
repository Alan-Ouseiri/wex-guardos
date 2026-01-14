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
        Schema::create('responsiva_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('responsiva_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('action');
            $table->text('description')->nullable();

            $table->foreignId('changed_by')
                ->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsiva_histories');
    }
};
