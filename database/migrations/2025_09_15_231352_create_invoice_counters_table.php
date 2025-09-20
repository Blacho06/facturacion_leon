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
        // Crear tabla para manejar el contador de facturas
        Schema::create('invoice_counters', function (Blueprint $table) {
            $table->id();
            $table->integer('current_number')->default(0);
            $table->integer('max_number')->default(100);
            $table->timestamps();
        });

        // Insertar registro inicial
        DB::table('invoice_counters')->insert([
            'current_number' => 0,
            'max_number' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Modificar la tabla invoices para que numero sea automático
        Schema::table('invoices', function (Blueprint $table) {
            // Cambiar la columna numero para que no sea unique a nivel de base de datos
            // ya que vamos a tener números repetidos (1-100 cíclico)
            $table->dropUnique(['numero']);
            $table->string('numero')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_counters');
        
        // Restaurar unique constraint
        Schema::table('invoices', function (Blueprint $table) {
            $table->unique('numero');
        });
    }
};