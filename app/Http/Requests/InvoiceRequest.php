<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $invoiceId = $this->route('invoice') ? $this->route('invoice')->id : null;
        
        return [
            'numero' => [
                'required',
                'string',
                'max:50',
                'unique:invoices,numero,' . $invoiceId
            ],
            'fecha' => 'required|date',
            'cod_referencia' => 'nullable|string|max:100',
            'no_tarea' => 'nullable|string|max:50',
            'tallas' => 'required|array',
            'tallas.*' => 'integer|min:0|max:9999',
            'processes' => 'nullable|array',
            'processes.*.proceso' => 'required_with:processes|string|max:50',
            'processes.*.numero' => 'required_with:processes|string|max:50',
            'processes.*.no_tarea' => 'nullable|string|max:50',
            'processes.*.ref' => 'nullable|string|max:50',
            'processes.*.cant' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'numero.required' => 'El número de factura es obligatorio.',
            'numero.unique' => 'Este número de factura ya existe.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'tallas.required' => 'Debe especificar al menos las tallas.',
            'tallas.*.integer' => 'Las cantidades de tallas deben ser números enteros.',
            'tallas.*.min' => 'Las cantidades no pueden ser negativas.',
            'processes.*.proceso.required_with' => 'El nombre del proceso es obligatorio.',
            'processes.*.numero.required_with' => 'El número del proceso es obligatorio.',
        ];
    }

    public function prepareForValidation()
    {
        // Limpiar datos de procesos vacíos
        if ($this->has('processes')) {
            $processes = collect($this->processes)->filter(function ($process) {
                return !empty($process['proceso']) || !empty($process['numero']);
            })->values()->toArray();
            
            $this->merge(['processes' => $processes]);
        }
    }
}