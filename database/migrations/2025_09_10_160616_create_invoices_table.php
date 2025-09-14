<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->date('fecha');
            $table->string('cod_referencia')->nullable();
            $table->string('no_tarea')->nullable();
            $table->json('tallas'); // AlmacenarÃ¡ las cantidades por talla
            $table->integer('total');
            $table->timestamps();
        });

        Schema::create('invoice_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->string('proceso'); // LIMPIADORA, MONTADA, etc.
            $table->string('numero');
            $table->string('no_tarea')->nullable();
            $table->string('ref')->nullable();
            $table->string('cant')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_processes');
        Schema::dropIfExists('invoices');
    }
};
?>