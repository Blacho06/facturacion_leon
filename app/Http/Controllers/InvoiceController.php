<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('processes')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string|unique:invoices',
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
            $invoice = Invoice::create([
                'numero' => $validated['numero'],
                'fecha' => $validated['fecha'],
                'cod_referencia' => $validated['cod_referencia'],
                'no_tarea' => $validated['no_tarea'],
                'tallas' => $validated['tallas'],
            ]);

            if (isset($validated['processes'])) {
                foreach ($validated['processes'] as $processData) {
                    InvoiceProcess::create([
                        'invoice_id' => $invoice->id,
                        'proceso' => $processData['proceso'],
                        'numero' => $processData['numero'],
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
            'numero' => 'required|string|unique:invoices,numero,' . $invoice->id,
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
            $invoice->update([
                'numero' => $validated['numero'],
                'fecha' => $validated['fecha'],
                'cod_referencia' => $validated['cod_referencia'],
                'no_tarea' => $validated['no_tarea'],
                'tallas' => $validated['tallas'],
            ]);

            // Eliminar procesos existentes
            $invoice->processes()->delete();

            // Crear nuevos procesos
            if (isset($validated['processes'])) {
                foreach ($validated['processes'] as $processData) {
                    InvoiceProcess::create([
                        'invoice_id' => $invoice->id,
                        'proceso' => $processData['proceso'],
                        'numero' => $processData['numero'],
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