<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceProcess;
use App\Models\InvoiceCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    // Actualizar InvoiceController::index()
public function index(Request $request)
{
    $query = Invoice::with('processes');

    // Búsqueda por número
    if ($request->filled('search')) {
        $query->where('numero', 'like', '%' . $request->search . '%')
              ->orWhere('cod_referencia', 'like', '%' . $request->search . '%');
    }

    // Filtro por rango de fechas
    if ($request->filled('fecha_desde')) {
        $query->whereDate('fecha', '>=', $request->fecha_desde);
    }

    if ($request->filled('fecha_hasta')) {
        $query->whereDate('fecha', '<=', $request->fecha_hasta);
    }

    $invoices = $query->latest()->paginate(10);
    
    // Mantener parámetros de búsqueda en la paginación
    $invoices->appends($request->query());
    
    return view('invoices.index', compact('invoices'));
}

    public function create()
    {
        // Obtener el próximo número de factura para mostrarlo
        $nextNumber = InvoiceCounter::getCurrentNumber();
        $nextNumber = str_pad((intval($nextNumber) + 1 > 100 ? 1 : intval($nextNumber) + 1), 3, '0', STR_PAD_LEFT);
        
        return view('invoices.create', compact('nextNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'cod_referencia' => 'nullable|string',
            'no_tarea' => 'nullable|string',
            'tallas' => 'required|array',
            'tallas.*' => 'integer|min:0',
            'processes' => 'nullable|array',
            'processes.*.proceso' => 'required|string',
            'processes.*.numero' => 'required|string',
            'processes.*.no_tarea' => 'nullable|string',
            'processes.*.ref' => 'nullable|string',
            'processes.*.cant' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            // Obtener el siguiente número automáticamente
            $invoiceNumber = InvoiceCounter::getNextNumber();

            // 🔥 CAMBIO: Calcular el total de pares
            $total = array_sum($validated['tallas']);

            $invoice = Invoice::create([
                'numero' => $invoiceNumber,
                'fecha' => $validated['fecha'],
                'cod_referencia' => $validated['cod_referencia'],
                'no_tarea' => $validated['no_tarea'],
                'tallas' => $validated['tallas'],
                'total' => $total, // 🔥 AGREGADO: Campo total calculado
            ]);

            if (isset($validated['processes'])) {
                foreach ($validated['processes'] as $processData) {
                    InvoiceProcess::create([
                        'invoice_id' => $invoice->id,
                        'proceso' => $processData['proceso'],
                        'numero' => $invoiceNumber, // Usar el mismo número de la factura
                        'no_tarea' => $processData['no_tarea'] ?? null,
                        'ref' => $processData['ref'] ?? null,
                        'cant' => $processData['cant'] ?? null,
                    ]);
                }
            }
        });

        return redirect()->route('invoices.index')
            ->with('success', 'Factura creada exitosamente.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('processes');
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load('processes');
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'cod_referencia' => 'nullable|string',
            'no_tarea' => 'nullable|string',
            'tallas' => 'required|array',
            'tallas.*' => 'integer|min:0',
            'processes' => 'nullable|array',
            'processes.*.proceso' => 'required|string',
            'processes.*.numero' => 'required|string',
            'processes.*.no_tarea' => 'nullable|string',
            'processes.*.ref' => 'nullable|string',
            'processes.*.cant' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $invoice) {
            // 🔥 CAMBIO: Calcular el nuevo total
            $total = array_sum($validated['tallas']);

            // En la actualización NO cambiamos el número de factura
            $invoice->update([
                'fecha' => $validated['fecha'],
                'cod_referencia' => $validated['cod_referencia'],
                'no_tarea' => $validated['no_tarea'],
                'tallas' => $validated['tallas'],
                'total' => $total, // 🔥 AGREGADO: Actualizar el total calculado
            ]);

            // Eliminar procesos existentes
            $invoice->processes()->delete();

            // Crear nuevos procesos con el mismo número de la factura
            if (isset($validated['processes'])) {
                foreach ($validated['processes'] as $processData) {
                    InvoiceProcess::create([
                        'invoice_id' => $invoice->id,
                        'proceso' => $processData['proceso'],
                        'numero' => $invoice->numero, // Mantener el número original
                        'no_tarea' => $processData['no_tarea'] ?? null,
                        'ref' => $processData['ref'] ?? null,
                        'cant' => $processData['cant'] ?? null,
                    ]);
                }
            }
        });

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Factura actualizada exitosamente.');
    }

    
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', 'Factura eliminada exitosamente.');
    }
}
