<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'proceso',
        'numero',
        'no_tarea',
        'ref',
        'cant'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
?>