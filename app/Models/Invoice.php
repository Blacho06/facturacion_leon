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
        'no_tarea',
        'tallas'
    ];

    protected $casts = [
        'fecha' => 'date',
        'tallas' => 'array'
    ];

    public function processes()
    {
        return $this->hasMany(InvoiceProcess::class);
    }

    public function getTotalAttribute()
    {
        if (is_array($this->tallas)) {
            return array_sum($this->tallas);
        }
        return 0;
    }
}