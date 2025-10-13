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
        Schema::create('process_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->string('numero_factura')->unique();
            $table->date('fecha');
            $table->string('cod_referencia');
            $table->string('color');
            $table->string('no_tarea');
            $table->json('tallas'); // Para almacenar las tallas como JSON
            $table->integer('total_tallas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_invoices');
    }
};
