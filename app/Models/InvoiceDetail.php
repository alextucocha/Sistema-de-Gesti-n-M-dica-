<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{

    
    protected $fillable = [
    'invoice_id',
    'concept',
    'description', 
    'quantity',
    'unit_price',
    'subtotal',
    'product_code',
    'unit_code'
];



    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
