<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'fecha',
        'cod_referencia',
        'color',
        'no_tarea',
        'tallas',
        'total',
        'precio_total',
        'processes'
    ];

    protected $casts = [
        'fecha' => 'date',
        'tallas' => 'array',
        'processes' => 'array'
    ];

    /**
     * Calcular el total de pares a partir del array de tallas
     */
    public static function calculateTotal(array $tallas): int
    {
        return array_sum($tallas);
    }
}
?>