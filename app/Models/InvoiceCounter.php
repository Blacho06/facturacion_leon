<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceCounter extends Model
{
    use HasFactory;

    protected $fillable = [
        'current_number',
        'max_number'
    ];

    /**
     * Obtener el siguiente número de factura
     */
    public static function getNextNumber(): string
    {
        return DB::transaction(function () {
            $counter = self::first();
            
            if (!$counter) {
                // Si no existe, crear el primer registro
                $counter = self::create([
                    'current_number' => 0,
                    'max_number' => 0 // sin uso, se mantiene la columna por compatibilidad
                ]);
            }

            // Incrementar el número sin límite superior
            $nextNumber = $counter->current_number + 1;

            // Actualizar el contador
            $counter->update(['current_number' => $nextNumber]);

            // Formatear el número con ceros a la izquierda (opcional)
            return str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    /**
     * Obtener el número actual sin incrementar
     */
    public static function getCurrentNumber(): string
    {
        $counter = self::first();
        
        if (!$counter) {
            return '000';
        }

        return str_pad($counter->current_number, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Resetear el contador (útil para testing)
     */
    public static function reset(): void
    {
        $counter = self::first();
        if ($counter) {
            $counter->update(['current_number' => 0]);
        }
    }
}