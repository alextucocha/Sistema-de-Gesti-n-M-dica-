<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    
    protected $fillable = [
        'patient_id', 'doctor_id', 'folio', 'series', 'invoice_number',
        'receiver_name', 'receiver_rfc', 'receiver_email', 'receiver_address',
        'issuer_name', 'issuer_rfc', 'issuer_address', 'subtotal', 'tax_rate',
        'tax_amount', 'total', 'concept', 'notes', 'payment_method', 'payment_terms',
        'status', 'issue_date', 'due_date', 'paid_date', 'pdf_path', 'xml_path'
    ];


    #relacion con el paciente 
    public function patient()
    {
        return $this->belongsTo(User::class,'patient_id');
    }
    #relacion con el medico
     public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
    #relacion con los detalles de factura
     public function details()
    {
        return $this->hasMany(InvoiceDetail::class,'invoice_id');
    }
    
    #relacion con las transacciones 
     public function transactions()
    {
        return $this->hasMany(Transaction::class,'invoice_id');
    }

}
