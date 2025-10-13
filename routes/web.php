<?php

use App\Http\Controllers\InvoiceController;

// Redirigir la página principal a invoices
Route::get('/', function () {
    return redirect()->route('invoices.index');
});

// Rutas del recurso invoices
Route::resource('invoices', InvoiceController::class)->names([
    'index' => 'invoices.index',
    'create' => 'invoices.create',
    'store' => 'invoices.store',
    'show' => 'invoices.show',
    'edit' => 'invoices.edit',
    'update' => 'invoices.update',
    'destroy' => 'invoices.destroy'
]);

// Ruta adicional para imprimir factura (opcional)
Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');

?>