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
        Schema::dropIfExists('process_tasks');
        Schema::dropIfExists('process_invoices');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recrear las tablas si es necesario
        Schema::create('process_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->string('numero_factura')->unique();
            $table->date('fecha');
            $table->string('cod_referencia');
            $table->string('color');
            $table->string('no_tarea');
            $table->json('tallas');
            $table->integer('total_tallas')->default(0);
            $table->timestamps();
        });

        Schema::create('process_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_invoice_id')->constrained()->onDelete('cascade');
            $table->string('proceso_nombre');
            $table->string('numero_proceso');
            $table->string('no_tarea')->nullable();
            $table->string('referencia')->nullable();
            $table->integer('cantidad')->default(0);
            $table->timestamps();
        });
    }
};