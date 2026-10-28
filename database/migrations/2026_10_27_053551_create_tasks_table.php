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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // Información principal
            $table->string('title', 150);
            $table->text('description')->nullable();

            // Clasificación
            $table->string('priority', 20)->default('medium');
            $table->string('status', 20)->default('pending');

            // Fecha límite
            $table->date('due_date')->nullable();

            // Fechas de creación y actualización
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
