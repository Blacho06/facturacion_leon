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
        Schema::create('process_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_invoice_id')->constrained()->onDelete('cascade');
            $table->string('proceso_nombre'); // LIMPIADORA, MONTADA, etc.
            $table->string('numero_proceso'); // Número automático (ej: 013)
            $table->string('no_tarea')->nullable();
            $table->string('referencia')->nullable();
            $table->integer('cantidad')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_tasks');
    }
};
